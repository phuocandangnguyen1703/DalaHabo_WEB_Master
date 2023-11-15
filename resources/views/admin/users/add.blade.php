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
                <form action="/admin/users/create" method="POST" id="add-user-form">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label for="email" class="col-form-label">Email đăng nhập</label>
                                <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="Email đăng nhập">
                                <span class="error invalid-feedback email_error"></span>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label for="password" class="col-form-label">Mật khẩu</label>
                                <input type="password" name="password" class="form-control" placeholder="Mật khẩu" id="password">
                                <span class="error invalid-feedback password_error"></span>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-md-11">
                                <label for="confirm_password" class="col-form-label">Xác nhận mật khẩu</label>
                                <input type="password" name="confirm_password" class="form-control" placeholder="Xác nhận mật khẩu">
                                <span class="error invalid-feedback confirm_password_error"></span>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="form-group col-md-5">
                                <label for="name" class="col-form-label">Tên người dùng</label>
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="Tên người dùng">
                                <span class="error invalid-feedback name_error"></span>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="role_id" class="col-form-label">Vai trò</label>
                                <select name="role_id" class="form-control" aria-label="role">    
                                    @foreach ($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="phone" class="col-form-label">Số điện thoại</label>
                                <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="Số điện thoại">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-11">
                                <label class="col-form-label">Hình ảnh</label>
                                <div class="form-group custom-file">
                                    <input type="file" class="custom-file-input"  name="upload" id="upload" accept="image/*"> 
                                    <label class="custom-file-label" for="upload" name="file" id="file"></label>
                                    <input type="hidden" name="image" id="image">
                                    <input type="hidden" name="folder" value="users" id="folder">
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
    $(function () {
        $('#add-user-form').validate({
            rules: {
                name: {
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    minlength : 8,
                    required: true,
                },
                confirm_password: {
                    required: true,
                    equalTo: "#password"
                },
            },
            messages: {
                name: {
                    required: "Vui lòng nhập tên hiển thị",
                },
                email: {
                    required: "Vui lòng nhập email đăng nhập",
                    email: "Email không hợp lệ",
                },
                password: {
                    minlength : "Mật khẩu phải chứa ít nhất 8 ký tự",
                    required: "Vui lòng nhập mật khẩu",
                },
                confirm_password: {
                    required: "Vui lòng xác nhận mật khẩu",
                    equalTo: "Mật khẩu không khớp. Vui lòng xác nhận lại mật khẩu."
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