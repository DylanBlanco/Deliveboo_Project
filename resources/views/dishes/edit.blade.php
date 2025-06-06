@extends('layouts.app')

@section('page-title', 'Modifica Piatto')

@section('main-content')

<section class="py-3">

    <div class="container h-100 py-4">
        <div class="row">

            <div class="card col-12 col-sm-6 mb-3 p-4">
                <div class="row">
                    <div class="col">
                        <h1 class="text-center ibm-plex-mono-bold">Modifica Piatto</h1>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger my-2">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>
                                    {{ $error }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-10">
                        <form method="post" action="{{ route('dishes.update', $dish->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                            <div class="mb-4 d-flex flex-wrap ">
                                {{-- Visualizza immagine caricata se presente --}}
                                    @if (filter_var($dish->image, FILTER_VALIDATE_URL))
                                        <div class="my-4 me-2">
                                            <h5 class="ibm-plex-mono-semibold">
                                                Immagine attuale:
                                            </h5>
                                            <img src="{{ $dish->image }}" class="card-img-top" alt="{{ $dish->name }}" class="rounded" style="width:100%; height:200px; object-fit: cover;">
                                        </div>
                                    @elseif ($dish->image)
                                        <div class="mb-4" style="padding-left: 25px;">
                                            <h5 class="ibm-plex-mono-semibold">
                                                Immagine attuale:
                                            </h5>
                                            <img src="{{ asset('storage/' .$dish->image) }}" alt="{{ $dish->name }}" style="width: 250px" style="width:350px; padding-left: 50px; object-fit: cover;">
                                        </div>
                                    @endif
                                <div class="">
                                    <label for="image" class="form-label ibm-plex-mono-semibold">Modifica immagine</label>
                                    <input type="file" class="form-control ibm-plex-mono-regular" id="image" name="image">
                                </div>
                                

                                
                            </div>

                            <div class="d-flex">
                                <div class="me-3">
                                    <label for="name" class="form-label ibm-plex-mono-semibold">Modifica nome del piatto</label>
                                    <input type="text" class="form-control ibm-plex-mono-regular" id="name" name="name" value="{{ $dish->name }}" required>
                                    
                                    @error('name')
                                        <div class="alert alert-danger ibm-plex-mono-semibold">
                                            {{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label for="price" class="form-label ibm-plex-mono-semibold">Modifica Prezzo del piatto</label>
                                    <input type="number" class="form-control ibm-plex-mono-regular" id="price" name="price" value="{{ $dish->price }}" required min="0" step="0.01">

                                    @error('price')
                                        <div class="alert alert-danger">
                                            {{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            
                            
                            <div class="mb-4">
                                <label for="description" class="form-label ibm-plex-mono-semibold">Modifica Descrizione</label>
                                <textarea class="form-control ibm-plex-mono-regular" id="description" name="description">{{ $dish->description }}</textarea>

                                @error('description')
                                    <div class="alert alert-danger ibm-plex-mono-regular">
                                        {{ $message }}</div>
                                @enderror
                            </div>
                            
                            
                            
                            <div class="d-flex ">
                                <div class="mb-4 me-2">
                                    <label for="visibility" class="form-label ibm-plex-mono-semibold">Visibilità</label>
                                    <select class="form-control ibm-plex-mono-regular" id="visibility" name="visibility" required>
                                        <option value="1" {{ $dish->visibility ? 'selected' : '' }}>Visibile</option>
                                        <option value="0" {{ !$dish->visibility ? 'selected' : '' }}>Non Visibile</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="category_id" class="form-label ibm-plex-mono-semibold">Seleziona Categoria</label>
                                    <select class="form-control ibm-plex-mono-regular" id="category_id" name="category_id" required>
                                        <option value="" disabled {{ !$dish->category_id ? 'selected' : '' }}>Seleziona una categoria</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ $dish->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    
                                    @error('category_id')
                                        <div class="alert alert-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <button type="submit" class="button-menu ibm-plex-mono-regular me-3">Modifica</button>
                                
                                <div class="">
                                    <a href="{{ route('dishes.index') }}" class="button-menu text-decoration-none ibm-plex-mono-regular my-1">Torna al menu</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    

                    
                    {{-- <div class="mb-4">
                        <label for="category_id" class="form-label">Selezione Categoria</label>
                        <select class="form-control" id="category_id" name="category_id" required>
                            <option value=""></option>
                            @foreach ($dishes as $dish)
                                <option value="category_id"> {{ $dish->category->name }} </option>
                            @endforeach
                        </select>
                        
                        @error('category_id')
                            <div class="alert alert-danger">
                                {{ $message }}</div>
                        @enderror
                    </div> --}}

                    
                </div>
            </div>

        </div>
        
        
    </div>

</section>
    
@endsection

<style>

section{
    background-image: url('{{ asset('/images/background-edit.jpg') }}');
    background-size: cover;
}

.button-menu {
    background-color: #2f2f2f;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 10px;
}
</style>
