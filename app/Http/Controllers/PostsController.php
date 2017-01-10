<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Http\Requests\ForumPostRequest;
use App\Markdown\Markdown;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use YuanChao\Editor\EndaEditor;

class PostsController extends Controller
{
    protected $markdown;

    public function __construct(Markdown $markdown)
    {
        $this->middleware('auth', ['only'=>['create', 'store', 'edit', 'update']]);
        $this->markdown = $markdown;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = $request->input('q');
        $discussions = Discussion::search($q)->withCount('comments')->latest()->paginate(10);
        return view('forum.index', compact('discussions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('forum.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForumPostRequest $request)
    {
        $data = [
            'user_id' => Auth::user()->id,
            'last_user_id' => Auth::user()->id,
        ];

        $discussion = Discussion::create(array_merge($request->all(), $data));

        return redirect('/discussions/'.$discussion->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $discussion = Discussion::findOrFail($id);
        $html = $this->markdown->markdown($discussion->body);
        return view('forum.show', compact('discussion', 'html'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $discussion = Discussion::findOrFail($id);
        if(Auth::user()->id !== $discussion->user_id){
            return redirect('/');
        }

        return view('forum.edit', compact('discussion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ForumPostRequest $request, $id)
    {
        $discussion = Discussion::findOrFail($id);
        $discussion->update($request->all());
        return redirect('/discussions/'.$discussion->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function upload()
    {
        $data = EndaEditor::uploadImgFile('uploads');

        return json_encode($data);
    }
}
