@extends('layouts.app')

@section('title', 'Categorie')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">{{ $result->count() }} {{ Str::plural('Categorie', $result->count()) }} </h3>
        </div>
        <div class="col-md-7 page-action text-right">
            @can('add_users')
                <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter</a>
            @endcan
        </div>
    </div>

    <div class="result-set">
        <table id="example"  style="width:100%" class="display nowrap table table-bordered table-striped table-hover" id="data-table">
            <thead>
            <tr>
              
                <th>Libellé</th>
                <th>Description</th>
                @can('edit_categories', 'delete_users')
                <th class="text-center">Actions</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($result as $item)
            
                <tr>
             
                    <td>{{ strtoupper($item->libelle) }}</td>
                    <td>{{ strtoupper($item->description) }}</td>
                  
                    @can('edit_categories' ,'delete_categories')
                    <td class="text-center">
                        @include('shared._actions', [
                            'entity' => 'categories',
                            'id' => $item->id,
                            'param' => 'categorie'
                        ])
                        {{-- <a href="{{ route('plats.index', ['id'=>$item->id])  }}" class="btn btn-xs btn-info">
                        Ajouter des plats</a> 
                    </td> --}}
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>

      
    </div>

@endsection