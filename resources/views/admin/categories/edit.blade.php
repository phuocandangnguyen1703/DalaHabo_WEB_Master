@extends('admin.main')

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
                    <li class="breadcrumb-item"><a href="/admin/categories/all">{{$menu}}</a></li>
                    <li class="breadcrumb-item"><a href="#"></a>{{$item}}</li>
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
                <form action="/admin/categories/edit/{{$category->id}}" method="POST" id="edit-category-form">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label for="category" class="col-form-label">Tên danh mục</label>
                                <input type="text" name="name" value="{{$category->name}}" class="form-control" placeholder="Tên danh mục">
                                <span class="error invalid-feedback name_error"></span>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label class="col-sm-2 col-form-label">Mô tả danh mục</label>
                                <textarea style="resize:none" rows="5" name="description" class="form-control" id="category_description" placeholder="Mô tả danh mục">{{$category->description}}</textarea>
                                <span class="error invalid-feedback description_error"></span>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label class="col-form-label">Trạng thái</label>
                                <div class="mt-2 ml-1 row">
                                    <div class="custom-control custom-radio col-4">
                                        <input class="custom-control-input" type="radio" value="1" id="active" name="active" {{$category->active == 1 ? 'checked' : ''}}>
                                        <label for="active" class="custom-control-label">Hiển thị</label>
                                    </div>
                                    <div class="custom-control custom-radio col-4">
                                        <input class="custom-control-input" type="radio" value="0" id="inactive" name="active" {{$category->active == 0 ? 'checked' : ''}}>
                                        <label for="inactive" class="custom-control-label">Ẩn</label>
                                    </div>
                                </div>
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
        $(function () {
            $('#edit-category-form').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    description: {
                        required: true,
                    }
                },
                messages: {
                    name: {
                        required: "Vui lòng nhập tên danh mục",
                    },
                    description: {
                        required: "Vui lòng nhập mô tả danh mục",
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