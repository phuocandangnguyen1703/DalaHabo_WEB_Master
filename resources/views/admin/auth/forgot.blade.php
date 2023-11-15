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
                <h4 class="mb-1 text-center">Đặt lại mật khẩu</h4>
                @include('admin.alert')
                <form action="" method="POST" id="form">
                    <div class="form-group">
                        <label for="email" class="col-form-label font-weight-normal">Vui lòng nhập email của bạn:</label>
                        <!-- <label for="email" class="col-form-label mb-2 pt-0 pb-0">Email:</label> -->
                        <input type="email" class="form-control" name="email" placeholder="Nhập email đăng nhập của bạn" value="{{old('email')}}">
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Gửi email xác nhận</button>
                        </div>
                    </div>
                    @csrf
                </form>
                <p class="mt-3 mb-1">
                    <a href="/admin/login">Đăng nhập</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
@include('admin.footer')
<script>
    $(function() {
        $('#form').validate({
            rules: {
                email: {
                    required: true,
                },
            },
            messages: {
                email: {
                    required: "Vui lòng nhập email đăng nhập của bạn",
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