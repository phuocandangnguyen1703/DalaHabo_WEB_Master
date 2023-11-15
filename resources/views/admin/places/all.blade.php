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
                <!-- <div class="float-left">
                    <form action="" class="form-inline" role="form">
                        <div class="input-group input-group-sm" style="width: 250px">
                            <label for="keyword" class="sr-only"></label>
                            <input type="text" class="form-control" name="keyword" placeholder="Tìm kiếm">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div> -->
                <div class="float-right">
                    <!-- <a class="btn btn-default btn-sm mr-1" href="/admin/sliders/create">
                        <i class="fas fa-print mr-1"></i> <span>Excel</span> 
                    </a> -->
                    <button class="btn btn-danger btn-sm d-none" id="deleteAllBtn" onClick="removeAll('/admin/places/destroy-selected', 'places-table')">
                        Xóa
                    </button>
                </div>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body p-3 table-responsive">
            <table class="table table-hover table-bordered table-striped" style="margin-top: 6px !important;" id="places-table">
                <thead>
                    <tr>
                        <th style="width:2%"><input type="checkbox" name="main_checkbox"><label></label></th>
                        <th style="width:5%">STT</th>
                        <th style="width:15%">Tên địa điểm</th>
                        <th style="width:10%">Danh mục</th>
                        <th style="width:40%">Địa chỉ</th>
                        <th style="width:10%" class="text-center">Hình ảnh</th>
                        <th style="width:10%" class="text-center">Sửa/ Xóa</th>
                    </tr>
                </thead>
                    
                <tbody>
                    @foreach($places as $key => $place)
                        <tr id="{{$place->id}}" name="item">
                            <td>
                                <input type="checkbox" id="item_checkbox" name="item_checkbox" data-id="{{$place->id}}">
                                <!-- <label for="slider_checkbox"></label> -->
                            </td>
                            <td>{{$key + 1}}.</td>
                            <td>{{$place->name}}</td>
                            <td>{{$place->category->name}}</td>
                            <td>{{$place->address}}</td>
                            <td class="text-center">
                                <a class="btn btn-primary btn-sm " href="/admin/places/galleries/{{$place->id}}">
                                    <span class="font-weight-bold">Xem</span>
                                </a>
                            </td>
                            <td class="text-center">
                                <a class="btn btn-info btn-sm " href="/admin/places/edit/{{$place->id}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a class="btn btn-danger btn-sm" href="#"
                                    onClick="removeRow('{{$place->id}}', '/admin/places/destroy', 'places-table')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer clearfix">
            <div class="row">
                <div class="col-md-6 mt-1" id="count">
                    <?php $count = count($places); ?>
                    <?php if($count === 0) : ?>
                        <strong>Chưa có dữ liệu</strong>
                    <?php else : ?>
                        <strong>Số lượng: {{$count}}</strong>
                    <?php endif; ?>
                </div>
                
                <div class="col-md-6">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-end mb-0">
                           {!! $places->appends(request()->all())->links() !!}
                        </ul>
                    </nav>
                </div>
                
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
    $('#places-table').DataTable({
        "paging": false,
        "lengthChange": false,
        // "searching": false,
        "info": false,
      
        "aaSorting": [],
        columnDefs: [
            {
                orderable: false,
                targets: 0,
            }, {
                orderable: false,
                targets: 4,
            }, {
                orderable: false,
                targets: 5,
            }, {
                orderable: false,
                targets: 6,
            }
        ],
        "autoWidth": false,
        "responsive": true,
        "buttons": ["excel", "pdf", "print", "colvis"],
  }).buttons().container().appendTo('#places-table_wrapper .col-md-6:eq(0)');
});
</script>
@endsection