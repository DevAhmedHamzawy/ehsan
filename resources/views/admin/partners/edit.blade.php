@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4 class="text-center">التعديل على الراعي</h4></div>

                <div class="card-body">

                    @if(session()->has('message'))
                        <div class="alert {{session('alert') ?? 'alert-info'}}">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('partners.update', $partner->id) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf


                        <div class="col-md-12" id="the_icon">
                            <img src="{{ $partner->img_path }}" style="width:60px;height:60px;margin: 16px 47%;background-color: black;" class="rounded-circle" onclick="document.getElementById('image').click()" alt="Cinque Terre">
                            <h5 class="text-center">عدل الصورة من هنا</h5>
                            <input  style="display: none;"  id="image" type="file" name="the_image">
                        </div>

                        



                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">الإسم</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $partner->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" country="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="commercial_name" class="col-md-2 col-form-label text-md-right">الإسم التجارى</label>

                            <div class="col-md-10">
                                <input id="commercial_name" type="text" class="form-control @error('commercial_name') is-invalid @enderror" name="commercial_name" value="{{ $partner->commercial_name }}" required autocomplete="commercial_name" autofocus>

                                @error('commercial_name')
                                    <span class="invalid-feedback" country="alert">
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
                                        <option value="{{ $country->id }}" @if($theCountry == $country->id) selected @endif>{{ $country->arabic }}</option>
                                    @endforeach

                                </select>

                               

                               
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="cities" class="col-md-2 col-form-label text-md-right">المدينة</label>
                        
                            <div class="col-md-10">
                                

                                <select class="form-control geo_id" name="geo_id" id="geo_id"></select>
                                

                                </select>

                               

                                @error('geo_id')
                                    <span class="invalid-feedback" country="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="mobile" class="col-md-2 col-form-label text-md-right">رقم الجوال</label>

                            <div class="col-md-10">
                                <input id="mobile" type="number" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{ $partner->mobile }}" required autocomplete="mobile" autofocus>

                                @error('mobile')
                                    <span class="invalid-feedback" country="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">البريد الإلكترونى</label>

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $partner->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" country="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <div class="form-group row">
                            <label for="description" class="col-md-2 col-form-label text-md-right">الوصف</label>
                        
                            <div class="col-md-10">
                                <input id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $partner->description }}"  autocomplete="description">
                        
                                @error('description')
                                    <span class="invalid-feedback" country="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="payment_method" class="col-md-2 col-form-label text-md-right">طريقة الدفع</label>
                        
                            <div class="col-md-10">
                                <input id="payment_method" type="payment_method" class="form-control @error('payment_method') is-invalid @enderror" name="payment_method" value="{{ old('payment_method') }}"  autocomplete="payment_method">
                        
                                @error('payment_method')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


               
                

                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-primary col-md-12">
                                التعديل على الراعي
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