@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header">
                   المسابقات


                   @if (auth()->user()->role == 0)

                    <div style="float:left">
                        <button type="button" class="btn btn-primary">
                            <a href="{{ route('competitions.create') }}" style="color:#fff;">إضافة مسابقة جديد</a>
                        </button>  
                    </div>

                    @endif
                </h3>

                <div class="card-body">
                    @if(session()->has('message'))
                        <div class="alert {{session('alert') ?? 'alert-info'}}">
                            {{ session('message') }}
                        </div>
                    @endif


                    <form action="{{ route('competitions.search') }}" method="post">
                        @csrf
                        <p id="date_filter" style="margin-right: 91px;">
                            <span id="date-label-from" class="date-label">من: </span><input class="date_range_filter date form-control" type="date" name="from" id="datepicker_from" />
                            <span id="date-label-to" class="date-label">إلى:<input class="date_range_filter date form-control" type="date" name="to" id="datepicker_to" />
                            <button type="submit" class="col-md-12 btn btn-primary">فلترة بالتاريخ</button>
                        </p>
                    </form>
                  

                    <table class="table table-dark data-table">

                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">الإسم</th>
                                <th scope="col">التصنيف</th>
                                <th scope="col">الجائزة</th>
                                <th scope="col">النقاط</th>
                                <th scope="col">الأجوبة الصحيحة</th>
                                <th scope="col">الزمن بين الأسئلة</th>
                                <th scope="col">التاريخ</th>
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
        ajax: "{{ route('competitions.index') }}",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'category.name', name: 'category.name'},
            {data: 'prize', name: 'prize'},
            {data: 'points', name: 'points'},
            {data: 'min_ans', name: 'min_ans'},
            {data: 'time_question_second', name: 'time_question_second'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        dom: 'lBfrtip',
    });
  });

  $.fn.dataTable.ext.errMode = 'none';


    </script>


@endsection