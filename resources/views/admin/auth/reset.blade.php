<!DOCTYPE html>
<html lang="en">
<head>
  @include('admin.header')
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h2"><b>DalaHabo Admin</b></a>
            </div>
            <div class="card-body">
                <h4 style="padding-bottom: 8px;" class="text-center">Đặt lại mật khẩu</h4>
                @include('admin.alert')
                <form action="" method="post" id="form">
                    @php
                        $email = $_GET['email'];
                        $token = $_GET['token'];
                    @endphp
                    <div class="form-group input-group mb-3">
                        <input type=hidden name="email" value="{{$email}}">
                        <input type=hidden name="token" value="{{$token}}">  
                        <input type="password" name="password" class="form-control" placeholder="Mật khẩu mới" id="password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group input-group mb-3">
                        <input type="password" name="confirm_password" class="form-control" placeholder="Xác nhận mật khẩu">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Đặt lại mật khẩu</button>
                        </div>
                    </div>
                    @csrf
                </form>

                <p class="mt-3 mb-1">
                    <a href="/admin/login">Đăng nhập</a>
                </p>
            </div> 
        </div>
    </div>
@include('admin.footer')
<script>
    $(function () {
        $('#form').validate({
            rules: {
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
                password: {
                    minlength : "Mật khẩu phải chứa ít nhất 8 ký tự",
                    required: "Vui lòng nhập mật khẩu",
                },
                confirm_password: {
                    required: "Vui lòng xác nhận mật khẩu",
                    equalTo: "Mật khẩu không khớp. Vui lòng xác nhận lại mật khẩu.",
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
</body>
</html>