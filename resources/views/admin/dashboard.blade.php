@extends('layouts.app')

<head>
    <!--Adobe Font-->
    <link rel="stylesheet" href="https://use.typekit.net/lyi7tbf.css">
</head> 

@section('page-title', 'Dashboard')

@section('main-content')
<section>
    <div class="container h-100 d-flex justify-content-center align-items-center">
        <div class="dashboard-card-general d-flex flex-column justify-content-center align-items-center">

            <div class="m-4">
                <h1 class="ibm-plex-mono-bold text-center">
                    Benvenuto su deliveBoo!
                </h1>
                <p class="subtitle-dashboard ibm-plex-mono-regular text-center mb-2">
                    Qui potrai gestire tutte le informazioni sul tuo ristorante.
                </p>
            </div>

            <div class=" d-flex flex-column align-items-center col-12 m-2">
                <div class="row">
                    <div class="col-12">
                        <p class="button-title ibm-plex-mono-semibold text-center m-4">
                            Dove vuoi andare?
                        </p>

                        <hr>

                        <div class="row mt-4">
                            <div class="col-12 d-flex justify-content-center align-items-center">
                                <h5 class="ibm-plex-mono-semibold me-4">
                                    Vai al menù
                                </h5>

                                <button class="button-menu d-none d-lg-block d-md-none d-sm-none">
                                    <a class=" ibm-plex-mono-regular text-decoration-none text-light"  href="{{ route('dishes.index') }}">Guarda!</a>
                                </button>

                                <button class="button-menu d-lg-none d-md-block">
                                    <a class=" ibm-plex-mono-regular text-decoration-none text-light"  href="{{ route('dishes.index') }}">
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

@endsection

<style scoped>

    section{
        background-image: url('{{ asset('/images/dashboard-background.jpg') }}');
        background-size: cover;
    }

    .my-title{
        margin-top: 50px;
        color: #2f2f2f;
    }
    .subtitle-dashboard {
        font-size: 20px;
    }
    .button-title{
        font-size: 18px;
        text-align: center;
    }
    .dashboard-card-general{
        display: flex;
        justify-content: center;
        border: none;
        border-radius: 20px;
        box-shadow: 2px 8px 42px #2f2f2f;
        padding: 30px;
        width: fit-content;
        background-color: white;
    }

    .dashboard-card{
        display: flex;
        justify-content: center;
        border: none;
        border-radius: 20px;
        box-shadow: 2px 8px 42px #2f2f2f;
        padding: 10px;
        margin: auto;
        background-color: white;
    }
</style>
