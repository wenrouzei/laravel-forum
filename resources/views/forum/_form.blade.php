{{-- Title field --}}
<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class'=>'form-control']) !!}
</div>
@include('editor::head')
{{-- Body field --}}
<div class="form-group">
    {!! Form::label('body', 'Body:') !!}
    <div class="editor">
    {!! Form::textarea('body', null, ['class'=>'form-control', 'id'=>'myEditor']) !!}
    </div>
</div>

{!! Form::submit($buttonText, ['class'=>'btn btn-primary pull-right']) !!}