@extends('layouts.app')

@section('title', 'Edit Categorie ' . $categorie->libelle)

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Modifier {{ $categorie->libelle }}</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('categories.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Retour</a>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        {!! Form::model($categorie, ['method' => 'PUT', 'route' => ['categories.update',  $categorie->id ] ]) !!}
                            @include('categorie._form')
                            <!-- Submit Form Button -->
                            {!! Form::submit('Modifier', ['class' => 'btn btn-primary']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection