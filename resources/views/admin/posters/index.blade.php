@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">
                    الإعلانات

                    <div style="float:left">
                        <button type="button" class="btn btn-primary">
                            <a href="{{ route('posters.create') }}" style="color:#fff;">إضافة إعلان جديد</a>
                        </button>  
                    </div>
                </h3>

                <div class="card-body">
                    @if(session()->has('message'))
                        <div class="alert {{session('alert') ?? 'alert-info'}}">
                            {{ session('message') }}
                        </div>
                    @endif

                    <table class="table table-dark data-table">

                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">الراعى</th>
                                <th scope="col">الإسم</th>
                                <th scope="col">النوع</th>
                                <th scope="col">الوصف</th>
                                <th scope="col">تاريخ البدء</th>
                                <th scope="col">تاريخ الإنتهاء</th>
                                <th scope="col">العمليات</th>
                                <th scope="col">العمليات</th>
                            </tr>
                        </thead>
                          
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footer')
    <script type="text/javascript">

$(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('posters.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            /*{
                "data": "imageUrl",
                "render": function(data, type, row) {
                    return '<img src="storage/main/posters/'+row.image+'"  width="50" height="50" />';
                }
            },*/
            { 
            data: 'partner_name', 
            render: function (data, type, row) {
                        var details = row.commercial_name;
                        return details;
                    }
            },
            {data: 'name', name: 'name'},
            {data: 'type', name: 'type'},
            {data: 'description', name: 'description'},
            {data: 'start', name: 'start'},
            {data: 'end', name: 'end'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'actionone', name: 'actionone', orderable: false, searchable: false},
        ],
        dom: 'lBfrtip',
    });
    
  });


  $.fn.dataTable.ext.errMode = 'none';

    

    </script>
@endsection