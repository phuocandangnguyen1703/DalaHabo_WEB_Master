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
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">{{$menu}}</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form action="/admin/places/create" method="POST" id="add-place-form">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label">Tên địa điểm</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Tên địa điểm">
                                <span class="error invalid-feedback name_error"></span>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="name" class="col-form-label">Danh mục</label>
                                <select name="categoryId" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label">Địa chỉ</label>
                                <input type="text" name="address" value="{{old('address')}}" class="form-control" placeholder="Địa chỉ">
                                <span class="error invalid-feedback address_error"></span>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="name" class="col-form-label">Định vị Google Maps</label>
                                <input type="text" name="location" value="{{old('location')}}" class="form-control" placeholder="Định vị Google Maps">
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label class="col-form-label">Tóm tắt</label>
                                <textarea style="resize:none" rows="4" name="summary" class="form-control" id="summary" placeholder="Tóm tắt về địa điểm...">{{old('summary')}}</textarea>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label class="col-form-label">Mô tả chi tiết</label>
                                <textarea name="description" class="form-control" id="description" placeholder="Mô tả địa điểm"></textarea>
                            </div>
                            
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <label class="col-form-label">Hình ảnh</label>
                                <div class="form-group custom-file">
                                    <input type="file" class="custom-file-input" name="file[]" accept="image/*" id="mul-file-input" multiple>
                                    <label class="custom-file-label" name="label" for="file" id="file">{{old('label')}}</label>
                                </div>
                                <div class="row" id="images-show"></div>
                                <input type="hidden" name="image" id="images">
                                <input type="hidden" name="folder" value="places" id="folder">
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
    CKEDITOR.replace('description', {
        extraPlugins: 'editorplaceholder',
        height: 200,
        resize_minWidth: 200,
        resize_minHeight: 300,
        editorplaceholder: 'Mô tả chi tiết về địa điểm...',
        removeButtons: 'PasteFromWord',
        filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
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
    
    $(function () {
        $('#add-place-form').validate({
            rules: {
                name: {
                    required: true,
                },
                address: {
                    required: true,
                },
            },
            messages: {
                name: {
                    required: "Vui lòng nhập tên địa điểm",
                },
                address: {
                    required: "Vui lòng nhập địa chỉ",
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