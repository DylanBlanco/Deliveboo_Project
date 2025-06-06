<!-- resources/views/auth/login.blade.php -->

@extends('layouts.guest')

<head>
    <!--Adobe Font-->
    <link rel="stylesheet" href="https://use.typekit.net/lyi7tbf.css">
</head>

@section('main-content')
    <section class="vh-100">
            

            <div class="row h-100 d-flex align-items-center">
                <div class="col-12 col-lg-5 col-md-4  d-flex flex-column justify-content-center">
                    <h2 class="text-center ibm-plex-mono-bold bg-white p-3 rounded">Esegui il login</h2>
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="card">
                        <form method="POST" action="{{ route('login') }}" onsubmit="return validateLoginForm()">
                            @csrf

                            <!-- Email -->
                            <div class="row d-flex justify-content-center align-items-center px-2">
                                    <div>
                                        <label for="email" class="form-label"></label>
                                    </div>
                                    
                                    <div class="col-12">
                                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email"
                                        value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="invalid-feedback">Inserisci un indirizzo email valido.</div>
                                    </div>
                                
                            </div>
                            

                            <!-- Password -->
                            <div class="row mb-3 d-flex justify-content-center align-items-center px-2">
                                <div>
                                    <label for="password" class="form-label"></label>
                                </div>
                            
                                <div class="col-12">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"
                                    id="password" required>
                                    @error('password')
                                        <div class="invalid-feedback ibm-plex-mono-regular">{{ $message }}</div>
                                    @enderror
                                    <div class="invalid-feedback ibm-plex-mono-regular">La password è obbligatoria.</div>
                                </div>
                                
                            </div>

                            <!-- Ricordami -->
                            <div class="ms-2 mb-5 form-check form-switch">
                                <input type="checkbox" role="switch" name="remember" class="form-check-input" id="remember">
                                <label class="form-check-label ibm-plex-mono-regular" for="remember">Ricordami</label>
                            </div>

                            <!-- Pulsante di Login -->
                            <button type="submit" class="button-menu mb-5 w-100 ibm-plex-mono-regular">Accedi</button>
                        </form>

                        @if (session('userDeleted'))
                            <div class="row">
                                <div class="col">
                                    <div class="card my-2 alert alert-danger">
                                        {{ session('userDeleted') }}
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Link alla Registrazione -->
                        <p class=" mt-3 text-center ibm-plex-mono-regular p-2">Non hai un account? <a href="{{ route('register') }}">Registrati qui</a></p>
                        
                        
                    </div>
                    
                </div>
            </div>
        </div>

        
        
    
</section>

    <!--Stile-->

    <style scoped>

        .card{
            padding:20px;
            margin-top: 20px;
            border: none;
            border-radius: 15px;
            box-shadow: 0px 0px 22px 0px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-height: 100%;
        }

        h5{
            font-size: 18px;
            margin-bottom: 15px;
        }

        .button-menu {
        background-color: #2f2f2f;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 10px;
        }

        .button-menu:hover {
        background-color: #fac200;
        border: #2f2f2f solid 1px;
        }

    </style>

    <script>
        function validateLoginForm() {
            let isValid = true;

            // Controllo tutti i campi obbligatori
            document.querySelectorAll('input[required]').forEach(function(field) {
                if (!field.value || field.value.trim() === "") {
                    field.classList.add('is-invalid');
                    isValid = false;
                } else {
                    field.classList.remove('is-invalid');
                }
            });

            return isValid;
        }
    </script>
@endsection
