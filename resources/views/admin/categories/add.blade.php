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
                <form action="/admin/categories/create" method="POST" id="add-category-form">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label for="category" class="col-form-label">Tên danh mục</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Tên danh mục">
                                <span class="error invalid-feedback name_error"></span>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label class="col-form-label">Mô tả danh mục</label>
                                <textarea style="resize:none" rows="4" name="description" class="form-control" id="category_description" placeholder="Mô tả danh mục">{{old('description')}}</textarea>
                                <span class="error invalid-feedback description_error"></span>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label class="col-sm-2 col-form-label">Trạng thái</label>
                                <div class="mt-2 ml-1 row">
                                    <div class="custom-control custom-radio col-4">
                                        <input class="custom-control-input" type="radio" value="1" id="active" name="active" checked>
                                        <label for="active" class="custom-control-label font-weight-normal">Hiển thị</label>
                                    </div>
                                    <div class="custom-control custom-radio col-4">
                                        <input class="custom-control-input" type="radio" value="0" id="inactive" name="active">
                                        <label for="inactive" class="custom-control-label font-weight-normal">Ẩn</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary float-right">Thêm danh mục</button>
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
            $('#add-category-form').validate({
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