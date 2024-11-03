@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">
                    نتائج المسابقة {{ $results[0]->competition->name }}
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
                                    <th scope="col">الإجابات الصحيحة</th>
                                    <th scope="col">الإجابات الخاطئة</th>
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
        ajax: "{{ route('results.index', Request::segment(2)) }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'user.name', name: 'user.name'},
            {data: 'right_answers', name: 'right_answers'},
            {data: 'wrong_answers', name: 'wrong_answers'},
            {data: 'points', name: 'points'},
        ],
        dom: 'lBfrtip',
    });
    
  });


  $.fn.dataTable.ext.errMode = 'none';

    

    </script>
@endsection