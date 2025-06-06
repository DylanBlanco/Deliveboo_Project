@extends('layouts.app')

<head>
    <!--Adobe Font-->
    <link rel="stylesheet" href="https://use.typekit.net/lyi7tbf.css">
</head>

@section('page-title', 'Crea Piatto')

@section('main-content')

<section>

    <div class="container py-4 text-start">

        <div class="row">
            <div class="col-12 col-sm-6 mb-3 p-4 card ">
                <div class="row">
                    <div class="col">
                        <div>
                            <h1 class="text-center ibm-plex-mono-bold">Crea Nuovo Piatto</h1>
                        </div>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger my-4">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row my-5">
                    <div class="col-10">
                        <form method="post" action="{{ route('dishes.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label for="name" class="form-label ibm-plex-mono-regular">Nome del piatto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>

                                @error('name')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="description" class="form-label ibm-plex-mono-regular">Descrizione del piatto <span class="text-danger">*</span></label>
                                <textarea class="form-control ibm-plex-mono-regular" id="description" name="description" value="{{ old('description') }}"></textarea>

                                @error('description')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="price" class="form-label ibm-plex-mono-regular">Prezzo del piatto <span class="text-danger">*</span></label>
                                <input type="number" class="form-control ibm-plex-mono-regular" id="price" name="price" required min="0" step="0.01" value="{{ old('price') }}">

                                @error('price')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <label for="image" class="form-label ibm-plex-mono-regular">Carica Immagine <span class="text-danger">*</span></label>
                                <input type="file" class="form-control ibm-plex-mono-regular" id="image" name="image" value="{{ old('image') }}">

                                @error('image')
                                    <div class="alert alert-danger">
                                        {{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">

                                <div class="mb-4 me-3">
                                    <label for="visibility" class="form-label ibm-plex-mono-regular">Visibilità</label>
                                    <select class="form-control ibm-plex-mono-regular" id="visibility" name="visibility" required>
                                        <option value="1">Visibile</option>
                                        <option value="0">Non Visibile</option>
                                    </select>

                                    @error('visibility')
                                        <div class="alert alert-danger">
                                            {{ $message }}</div>
                                    @enderror
                                    
                                </div>

                                <div class="mb-4">
                                    {{-- <label for="category_id" class="form-label ibm-plex-mono-regular">Selezione Categoria</label>
                                    <select class="form-control ibm-plex-mono-regular" id="category_id" name="category_id" required>
                                        <option value=""></option>
                                        @foreach ($categories as $category)
                                            <option value="category_id"> {{ $category->name }} </option>
                                        @endforeach
                                    </select> --}}

                                    <label for="category_id" class="form-label ibm-plex-mono-regular">Seleziona Categoria <span class="text-danger">*</span></label>
                                    <select class="form-control" id="category_id" name="category_id" required>
                                        <option value="" disabled>Seleziona una categoria</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('category_id')
                                        <div class="alert alert-danger">
                                            {{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            

                            <button type="submit" class="button-menu-y ibm-plex-mono-regular w-100 my-3">Aggiungi piatto</button>
                        </form>
                        <div class="mt-4">
                            <a href="{{ route('dishes.index') }}" class="button-menu text-decoration-none my-1 ibm-plex-mono-regular">Torna indietro</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</section>
    
@endsection


<style>
    section{
        background-image: url('{{ asset('/images/background-create.jpg') }}');
        background-size: cover;
    }
</style>