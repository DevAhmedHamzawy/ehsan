@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4 class="text-center">التعديل على إعدادات الموقع</h4></div>

                <div class="card-body">

                    @if(session()->has('message'))
                        <div class="alert {{session('alert') ?? 'alert-info'}}">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('settings.update', $settings->id) }}" enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf

                        

                        <div class="form-group row">
                            <label for="name" class="col-md-2 col-form-label text-md-right">العنوان</label>

                            <div class="col-md-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $settings->name }}" required autocomplete="name"   >

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="about" class="col-md-2 col-form-label text-md-right">الوصف</label>
                        
                            <div class="col-md-10">
                                <input id="about" type="about" class="form-control @error('about') is-invalid @enderror" name="about" value="{{ $settings->about }}" required autocomplete="about">
                        
                                @error('about')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="terms" class="col-md-2 col-form-label text-md-right">الوصف</label>
                        
                            <div class="col-md-10">
                                <input id="terms" type="terms" class="form-control @error('terms') is-invalid @enderror" name="terms" value="{{ $settings->terms }}" required autocomplete="terms">
                        
                                @error('terms')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="facebook" class="col-md-2 col-form-label text-md-right">{{ __('Facebook') }}</label>

                            <div class="col-md-10">
                                <input id="facebook" type="url" class="form-control @error('facebook') is-invalid @enderror" name="facebook" value="{{ $settings->facebook }}" required autocomplete="facebook" autofocus>

                                @error('facebook')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="googleplus" class="col-md-2 col-form-label text-md-right">{{ __('googleplus') }}</label>

                            <div class="col-md-10">
                                <input id="googleplus" type="url" class="form-control @error('googleplus') is-invalid @enderror" name="googleplus" value="{{ $settings->googleplus }}" required autocomplete="googleplus" autofocus>

                                @error('googleplus')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="youtube" class="col-md-2 col-form-label text-md-right">{{ __('youtube') }}</label>

                            <div class="col-md-10">
                                <input id="youtube" type="url" class="form-control @error('youtube') is-invalid @enderror" name="youtube" value="{{ $settings->youtube }}" required autocomplete="youtube" autofocus>

                                @error('youtube')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="twitter" class="col-md-2 col-form-label text-md-right">{{ __('twitter') }}</label>

                            <div class="col-md-10">
                                <input id="twitter" type="url" class="form-control @error('twitter') is-invalid @enderror" name="twitter" value="{{ $settings->twitter }}" required autocomplete="twitter" autofocus>

                                @error('twitter')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="telegram" class="col-md-2 col-form-label text-md-right">{{ __('telegram') }}</label>

                            <div class="col-md-10">
                                <input id="telegram" type="url" class="form-control @error('telegram') is-invalid @enderror" name="telegram" value="{{ $settings->telegram }}" required autocomplete="telegram" autofocus>

                                @error('telegram')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="whatsapp" class="col-md-2 col-form-label text-md-right">{{ __('whatsapp') }}</label>

                            <div class="col-md-10">
                                <input id="whatsapp" type="url" class="form-control @error('whatsapp') is-invalid @enderror" name="whatsapp" value="{{ $settings->whatsapp }}" required autocomplete="whatsapp" autofocus>

                                @error('whatsapp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="snapchat" class="col-md-2 col-form-label text-md-right">{{ __('snapchat') }}</label>

                            <div class="col-md-10">
                                <input id="snapchat" type="url" class="form-control @error('snapchat') is-invalid @enderror" name="snapchat" value="{{ $settings->snapchat }}" required autocomplete="snapchat" autofocus>

                                @error('snapchat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="linkedin" class="col-md-2 col-form-label text-md-right">{{ __('linkedin') }}</label>

                            <div class="col-md-10">
                                <input id="linkedin" type="url" class="form-control @error('linkedin') is-invalid @enderror" name="linkedin" value="{{ $settings->linkedin }}" required autocomplete="linkedin" autofocus>

                                @error('linkedin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="telephone" class="col-md-2 col-form-label text-md-right">رقم التليفون</label>

                            <div class="col-md-10">
                                <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ $settings->telephone }}" required autocomplete="telephone">

                                @error('telephone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">البريد الإلكترونى</label>

                            <div class="col-md-10">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $settings->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                    

                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-md-3" id="the_icon">
                                    <img src="{{ $settings->icon_qr_path }}" style="width:60px;height:60px;margin: 16px 97px;background-color: black;" class="rounded-circle" id="the-qr" onclick="document.getElementById('icon_qr_image').click()" alt="Cinque Terre">
                                    <h5 class="text-center">QR Code</h5>
                                    <input style="display: none;" id="icon_qr_image" type="file" name="icon_qr_image">
                                </div>
                            </div>
                        </div>

    
                    



                        <div class="form-group row mb-0">
                            <button type="submit" class="btn btn-primary col-md-12">
                                التعديل على إعدادات الموقع
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
        function changeImage(input,className) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $(className).attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }


        $("#icon_qr_image").change(function() {
            changeImage(this,'#the-qr');
        });
    </script>
    
@endsection