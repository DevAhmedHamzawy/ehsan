<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.1.3/css/bootstrap.min.css" integrity="sha384-Jt6Tol1A2P9JBesGeCxNrxkmRFSjWCBW1Af7CSQSKsfMVQCqnUVWhZzG0puJMCK6" crossorigin="anonymous">    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.0.3/css/buttons.dataTables.min.css">

    <link data-require="jqueryui@*" data-semver="1.10.0" rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/css/smoothness/jquery-ui-1.10.0.custom.min.css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js" defer></script>
    
    <title>{{ $settings->name }} - لوحة التحكم</title>
    @yield('header')
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-dark">

        <a class="navbar-brand" href="#"><img src="{{ $settings->icon_header_admin_path }}" width="190" height="40" /></a>


        <button class="navbar-toggler sideMenuToggler" type="button">
            <span class="navbar-toggler-icon"></span>
        </button> 
        
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto" style="margin-left: 90px;">

            <li class="nav-item dropdown  user-menu">
                <a class="nav-link dropdown-toggle" href="http://example.com" style="margin-top:1px;" id="navbarDropdownMenuLink" data-toggle="dropdown" data-target="#actions" aria-haspopup="true" aria-expanded="false">
                  <img src="{{ Auth::user()->image }}" class="user-image" >
                  <span class="hidden-xs icon">{{ Auth::user()->first_name }}</span>
                </a>
                <div class="dropdown-menu" id="actions" aria-labelledby="navbarDropdownMenuLink" style="margin-left: 20px;">
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                      تسجيل الخروج
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>             
                </div>
            </li>

            
            
            
          </ul>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
        
    </nav>

    <div class="wrapper d-flex">
        <div class="sideMenu bg-mattBlackLight">
            <div class="sidebar">
                <ul class="navbar-nav">
                    <li class="nav-item"><a href="{{ url('dashboard') }}" class="nav-link px-2"><i class="material-icons icon">dashboard</i><span class="text">لوحة التحكم</span></a></li>
                    @if (auth()->user()->role == 0)
                      <li class="nav-item"><a href="{{ url('admins') }}" class="nav-link px-2"><i class="material-icons icon">content_copy</i><span class="text">مديرين الموقع</span></a></li>
                      <li class="nav-item"><a href="{{ url('partners') }}" class="nav-link px-2"><i class="material-icons icon">content_copy</i><span class="text">الراعين</span></a></li>
                      <li class="nav-item"><a href="{{ url('users') }}" class="nav-link px-2"><i class="material-icons icon">content_copy</i><span class="text">المستخدمين</span></a></li>
                      <li class="nav-item"><a href="{{ url('categories') }}" class="nav-link px-2"><i class="material-icons icon">content_copy</i><span class="text">التصنيفات</span></a></li>
                      <li class="nav-item"><a href="{{ url('spinwheels') }}" class="nav-link px-2"><i class="material-icons icon">content_copy</i><span class="text">أعلى النقاط</span></a></li>
                      <li class="nav-item"><a href="{{ url('getspinwheels') }}" class="nav-link px-2"><i class="material-icons icon">content_copy</i><span class="text">القرعات</span></a></li>
                    @endif

                    @if (auth()->user()->role == 0 || auth()->user()->role == 2)
                    
                    <li class="nav-item"><a href="{{ url('competitions') }}" class="nav-link px-2"><i class="material-icons icon">accessibility</i><span class="text">المسابقات</span></a></li>
                    <li class="nav-item"><a href="{{ url('questions') }}" class="nav-link px-2"><i class="material-icons icon">accessibility</i><span class="text">الأسئلة</span></a></li>
                    
                    @endif

                    @if (auth()->user()->role == 0)


                    <li class="nav-item"><a href="{{ url('posters') }}" class="nav-link px-2"><i class="material-icons icon">content_copy</i><span class="text">الإعلانات</span></a></li>

                    <li class="nav-item"><a href="{{ url('settings/1/edit') }}" class="nav-link px-2"><i class="material-icons icon">account_box</i><span class="text">إعدادات الموقع</span></a></li>
                    <li class="nav-item"><a href="#" class="nav-link sideMenuToggler px-2"><span class="text">ex</span><i class="material-icons icon">ex</i></a></li>
                
                    @endif
                </ul>
            </div>
        </div>
    


    <div class="content">
        <main>
           
            @yield('content')
                        
        </main>
    </div>

    

</body>


<script src="{{ asset('js/app.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.8/jquery.slimscroll.min.js"></script>
<script src="{{ asset('admin/js/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script data-require="jqueryui@*" data-semver="1.10.0" src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.0/jquery-ui.js"></script>

@yield('footer')
</html>