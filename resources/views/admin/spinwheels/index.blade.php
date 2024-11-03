@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">
                   أعلى النقاط


                   <div style="float:left">
                        <button type="button" class="btn btn-primary">
                            <a href="{{ route('spinwheels.create') }}" style="color:#fff;">إجراء قرعة</a>
                        </button>  
                    </div>
                </h3>

                <div class="card-body">
                    @if(session()->has('message'))
                        <div class="alert {{session('alert') ?? 'alert-info'}}">
                            {{ session('message') }}
                        </div>
                    @endif

                    @if (empty($results))
                        <p>لا توجد نتائج</p>
                    @else
                        <table class="table table-dark data-table">

                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">المستخدم</th>
                                    <th scope="col">عدد النقاط</th>
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
        ajax: "{{ route('spinwheels.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'points', name: 'points'},
        ],
        dom: 'lBfrtip',
    });
    
  });


  $.fn.dataTable.ext.errMode = 'none';

    

    </script>
@endsection