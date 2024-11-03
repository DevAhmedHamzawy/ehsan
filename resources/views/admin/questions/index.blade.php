@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">
                   الأسئلة

                    <div class="row" style="float:left">
                        <button type="button" class="btn btn-primary">
                            <a href="{{ route('questions.create') }}" style="color:#fff;">إضافة سؤال جديد</a>
                        </button>  

                        <form action="{{ route('excel') }}" id="excel-form" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="file" name="file" id="my_file" style="display: none">
                            <input type="button" id="get_file" class="btn btn-success" value="تحميل من ملف excel" /> 
                        </form>
                        
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
                                <th scope="col">الإسم</th>
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

<script>
    document.getElementById('get_file').onclick = function() {
        document.getElementById('my_file').click();
    };

    $("#my_file").change(function() {
        $('#excel-form').submit();
    });
</script>
    <script type="text/javascript">

$(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('questions.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            {data: 'actionone', name: 'actionone', orderable: false, searchable: false},
        ],
        dom: 'lBfrtip',
    });
    
  });


  $.fn.dataTable.ext.errMode = 'none';

    

    </script>
@endsection