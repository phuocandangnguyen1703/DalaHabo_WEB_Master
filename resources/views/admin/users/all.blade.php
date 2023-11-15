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
                    <button class="btn btn-danger btn-sm d-none" id="deleteAllBtn" onClick="removeAll('/admin/users/destroy-selected', 'users-table')">
                        Xóa
                    </button>
                </div>
            </div>
        </div>
        <!-- /.card-header -->

        <div class="card-body p-3 table-responsive">
        
            <table class="table table-hover table-bordered table-striped" style="margin-top: 6px !important;" id="users-table">
                <thead>
                    <tr>
                        <th style="width:2%"><input type="checkbox" name="main_checkbox"><label></label></th>
                        <th style="width:5%">STT</th>
                        <th style="width:17%">Tên hiển thị</th>
                        <th style="width:17%">Email</th>
                        <th style="width:10%">SĐT</th>
                        <th style="width:10%">Vai trò</th>
                        <th style="width:15%">Ngày tạo</th>
                        <th style="width:15%">Ngày cập nhật</th>
                        <th style="width:10%" class="text-center">Sửa/ Xóa</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($accounts as $key => $account)
                    <tr id="{{$account->id}}" name="item">
                        @if($account->role->name != 'Admin')
                        <td>
                            <input type="checkbox" id="item_checkbox" name="item_checkbox" data-id="{{$account->id}}">
                            <!-- <label for="slider_checkbox"></label> -->
                        </td>
                        @else
                        <td><input type="checkbox" id="disabled_checkbox" name="disabled_checkbox" data-id="{{$account->id}}" disabled>
                            <!-- <label for="slider_checkbox"></label> --></td>
                        @endif
                        <td>{{$key + 1}}.</td>
                        <td>{{$account->name}}</td>
                        <td>{{$account->email}}</td>
                        <td>{{$account->phone}}</td>
                        <td>{{$account->role->name}}</td>
                        <td>{{$account->created_at}}</td>
                        <td>{{$account->updated_at}}</td>
                        <td class="text-center">
                            @if($account->id === Auth::user()->id || $account->role->name === 'Admin')    
                            @else
                                <a class="btn btn-info btn-sm " href="/admin/users/edit/{{$account->id}}">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <a class="btn btn-danger btn-sm" href="#"
                                    onClick="removeRow('{{$account->id}}', '/admin/users/destroy', 'users-table')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer clearfix row">
            <div class="col-md-6 mt-1" id="count">
                <?php $count = count($accounts); ?>
                <?php if($count === 0) : ?>
                    <strong>Chưa có dữ liệu</strong>
                <?php else : ?>
                    <strong>Số lượng: {{$count}}</strong>
                <?php endif; ?>
            </div>

            <div class="col-md-6">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end mb-0">
                        {!! $accounts->appends(request()->all())->links() !!}
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
        $('#users-table').DataTable({
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
                    targets: 8,
                },
            ],
            "autoWidth": false,
            "responsive": true,
            "buttons": ["excel", "pdf", "print", "colvis"],
        }).buttons().container().appendTo('#users-table_wrapper .col-md-6:eq(0)');
    });
</script>
@endsection