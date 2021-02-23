@extends('layouts.app')

@section('title', 'show')

@section('content')

    <div class="row">
        <div class="col-md-5">
            <h3>Informations</h3>
        </div>
        <div class="col-md-7 page-action text-right">
            <a href="{{ route('users.index') }}" class="btn btn-default btn-sm"> <i class="fa fa-arrow-left"></i> Back</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    ID utilisateur : {{$user['id']}}
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                    Nom : {{$user['name']}}
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                    Email : {{$user['email']}}
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                    Status compte : {{$user['status'] == "true" ? "Activé" : "Désactivé"}}
                </div>
              </div>
              <br><br>
        </div>
       
        <div class="row">
            @if($user['status'] == "true")
            <div class="col-md-2">
                <a href="{{ route('unablecompte', ['id'=>$user['id']])  }}" class="btn btn-xs btn-danger">
                    Désactiver le compte </a> 
            </div>
            @else
            <div class="col-md-2">
                <a href="{{ route('unablecompte', ['id'=>$user['id']])  }}" class="btn btn-xs btn-info">
                    Activer le compte </a>  
            </div>
            @endif
            <div class="col-md-8">
            </div>
            <div class="col-md-2">
                <a href="{{ route('resetPwd', ['id'=>$user['id']])  }}" class="btn btn-xs btn-info">
                    Réinitiliser mot de passe </a>  
            </div>
       </div>
    </div>
@endsection