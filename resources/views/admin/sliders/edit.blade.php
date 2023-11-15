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
                    <li class="breadcrumb-item"><a href="/admin/sliders/all">{{$menu}}</a></li>
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
                <form action="/admin/sliders/edit/{{$slider->id}}" method="POST" id="edit-slider-form">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="form-group col-md-5">
                                <label for="name" class="col-form-label">Tên slider</label>
                                <input type="text" name="name" value="{{$slider->name}}" class="form-control" placeholder="Tiêu đề">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="name" class="col-form-label">Đường dẫn</label>
                                <input type="text" name="url" value="{{$slider->url}}" class="form-control" placeholder="Đường dẫn">
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label class="col-form-label">Hình ảnh</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" value="" id="upload">
                                    <label class="custom-file-label" for="upload" name="file" id="file"></label>
                                    <input type="hidden" name="image" value="{{$slider->image}}" id="image">
                                    <input type="hidden" name="folder" value="sliders" id="folder">
                                </div>
                                <div id="image_show" class="mt-3 col-md-3 pl-0">
                                    <a href="{{$slider->image}}" target="_blank">
                                        <img src="{{$slider->image}}" width="100%" class="img-thumbnail">
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label class="col-form-label">Trạng thái</label>
                                <div class="mt-2 ml-1 row">
                                    <div class="custom-control custom-radio col-5">
                                        <input class="custom-control-input" type="radio" value="1" id="active" name="active" {{$slider->active == 1 ? 'checked' : ''}}>
                                        <label for="active" class="custom-control-label font-weight-normal">Hiển thị</label>
                                    </div>
                                    <div class="custom-control custom-radio col-5">
                                        <input class="custom-control-input" type="radio" value="0" id="inactive" name="active" {{$slider->active == 0 ? 'checked' : ''}}>
                                        <label for="inactive" class="custom-control-label font-weight-normal">Ẩn</label>
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
        $('#edit-slider-form').validate({
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
                    required: "Vui lòng nhập tên slider",
                },
                upload: {
                    required: "Vui lòng thêm hình ảnh",
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