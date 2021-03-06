@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" role="main">
                @if($errors->any())
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                @endif

                {!! Form::open(['url'=>'/discussions']) !!}
                @include('forum._form', ['buttonText'=>'发布帖子'])
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop