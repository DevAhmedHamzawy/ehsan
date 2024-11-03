<title>لوحة التحكم</title>
<link rel="stylesheet" href="{{ asset('admin/css/login.css') }}">

<!-- Main -->
<div class="d-md-flex h-md-100 align-items-center">
    <div class="col-md-6 p-0 h-md-100 loginarea">
        <div class="d-md-flex align-items-center h-md-100 p-5 justify-content-center loginformarea">
            <form method="POST" action="{{ route('login') }}" aria-label="Login" class="border rounded p-5">
                    @csrf
                    <h3 class="mb-4 text-center">تسجيل الدخول</h3>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="البريد الإلكترونى" value="{{ old('email') }}" required autofocus>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="exampleInputPassword1" placeholder="كلمة المرور"  required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" {{ old('remember') ? 'checked' : '' }} id="exampleCheck1">
                        <label class="form-check-label small text-muted pr-3" for="exampleCheck1">تذكرنى</label>
                    </div>
                    <button type="submit" class="btn btn-success btn-round btn-block shadow-sm">تسجيل الدخول</button>
                </form>
            </div>
        </div>
        <div class="col-md-6 p-0 bg-indigo h-md-100">
            <div class="text-white d-md-flex align-items-center h-100 p-5 text-center justify-content-center">
                <div class="logoarea pt-5 pb-5">
                    <p>
                        <i class="fa fa-anchor fa-3x"></i>
                    </p>
                    <h1 class="mb-0 mt-3 display-4"><img src="{{ asset('public/images/main/logo.png') }}" /></h1>
                    </a>
                </div>
            </div>
        </div>
        
    </div>
    <!-- End Main -->