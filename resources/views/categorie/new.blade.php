@extends('layouts.app')

@section('title', 'Create')

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Ajouter categorie</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('categories.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Retour</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            {!! Form::open(['route' => ['categories.store'] ]) !!}
                @include('categorie._form')
                <!-- Submit Form Button -->
                {!! Form::submit('Valider', ['class' => 'btn btn-primary']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection