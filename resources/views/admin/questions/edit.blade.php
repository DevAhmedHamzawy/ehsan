@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4 class="text-center">التعديل على السؤال</h4></div>

                <div class="card-body">

                    @if(session()->has('message'))
                        <div class="alert {{session('alert') ?? 'alert-info'}}">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('questions.update', $question->id) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf


                        <div class="form-group row">
                            <label for="categories" class="col-md-2 col-form-label text-md-right">التصنيف</label>
                        
                            <div class="col-md-10">
                                

                                <select name="category_id" id="category_id" class="form-control">

                                    <option value="" selected disabled>اختر التصنيف .....</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if($category->id == $question->category_id) selected @endif>{{ $category->name }}</option>
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
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $question->name }}"  autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @php
                            $j = 0;
                        @endphp
                        @foreach ($question->answers as $answer)


                            <div class="form-group row" style="margin: 10px 16% 0 0">

                            
                                <div class="col-md-10">
                                    <input id="answers" type="text" class="form-control @error('answers') is-invalid @enderror" name="answers[]" value="{{ $answer->name }}" placeholder="الإجابة {{ $j+1 }}"  autocomplete="answers">
                                    @error('answers')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="col-md-2">
                                    <input type="radio" name="right" value="{{$j+1}}" @if($answer->right == 1) checked  @endif>
                                </div>
                            </div>
                    
                            @php
                                $j++;
                            @endphp
                        @endforeach



                     
    
                

                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-primary col-md-12">
                                التعديل على السؤال
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
    </script>
    
@endsection