@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4 class="text-center">التعديل على الإعلان</h4></div>

                <div class="card-body">

                    @if(session()->has('message'))
                        <div class="alert {{session('alert') ?? 'alert-info'}}">
                            {{ session('message') }}
                        </div>
                    @endif


                    <form method="POST" action="{{ route('posters.update', [$poster->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf


                        <div class="form-group row">
                            <label for="competitions" class="col-md-2 col-form-label text-md-right">المسابقة</label>
                        
                            <div class="col-md-10">
                                

                                <select name="competition_id" id="competition_id" class="form-control @error('competition_id') is-invalid @enderror">

                                    <option value="" selected disabled>اختر المسابقة .....</option>
                                    @foreach ($competitions as $competition)
                                        <option value="{{ $competition->id }}" @if($competition->id == $poster->competition_id) selected @endif>{{ $competition->name }}</option>
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
                                

                                <select name="partner_id" id="partner_id" class="form-control @error('partner_id') is-invalid @enderror">

                                    @foreach ($partners as $partner)
                                        <option value="{{ $partner->id }}" @if($partner->id === $poster->partner_id) selected  @endif>{{ $partner->commercial_name }}</option>
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
                            <label for="name" class="col-md-2 col-form-label text-md-right">النوع</label>

                            <div class="col-md-10">
                                <select name="type" id="type" class="form-control @error('type') is-invalid @enderror" onchange="getScales(this)">

                                    <option value="" selected disabled>اختر النوع .....</option>
                                    <option @if($poster->type == 'بـــــــانـــــــر') selected   @endif>بـــــــانـــــــر</option>
                                    <option @if($poster->type == 'شـــــــــاشــــــة كـــــــامــــــلــــــــة') selected   @endif>شـــــــــاشــــــة كـــــــامــــــلــــــــة</option>


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
                                <input id="name" type="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $poster->name }}"  autocomplete="name">

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
                                <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" cols="30" rows="3"  autocomplete="description">{{ $poster->description }}</textarea>
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
                                <input id="start" type="date" value="{{ $poster->start }}" class="form-control @error('start') is-invalid @enderror" name="start"  autocomplete="start">

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
                                <input id="end" type="date" value="{{ $poster->end }}" class="form-control @error('end') is-invalid @enderror" name="end"  autocomplete="end">

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


                       

                        <div class="form-group row" id="the-scales">

            
                           

                        </div>


                       

                   
    
                                    

                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-primary col-md-12">
                                التعديل على الإعلان
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
            item.value = '{!! $poster->type !!}'; 
            getScales(item);

            item.value = '{!! $theCountry !!}';
            getSubCities(item);
        });

        
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

            let v = 0;
            if(item.value == 'بـــــــانـــــــر') {  v = 0 } else {  v = 1; }
            
            axios.get('../../scales/{!! $poster->id !!}/'+item.value+'/edit')
                .then((data) => {
                    $('#the-scales').empty()
                    for(scale of data.data[0]){
                            $('#the-scales').append('<label for="scale" class="col-md-4 col-form-label text-md-left" style="margin-top:25px;">'+scale.measure+'</label>')
                            $('#the-scales').append('<div class="col-md-6" id="the_icon_'+scale.id+'">');
                            $('#the_icon_'+scale.id).append('<input type="file" class="posters_'+scale.id+'" onchange="changeImage(this)" name="posters['+scale.id+'][]">');
                            $('#the_icon_'+scale.id).append('<img src="{{ asset("admin/img/upload.png") }}" style="width:60px;height:60px;background-color: black;" class="image'+scale.id+'">')
                            $('#the_icon_'+scale.id).append('</div>');
                            if(v === data.data[1][0].type){
                                for (image of data.data[1]) {
                                    if(image.measure == scale.measure){
                                        $('#the-scales').append('<img src="{{ asset("/") }}'+image.img_path+'" style="width:60px;height:60px;background-color: black;">')
                                    }
                                }
                            }
                    }      
                })
        }


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