@extends('app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @if($errors->any())
                    <ul class="list-group">
                        @foreach($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">
                                {{ $error }}
                            </li>
                        @endforeach
                    </ul>
                @endif
                    <div class="text-center"><img src="{{ Auth::user()->avatar }}" width="120" class="img-circle" alt=""></div>
                {!! Form::open(['url'=>'/user/avatar', 'files'=>true]) !!}
                {{-- Avatar field --}}
                <div class="form-group">
                    {!! Form::file('avatar', ['class'=>'form-control']) !!}
                </div>

                {!! Form::submit('上传头像', ['class'=>'btn btn-success form-control']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@stop