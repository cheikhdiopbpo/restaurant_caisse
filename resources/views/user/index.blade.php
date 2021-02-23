@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">{{ $result->count() }} {{ Str::plural('User', $result->count()) }} </h3>
        </div>
        <div class="col-md-7 page-action text-right">
            @can('add_users')
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter</a>
            @endcan
        </div>
    </div>

    <div class="result-set">
        <table id="example"  style="width:100%" class="display nowrap table table-bordered table-striped table-hover" id="data-table">
            <thead>
            <tr>
              
                <th>Nom</th>
                <th>Email</th>
                <th>Role</th>
                <th>Status</th>
                @can('edit_users', 'delete_users')
                <th class="text-center">Actions</th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @foreach($result as $item)
            
                <tr>
             
                    <td>{{ strtoupper($item->name) }}</td>
                    <td>{{ strtoupper($item->email) }}</td>
                    <td>{{ strtoupper($item->roles->implode('name',','))}}</td>
                    <td>{{ $item->status=="true"?"Activé":"Désactivé" }}</td>
                    @can('edit_users' ,'delete_users')
                    <td class="text-center">
                        @include('shared._actions', [
                            'entity' => 'users',
                            'id' => $item->id,
                            'param' => 'user'
                        ])
                      {{-- <a href="{{ route('viewUer', ['id'=>$item->id])  }}" class="btn btn-xs btn-info">
                        <i class="fa fa-eye"></i>show</a>   --}}
                    </td>
                    @endcan
                </tr>
            @endforeach
            </tbody>
        </table>

      
    </div>

@endsection