@extends('admin.main')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h1>{{$menu}}</h1>
            </div>
        </div>
    </div>
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2dot4 col-6">
                <!-- small card -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <?php if($places < 10) : ?>
                            <h3>0{{$places}}</h3>
                        <?php else : ?>
                            <h3>{{$places}}</h3>
                        <?php endif; ?>
                        <p>Địa điểm</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <a href="/admin/places/all" class="small-box-footer">
                        Chi tiết <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-2dot4 col-6">
                <!-- small card -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <?php if($tourguides < 10) : ?>
                            <h3>0{{$tourguides}}</h3>
                        <?php else : ?>
                            <h3>{{$tourguides}}</h3>
                        <?php endif; ?>
                        <p>Hướng dẫn viên</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <a href="/admin/tourguides/all" class="small-box-footer">
                        Chi tiết <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-2dot4 col-6">
                <!-- small card -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>65</h3>
                        <p>Khách hàng</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Chi tiết <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-2dot4 col-6">
                <!-- small card -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>120</h3>
                        <p>Đơn đặt hẹn</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <a href="#" class="small-box-footer">
                        Chi tiết <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->

            <div class="col-lg-2dot4 col-6">
                <!-- small card -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>50</h3>
                        <p>Bài viết</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-blog"></i>
                    </div>
                    <a href="/admin/blogs/all" class="small-box-footer">
                        Chi tiết <i class="fas fa-arrow-circle-right"></i>
                    </a>
                </div>
            </div>
            <!-- ./col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection