@extends('layouts.app')

@section('title', 'Plats')

@section('content')
<br><br>
<div class="container result-set">
    <div class="row" id="body_data">
        <table id="example"  style="width:100%" class="display nowrap table table-bordered table-striped table-hover" id="data-table">
            <thead>
                <tr>
                    <th>ID TICKET</th>
                    <th>LIBELLE</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                  @foreach ($ticket as $item)
                  <tr>
                        <td>{{$item->id_ticket}}</td>
                        <td>{{$item->total}}</td>
                        <td>
                            <button class="btn-show btn btn-xs btn-success" onclick="return voir_ticket({{$item->id_ticket}})">
                                <i class="far fa-eye"></i>
                                 voir ticket
                            </button>
                            <button  class="btn-delete btn btn-xs btn-danger" onclick="return delete_ticket({{$item->id_ticket}})">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                  @endforeach
            </tbody>
     </table>
    </div>
</div>   
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ticket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="body_modal">
                
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-primary"><i class="fa fa-print"></i></button>
        </div>
      </div>
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

          function voir_ticket(item){
              console.log(item);
               var id_ticket = item;

              $.ajax({
                type: "GET",
                dataType: "json",
                url: '/ticket/show',
                data: {'id_ticket': id_ticket},
                success: function(data){
                   console.log(data);

                   var total = 0;
                    var date ="";
                     html = "<div>";
                        html = html +"<p style='text-align:center;margin-top:5px;'><b>RESTAURANT MAFATIHUL BICHRI<b></p>";
                        html = html +"<p style='text-align:center;margin-top:-17px;'>Adresse: Castor</p>";
                        html = html +"<p style='text-align:center;margin-top:-17px;'>Tel: 77 859 96 96</p>";
                        html = html +"<div class='conatiner'><table class='table  table-bordered table-sm'><tr><td><b>Libelle</b></td><td><b>Qt</b></td><td><b>Prix</b></td><td><b>Total<b></td></tr>";
                        total = 0;
                        data.forEach(element => {
                            total = total + (parseInt(element.prix) * parseInt(element.qt));
                            date =  element.date_enreg;
                            html = html + "<tr>";
                                html = html + "<td>"+element.libelle+"</td>";
                                html = html + "<td>"+element.qt+"</td>";
                                html = html + "<td>"+element.prix+"</td>";
                                html = html + "<td>"+ Math.round((parseInt(element.qt) * parseInt(element.prix))*100)/100 +"</td>";
                            html = html + "</tr>";
                        });
                        html = html + "</table></div>";

                     html = html + "<p style='text-align:right'><b>Total: "+total+" Fcfa</b></p><br>";
                     html = html + "<p style='text-align:left;font-weight:210'>Fait le : "+date+"</p>";
                     $("#body_modal").html(html);
                     $('#exampleModal').each(function(){ $(this).modal("show") });
                }
              });
          }

          function delete_ticket(item){
            var id_ticket = item;

                $.ajax({
                type: "GET",
                dataType: "json",
                url: '/ticket/delete',
                data: {'id_ticket': id_ticket},
                    success: function(data){
                        console.log(data);
                        alert(data);
                        $('#body_data').html(data);
                    }
                });
          }
      </script>
@endpush