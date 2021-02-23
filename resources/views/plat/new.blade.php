@extends('layouts.app')

@section('title', 'Create')

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Ajouter plat</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('plats.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Retour</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <form method="POST" action="{{ route('plats.store') }}" role="form" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    {{-- <input type="hidden" value="{{$id}}" name="id_categorie"> --}}
                    <div class="form-group">
                         <select name="id_categorie" id="id_categorie" class="form-control">
                             <option value="">Faites votre choix</option>
                             @foreach ($cats as $item)
                                <option value="{{$item->id}}">{{$item->libelle}}</option>
                             @endforeach
                         </select>
                    </div>
                    <div  class="form-group">
                        <label for="libelle" >{{ __('Libelle') }}</label>
                        <input id="libelle" class="form-control" type="text" libelle="libelle" name="libelle" required autofocus autocomplete="libelle" />
                    </div>
                    <div class="form-group">
                        <label for="prix"  >{{ __('prix') }}</label>
                        <input id="prix" class="form-control" type="text" name="prix"  required />
                    </div>
        
                    <div class="form-group">
                        <label for="description"  >{{ __('description') }}</label>
                        <input id="description" class="form-control" type="text" name="description"  required />
                    </div>
                
                    <div class="form-group">
                        <label for="image">{{ __('image') }}</label>
                        <div class="custom-file">
                        <input type="file" class="custom-file-input"  value='' id="customFile" name="image">
                        <label class="custom-file-label" for="customFile">Prendre une photo</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Valider</button>
            </div>
        </form>

        </div>
    </div>
@endsection