<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Scripts -->
        @vite('resources/js/app.js')

        <!--Fontwaesome--> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <header class="">
          <nav class="navbar navbar-expand-lg shadow">
            <div class="container">
              <div class="row w-100 d-flex justify-content-between align-items-center">
                <div class="col-6 col-md-4">
                  <a class="" href="/login">
                    <img class="logo-nav" src="/images/Logo-deliveBoo.svg" alt="logo-deliveBoo">
                  </a>
                </div>

                <div class="col-6 col-md-4">
                  <div class="collapse navbar-collapse d-flex justify-content-end align-items-center" id="navbarText">
                    <div>
                      <a href="{{ route('user.profile') }}" class="mx-4 ">
                        <i class="icon-profile fa-solid fa-user"></i>
                      </a>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="d-none d-lg-block d-md-none d-sm-none logout ibm-plex-mono-regular button-menu mt-2">
                            Log Out
                        </button>
                        <button type="submit" class="d-lg-none d-md-block logout ibm-plex-mono-regular button-menu mt-2">
                          <i class="fa-solid fa-right-from-bracket"></i>
                        </button>
                    </form>
                  </div>
                </div>
              </div>
                
                
            </div>
          </nav>
        </header>

        <main>
            <div class="w-100 m-0 p-0">
                @yield('main-content')
            </div>
        </nav>
    </header>
    
</body>

</html>

<style>
 .icon-profile{
  color: #2f2f2f;
  font-size: 30px;
 }
 .icon-profile:hover{
  color: #fac200;
 }

 .logout{
  font-size: 15px;
 }

 .navbar{
  background-color: white;
  box-shadow: 
 }
</style>
