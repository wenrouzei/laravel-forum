@extends('layouts.app')

@section('content')
    <script src="{{ asset('js/jquery.form.js') }}"></script>
    <script src="{{ asset('js/jquery.Jcrop.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/jquery.Jcrop.css') }}">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="thumbnail" style="height: 336px;">
                    <img class="img-circle" src="{{ Auth::user()->avatar }}" width="200" height="200">
                    <div class="caption">
                        <dl style="width: 80%" class="pull-right">
                            <dt>用户名：</dt>
                            <dd>{{ Auth::user()->name }}</dd>
                            <dt>注册时间：</dt>
                            <dd>{{ Auth::user()->created_at }}</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">

                        @include('users._nav')

                        <div class="text-center">
                            <div id="validation-errors"></div>
                            <img src="{{Auth::user()->avatar}}" width="120" class="img-circle" id="user-avatar" alt="">
                            {!! Form::open(['url'=>'/user/avatarUpload','files'=>true,'id'=>'avatar']) !!}
                            <div class="text-center">
                                <button type="button" class="btn btn-success avatar-button" id="upload-avatar">上传新的头像</button>
                                {!! Form::file('avatar',['class'=>'avatar','id'=>'image']) !!}
                            </div>
                            <div class="text-center">
                                <label>上传的图片大小不超过 2M</label>
                            </div>
                            {!! Form::close() !!}
                            <div class="span5">
                                <div id="output" style="display:none">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    {!! Form::open( [ 'url' => ['/user/avatarCrop'], 'method' => 'POST', 'onsubmit'=>'return checkCoords();','files' => true ] ) !!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" style="color: #ffffff">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">裁剪头像</h4>
                    </div>
                    <div class="modal-body">
                        <div class="content">
                            <div class="crop-image-wrapper">
                                <img src="/images/avatars/default.png" class="ui centered image" id="cropbox" >
                                <input type="hidden" id="photo" name="photo" />
                                <input type="hidden" id="x" name="x" />
                                <input type="hidden" id="y" name="y" />
                                <input type="hidden" id="w" name="w" />
                                <input type="hidden" id="h" name="h" />
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                        <button type="submit" class="btn btn-primary">裁剪头像</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var options = {
                beforeSubmit:  showRequest,
                success:       showResponse,
                dataType: 'json'
            };
            $('#image').on('change', function(){
                $('#upload-avatar').html('正在上传...');
                $('#avatar').ajaxForm(options).submit();
            });
        });

        function showRequest() {
            $("#validation-errors").hide().empty();
            $("#output").css('display','none');
            return true;
        }

        function showResponse(response)  {
            if(response.success == false)
            {
                var responseErrors = response.errors;
                $.each(responseErrors, function(index, value)
                {
                    if (value.length != 0)
                    {
                        $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
                    }
                });
                $("#validation-errors").show();
            } else {
                var cropBox = $("#cropbox");
                cropBox.attr('src',response.avatar);
                $('#photo').val(response.image);
                $('#upload-avatar').html('更换新头像');
                $('#exampleModal').modal('show');
                cropBox.Jcrop({
                    aspectRatio: 1,
                    onSelect: updateCoords,
                    setSelect: [120,120,10,10]
                });
            }
        }

        //添加的两个function
        function updateCoords(c)
        {
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#w').val(c.w);
            $('#h').val(c.h);
        }

        function checkCoords()
        {
            if (parseInt($('#w').val())) return true;
            alert('请选择图片.');
            return false;
        }
    </script>
@stop