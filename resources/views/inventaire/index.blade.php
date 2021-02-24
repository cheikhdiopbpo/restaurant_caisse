@extends('layouts.app')

@section('title', 'Plats')

@section('content')

         <H1>For inventor</H1>

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