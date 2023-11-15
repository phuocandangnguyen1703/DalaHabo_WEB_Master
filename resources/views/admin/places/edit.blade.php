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
                    <li class="breadcrumb-item">{{$title}}</li>
                    <li class="breadcrumb-item"><a href="/admin/places/all">{{$menu}}</a></li>
                    <li class="breadcrumb-item">{{$item}}</li>
                    <li class="breadcrumb-item active" aria-current="page">Cập nhật</li>
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
                    <h3 class="card-title">{{$item}}</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form action="/admin/places/edit/{{$place->id}}" method="POST" id="edit-place-form">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label">Tên địa điểm</label>
                                <input type="text" name="name" value="{{$place->name}}" class="form-control" placeholder="Tên địa điểm">
                                <span class="error invalid-feedback name_error"></span>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="category_id" class="col-form-label">Danh mục</label>
                                <select name="category_id" class="form-control">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" {{$place->category_id === $category->id ? 'selected' : ''}}>
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label">Địa chỉ</label>
                                <input type="text" name="address" value="{{$place->address}}" class="form-control" placeholder="Địa chỉ">
                                <span class="error invalid-feedback address_error"></span>
                            </div>

                            <div class="form-group col-md-5">
                                <label for="name" class="col-form-label">Định vị Google Maps</label>
                                <input type="text" name="location" value="{{$place->location}}" class="form-control" placeholder="Định vị Google Maps">
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label class="col-form-label">Tóm tắt</label>
                                <textarea style="resize:none" rows="4" name="summary" class="form-control" id="summary" placeholder="Tóm tắt về địa điểm...">{{$place->summary}}</textarea>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label class="col-form-label">Mô tả chi tiết</label>
                                <textarea name="description" class="form-control" id="description" placeholder="Mô tả địa điểm">{{$place->description}}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Cập nhật</button>
                        <a class="btn btn-light" href="{{url()->previous()}}" onClick="">
                            <i class="fas fa-chevron-left mr-2"></i>
                            <span>Trở về</span>
                        </a>
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
            height: 400,
            resize_minWidth: 200,
            resize_minHeight: 300,
            editorplaceholder: 'Mô tả chi tiết về địa điểm...',
            removeButtons: 'PasteFromWord',
        });
    </script>
    <script>
        $(function () {
            $('#form').validate({
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