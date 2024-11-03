@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">
                   القرعات 
                </h3>

                <div class="card-body">
                    @if(session()->has('message'))
                        <div class="alert {{session('alert') ?? 'alert-info'}}">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if (empty($spinwheels))
                        <p>لا توجد نتائج</p>
                    @else
                        <table class="table table-dark data-table">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">المستخدم</th>
                                    <th scope="col">التاريخ</th>
                                </tr>
                            </thead>
                            
                        </table>
                    @endif
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
        ajax: "{{ route('spinwheels.get') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'user.name', name: 'user.name'},
            {data: 'created_at', name: 'created_at'},
        ],
        dom: 'lBfrtip',
    });
    
  });


  $.fn.dataTable.ext.errMode = 'none';

    

    </script>
@endsection