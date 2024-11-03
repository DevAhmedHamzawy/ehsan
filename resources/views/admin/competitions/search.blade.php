@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h3 class="card-header text-center">
                   عدد المسابقات بين {{ $from }} {{ $to }}
                    <br><br><br>
                   {{ count($competitions) }} مسابقة

                    <br>
                    <div style="margin-right:42%;">
                        <button type="button" class="btn btn-primary">
                            <a href="{{ route('competitions.index') }}" style="color:#fff;">عودة للمسابقات</a>
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

                        @forelse ($competitions as $competition)

                        <tbody>

                            <tr>
                                <td scope="row">#</td>
                                <td>{{ $competition->name }}</td>
                                <td>{{ $competition->category->name }}</td>
                                <td>{{ $competition->prize }}</td>
                                <td>{{ $competition->points }}</td>
                                <td>{{ $competition->min_ans }}</td>
                                <td>{{ $competition->time_question_second }}</td>
                                <td>{{ $competition->created_at }}</td>
                                <td>
                                    <a href="{{ route("competitions.edit", [$competition->id])}}" class="edit btn btn-primary btn-sm"><i class="material-icons icon">create</i></a>
                                    <a href="{{ route("competitions.delete", [$competition->id]) }}" class="delete btn btn-danger btn-sm"><i class="material-icons icon">delete</i></a>
                                    <a href="{{ route("competitionposters.index", [$competition->id]) }}" class="edit btn btn-warning btn-sm"><i class="material-icons icon">visibility</i></a>
                                    <a href="{{ route("results.index", [$competition->id]) }}" class="edit btn btn-primary btn-sm"><i class="material-icons icon">radio_button_checked</i></a>
                                    <a href="{{ route("contributors.index", [$competition->id]) }}" class="edit btn btn-primary btn-sm"><i class="material-icons icon">person</i></a>
                                </td>
                            </tr>
                           
                        </tbody>

                        @empty
                        <li class="list-group-item">
                            لا توجد نتائج
                        </li>
                    @endforelse
                          
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection