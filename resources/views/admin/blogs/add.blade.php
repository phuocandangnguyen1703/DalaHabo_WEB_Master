@extends('admin.main')

@section('header')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>{{$title}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="/admin">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li class="breadcrumb-item"><a href="#"></a>{{$title}}</li>
                    <li class="breadcrumb-item active" aria-current="page">{{$menu}}</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    @include('admin.alert')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{$menu}}</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form action="" method="POST" id="form">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label for="name" class="col-form-label">Tiêu đề</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Tiêu đề">
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label for="author" class="col-form-label">Tác giả</label>
                                <input type="text" name="author" value="{{old('author')}}" class="form-control" placeholder="Tác giả">
                            </div>
                        </div>
                        
                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label for="summary" class="col-form-label">Tóm tắt</label>
                                <textarea style="resize:none" rows="4" name="summary" class="form-control" id="summary" placeholder="Tóm tắt bài viết...">{{old('summary')}}</textarea>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label for="content" class="col-form-label">Nội dung</label>
                                <textarea name="content" class="form-control" id="content" placeholder="Nội dung bài viết...">{{old('content')}}</textarea>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <label class="col-form-label">Thumbnail</label>
                                <div class="form-group custom-file">
                                    <input type="file" class="custom-file-input"  name="upload" id="upload" accept="image/*"> 
                                    <label class="custom-file-label" for="upload" name="file" id="file"></label>
                                    <input type="hidden" name="image" id="image">
                                </div>
                                <div id="image_show" class="mt-3 col-md-3"></div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Tạo mới</button>
                    </div>
                    @csrf
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</section>
@endsection

@section('footer')
    <script>
        CKEDITOR.replace('content', {
            extraPlugins: 'editorplaceholder',
            height: 200,
            resize_minWidth: 200,
            resize_minHeight: 300,
            editorplaceholder: 'Mô tả chi tiết về hướng dẫn viên...',
            removeButtons: 'PasteFromWord',
            filebrowserImageUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
            filebrowserImageBrowseUrl: "{{route('file_browser', ['_token' => csrf_token() ])}}",
            filebrowserUploadMethod: 'form'
        });

        CKEDITOR.config.toolbarGroups = [
            { name: 'mode'},
            { name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
            { name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
            { name: 'links' },
            { name: 'insert' },
            '/',
            { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
            { name: 'styles' },
            { name: 'colors' },
            { name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align'] },
            { name: 'tools'}
        ]
    </script>

    <script>
        $(function () {
            $('#form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    upload: {
                        required: true,
                    },
                },
                messages: {
                    name: {
                        required: "Vui lòng nhập tiêu đề bài viết"
                    },
                    upload: {
                        required: "Vui lòng thêm thumbnail cho bài viết",
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script>
@endsection