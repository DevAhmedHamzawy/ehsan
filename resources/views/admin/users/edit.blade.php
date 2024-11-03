@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h1 class="text-center">التعديل على بيانات المستخدم</h1></div>

                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('users.update', [$user->id]) }}">
                        @method('PUT')
                        @csrf


                        <div class="form-group row">
                            <div class="col-md-12">
                                <img src="" alt="">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">إسم المستخدم</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       

                        <div class="form-group row">
                            <label for="first_name" class="col-md-2 col-form-label text-md-right">الإسم الأول</label>

                            <div class="col-md-10">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="second_name" class="col-md-2 col-form-label text-md-right">إسم المستخدم</label>

                            <div class="col-md-10">
                                <input id="second_name" type="text" class="form-control @error('second_name') is-invalid @enderror" name="second_name" value="{{ $user->second_name }}" required autocomplete="second_name" autofocus>

                                @error('second_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="third_name" class="col-md-2 col-form-label text-md-right">إسم المستخدم</label>

                            <div class="col-md-10">
                                <input id="third_name" type="text" class="form-control @error('third_name') is-invalid @enderror" name="third_name" value="{{ $user->third_name }}" required autocomplete="third_name" autofocus>

                                @error('third_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-2 col-form-label text-md-right">الإسم الأخير</label>

                            <div class="col-md-10">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->third_name }}" required autocomplete="last_name" autofocus>

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="mobile" class="col-md-2 col-form-label text-md-right">رقم الجوال</label>

                            <div class="col-md-10">
                                <input id="mobile" type="number" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $user->mobile }}" required autocomplete="mobile" autofocus>

                                @error('mobile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">البريد الإلكترونى</label>

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label text-md-right">كلمة المرور</label>

                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="countries" class="col-md-2 col-form-label text-md-right">الدول</label>
                        
                            <div class="col-md-10">
                                

                                <select  onchange="getSubCities(this);" class="form-control">

                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}"  @if($theCountry == $country->id) selected @endif>{{ $country->arabic }}</option>
                                    @endforeach

                                </select>

                               

                                
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="cities" class="col-md-2 col-form-label text-md-right">المدينة</label>
                        
                            <div class="col-md-10">
                                

                                <select class="geo_id form-control" name="geo_id" id="geo_id"></select>
                                

                                </select>

                               

                                @error('geo_id')
                                    <span class="invalid-feedback" country="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-primary col-md-12">
                                تـــــعـــديـــل
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

        $(document).ready(function () {
            let item = {};
            item.value = '{!! $theCountry !!}';
            getSubCities(item);
        });


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

        function getSubCities(item){
            axios.get('../../areas/'+item.value)
                .then((data) => {
                $('#geo_id').empty()
                for(subcity of data.data){
                    if(subcity.id == {!! $theCity->id !!}){
                        $('#geo_id').append('<option value="'+subcity.id+'" selected>'+subcity.arabic+'</option>')
                    }else{
                        $('#geo_id').append('<option value="'+subcity.id+'">'+subcity.arabic+'</option>')
                    }
                }  
            })
        }
    </script>
    
@endsection


@section('footer')

    <script>

        $(document).ready(function () {
            let item = {};
            item.value = '{!! $theCountry !!}';
            getSubCities(item);
        });


        

        function getSubCities(item){
            axios.get('../../areas/'+item.value)
                .then((data) => {
                $('#geo_id').empty()
                for(subcity of data.data){
                    if(subcity.id == {!! $theCity->id !!}){
                        $('#geo_id').append('<option value="'+subcity.id+'" selected>'+subcity.arabic+'</option>')
                    }else{
                        $('#geo_id').append('<option value="'+subcity.id+'">'+subcity.arabic+'</option>')
                    }
                }  
            })
        }
    </script>
    
@endsection