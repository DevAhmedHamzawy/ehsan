@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4 class="text-center">إضافة مسابقة جديد</h4></div>

                <div class="card-body">

                    @if(session()->has('message'))
                        <div class="alert {{session('alert') ?? 'alert-info'}}">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('competitions.store') }}" enctype="multipart/form-data">
                        @csrf


                        @if (auth()->user()->role == 0)
                            

                        <div class="col-md-12" id="the_icon">
                            <img src="{{ asset('admin/img/upload.png') }}" style="width:60px;height:60px;margin: 16px 47%;background-color: black;" class="rounded-circle" onclick="document.getElementById('image').click()" alt="Cinque Terre">
                            <h5 class="text-center">إرفع صورة من هنا</h5>
                            <input  style="display: none;"  id="image" type="file" name="the_image">
                        </div>


                        <div class="form-group row">
                            <label for="categories" class="col-md-2 col-form-label text-md-right">التصنيف</label>
                        
                            <div class="col-md-10">
                                

                                <select name="category_id" id="category_id" class="form-control">

                                    <option value="" selected disabled>اختر التصنيف .....</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
    

                                </select>

                               

                                @error('categories')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">الإسم</label>

                            <div class="col-md-10">
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name"  autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">الوصف</label>
                        
                            <div class="col-md-10">
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="10" value="{{ old('description') }}"  autocomplete="description"></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="prize" class="col-md-2 col-form-label text-md-right">الجائزة</label>
                        
                            <div class="col-md-10">
                                <textarea name="prize" id="prize" class="form-control @error('prize') is-invalid @enderror" cols="30" rows="10" value="{{ old('prize') }}"  autocomplete="prize"></textarea>
                                @error('prize')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



        


                        
                    <div class="form-group row">
                        <label for="points" class="col-md-2 col-form-label text-md-right">عدد النقاط فى المسابقة</label>
                    
                        <div class="col-md-10">
                            <input id="points" type="number" class="form-control @error('points') is-invalid @enderror" name="points" value="{{ old('points') }}"  autocomplete="points">
                            @error('points')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 


                    <div class="form-group row">
                        <label for="min_ans" class="col-md-2 col-form-label text-md-right">أقل عدد للأجوبة الصحيحة</label>
                    
                        <div class="col-md-10">
                            <input id="min_ans" type="number" class="form-control @error('min_ans') is-invalid @enderror" name="min_ans" value="{{ old('min_ans') }}"  autocomplete="min_ans">
                            @error('min_ans')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 


                    <div class="form-group row">
                        <label for="time_question_second" class="col-md-2 col-form-label text-md-right">الزمن بين الأسئلة بالثوانى</label>
                    
                        <div class="col-md-10">
                            <input id="time_question_second" type="number" class="form-control @error('time_question_second') is-invalid @enderror" name="time_question_second" value="{{ old('time_question_second') }}"  autocomplete="time_question_second">
                            @error('time_question_second')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div> 

                    {{--
                    عدد النقاط لكل سؤال يكون
                    <div id="question_point"></div>
                    --}}

                    
                    @endif


              
                 
    
                                    

                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-primary col-md-12">
                                إضافة مسابقة جديد
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('footer')

    <script>
        function changeImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('.rounded-circle').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }

        $("#image").change(function() {
            changeImage(this);
        });


        $('#points').keyup(function(){
            console.log(this.value);
            $('#question_point').html(this.value/10);
        });
    </script>
    
@endsection