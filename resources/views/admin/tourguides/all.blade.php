@extends('admin.main')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
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
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{$menu}}</h3>
            <div class="col">
                <!-- <div class="float-left"> -->
                    <!-- <form action="" class="form-inline" role="form">
                        <div class="input-group input-group-sm" style="width: 250px">
                            <label for="keyword" class="sr-only"></label>
                            <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->
                    
                <!-- </div> -->
                <div class="float-right">
                    <!-- <a class="btn btn-default btn-sm mr-1" href="/admin/sliders/create">
                        <i class="fas fa-print mr-1"></i> <span>Excel</span> 
                    </a> -->
                    <button class="btn btn-danger btn-sm d-none" id="deleteAllBtn" onClick="removeAll('/admin/tourguides/destroy-selected', 'tourguides-table')">
                        Xóa
                    </button>
                </div>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body p-3 table-responsive">
            <table class="table table-hover table-bordered table-striped" style="margin-top: 6px !important;" id="tourguides-table">
                <thead>
                    <tr>
                        <th style="width:2%"><input type="checkbox" name="main_checkbox"><label></label></th>
                        <th style="width:5%">STT</th>
                        <th>Họ tên</th>
                        <th>Ngày sinh</th>
                        <th>Giới tính</th>
                        <th>Email</th>
                        <th>SDT</th>
                        <th style="width:8%" class="text-center">Hình ảnh</th>
                        <th>Giá thuê</th>
                        <th class="text-center" style="width:10%">Sửa/Xóa</th>
                    </tr>
                </thead>
                    @foreach($tourguides as $key => $tourguide)
                        <tr id="{{$tourguide->id}}" name="item">
                            <td>
                                <input type="checkbox" id="item_checkbox" name="item_checkbox" data-id="{{$tourguide->id}}">
                                <!-- <label for="slider_checkbox"></label> -->
                            </td>
                            <td>{{$key + 1}}.</td>
                            <td>{{$tourguide->name}}</td>
                            <td>{{$tourguide->dob}}</td>
                            @if($tourguide->gender === 0)
                                <td>Nam</td>
                            @else
                                <td>Nữ</td>
                            @endif
                           
                            <td>{{$tourguide->email}}</td>
                            <td>{{$tourguide->phone}}</td>
                            <td class="text-center">
                                <a class="btn btn-primary btn-sm " href="/admin/tourguides/galleries/{{$tourguide->id}}">
                                    <span class="font-weight-bold">Xem</span>
                                </a>
                            </td>
                            
                            <td class="money" id="rental_price">{{number_format($tourguide->rental_price, 0, '', '.')}} VNĐ</td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm " href="/admin/tourguides/edit/{{$tourguide->id}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger btn-sm" href="#"
                                    onClick="removeRow('{{$tourguide->id}}', '/admin/tourguides/destroy', 'tourguides-table')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                   @endforeach
                <tbody>
                    
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="row card-footer clearfix" id="count">
            <div class="col-md-6 mt-1">
                <?php $count = count($tourguides); ?>
                <?php if($count === 0) : ?>
                    <strong>Chưa có dữ liệu</strong>
                <?php else : ?>
                    <strong>Số lượng: {{$count}}</strong>
                <?php endif; ?>
            </div>
            <div class="col-md-6">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end mb-0">
                        {!! $tourguides->appends(request()->all())->links() !!}
                    </ul>
                </nav>
            </div>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
</section>
@endsection

@section('footer')
<script>
    $(function () {
        $('#tourguides-table').DataTable({
            "paging": false,
            "lengthChange": false,
            // "searching": false,
            "info": false,
        
            "aaSorting": [],
            columnDefs: [
                {
                    orderable: false,
                    targets: 0,
                },
                {
                    orderable: false,
                    targets: 5,
                }, {
                    orderable: false,
                    targets: 6,
                }, {
                    orderable: false,
                    targets: 7,
                }, {
                    orderable: false,
                    targets: 9,
                }
            ],
            "autoWidth": false,
            "responsive": true,
            "buttons": ["excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#tourguides-table_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection