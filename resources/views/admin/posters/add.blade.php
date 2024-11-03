@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4 class="text-center">إضافة إعلان جديد</h4></div>

                <div class="card-body">

                    @if(session()->has('message'))
                        <div class="alert {{session('alert') ?? 'alert-info'}}">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('posters.store') }}" enctype="multipart/form-data">
                        @csrf


                        <div class="form-group row">
                            <label for="competitions" class="col-md-2 col-form-label text-md-right">المسابقة</label>
                        
                            <div class="col-md-10">
                                

                                <select name="competition_id" id="competition_id" class="form-control  @error('competition_id') is-invalid @enderror">

                                    <option value="" selected disabled>اختر المسابقة .....</option>
                                    @foreach ($competitions as $competition)
                                        <option value="{{ $competition->id }}">{{ $competition->name }}</option>
                                    @endforeach
    

                                </select>

                               

                                @error('competition_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                  
                        <div class="form-group row">
                            <label for="partners" class="col-md-2 col-form-label text-md-right">الراعي</label>
                        
                            <div class="col-md-10">
                                

                                <select name="partner_id" id="partner_id" class="form-control  @error('partner_id') is-invalid @enderror">

                                    <option value="" selected disabled>اختر الراعي .....</option>
                                    @foreach ($partners as $partner)
                                        <option value="{{ $partner->id }}">{{ $partner->commercial_name }}</option>
                                    @endforeach
    

                                </select>

                               

                                @error('partner_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="type" class="col-md-2 col-form-label text-md-right">النوع</label>

                            <div class="col-md-10">
                                <select name="type" id="type" class="form-control  @error('type') is-invalid @enderror" onchange="getScales(this)">

                                    <option value="" selected disabled>اختر النوع .....</option>
                                    <option>بـــــــانـــــــر</option>
                                    <option>شـــــــــاشــــــة كـــــــامــــــلــــــــة</option>


                                </select>

                               

                                @error('type')
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
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="3" value="{{ old('description') }}"  autocomplete="description"></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="start" class="col-md-2 col-form-label text-md-right">تاريخ البدء</label>

                            <div class="col-md-10">
                                <input id="start" type="date" class="form-control @error('start') is-invalid @enderror" name="start"  autocomplete="start">

                                @error('start')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="end" class="col-md-2 col-form-label text-md-right">تاريخ الإنتهاء</label>

                            <div class="col-md-10">
                                <input id="end" type="date" class="form-control @error('end') is-invalid @enderror" name="end"  autocomplete="end">

                                @error('end')
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
                                        <option value="{{ $country->id }}">{{ $country->arabic }}</option>
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




                        <div class="form-group row" id="the-scales">


                        </div>


                   
    
                                    

                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-primary col-md-12">
                                إضافة إعلان جديد
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
                var num = $(input).attr('class').split('_')[1];
                $('.image'+num+'').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }


        
        function getScales(item){
            axios.get('../../scales/0/'+item.value+'/add')
                .then((data) => {
                    $('#the-scales').empty()
                    for(scale of data.data){
                        $('#the-scales').append('<label for="scale" class="col-md-4 col-form-label text-md-left" style="margin-top:25px;">'+scale.measure+'</label>')
                        $('#the-scales').append('<div class="col-md-6" id="the_icon_'+scale.id+'">');
                        $('#the_icon_'+scale.id).append('<input type="file" class="posters_'+scale.id+'" onchange="changeImage(this)" name="posters['+scale.id+'][]">');
                        $('#the_icon_'+scale.id).append('<img src="{{ asset("admin/img/upload.png") }}" style="width:60px;height:60px;background-color: black;" class="image'+scale.id+'">')
                        $('#the_icon_'+scale.id).append('</div>');
                    }      
                })
        }

        function getSubCities(item){
            axios.get('../../areas/'+item.value)
                .then((data) => {
                $('#geo_id').empty()
                for(subcity of data.data){
                $('#geo_id').append('<option value="'+subcity.id+'">'+subcity.arabic+'</option>')
                }  
            })
        }
    </script>
    
@endsection