@extends('layouts.app')

@section('title', 'Plats')

@section('content')
<style>
    .no-padding > [class*='col-'] {
        /* padding-right:0;
        padding-left:0; */
        margin-right: 0;
        margin-left: 0;
        }
</style>
    <div class="row">
        <div class="col-md-5">
            <h3 class="modal-title">{{ $result->count() }} {{ Str::plural('Plats', $result->count()) }} </h3>
        </div>
        <div class="col-md-7 page-action text-right">
            @can('add_plats')
                <a href="{{ route('plats.create') }}" class="btn btn-primary btn-sm"> <i class="glyphicon glyphicon-plus-sign"></i> Ajouter</a>
            @endcan
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <select name="categorie_id" id="categorie_id" class="form-control">
                <option value="">Faite votre choix</option>
                @foreach ($categories as $item)
                      <option value="{{$item->id}}">{{$item->libelle}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="result-set">
        <div class="row" id="mycontent">
           
                @foreach($result as $item)
              
                    <div class="col-md-2.5 block text-center" style="width: 15rem;margin-bottom: 15px">
                        
                        <p class="my-3 prod-name"> {{ strtoupper($item->libelle) }}</p> <img class="image" src="images/{{$item->image}}" title="{{$item->description}}">
                        <a href="/plats/destroy/{{$item->id}}" onclick=" return confirm('Are yous sure wanted to delete it?') ">
                            <button type="submit" class="btn-delete btn btn-xs btn-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                        </a>
                        <div class="price">
                            <h6 class="mb-0">{{ strtolower($item->prix) }} F cfa</h6>
                        </div>
                        
                    </div>
                &nbsp;
                @endforeach
          
            </div>
       
       

      
    </div>

@endsection
@push('page_scripts')
      <script>
          $("#categorie_id").on('change',function(){
              var id = $('#categorie_id').val();
           
              $.ajax({
                type:'GET',
                url:"{{ route('showPlat')}}",
                data: {'id': id},
                success:function(data) {
                    console.log(id);
                    $('#mycontent').html(data);
                    }
                });
             
          });
      </script>
@endpush