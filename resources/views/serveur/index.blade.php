@extends('layouts.app')

@section('content')
   
    <div class="container-fluid">
         <div class="row">
             <div class="col-md-3"  style="border:2px solid #4e4e4d;height: 900px;">
                  <div>
                            <p style="text-align: center; font-weight: bold;">Panier</p>
                            <p style="text-align: right" ><i class='fa fa-trash ' style='color:red;' onclick='return vider_panier();' > Vider le panier</i></p>
                  </div>
                  <div>
                      <table class="table">
                          <thead>
                              <th>Libelle</th>
                              <th>Qt</th>
                              <th>Prix</th>
                              <th>Total</th>
                              <th>Actions</th>
                          </thead>
                          <tbody id="panier">

                          </tbody>

                      </table>
                  </div>
                  <div style="border: 3px dotted #4e4e4d">
                       <p id="total_panier" style="font-weight: bold;text-align:right"> 0 f cfa</p>
                  </div>
                  <div >
                    <br>
                      <button class="btn btn-primary float-right" id="valide">Valider & Imprimer</button>
                  </div>
             </div>
             
             <div class="col-md-9" >
              
               <div class="row">
                    <div class="col-md-8"  style="background-color: #9e9d9a">
                        <p style="text-align: center;font-weight: bold;font-size: 17px;"><marquee>RESTAURAN MAFATIHUL BICHRI</marquee></p>
                    </div>
                    <div class="col-md-4"  style="background-color: #9e9d9a">
                           
                            <nav class="navbar float-right" >
                                    <div class="form-group">
                                        <select name="categorie_id" id="categorie_id" class="form-control">
                                            <option value="">Faite votre choix</option>
                                            @foreach ($categories as $item)
                                                <option value="{{$item->id}}">{{$item->libelle}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                            </nav>
                     </div>
                     <div class="col-md-12" style="height: 7px;"></div>
                    <div class="col-md-12" style="height: 100%;border:2px solid #9e9d9a" >
                        <div class="container-fluid  py-5">
                                <div class="row justify-content-between px-5"  id="mycontent">
                                         
                                            @foreach($result as $item)
                                                
                                                <div class="block col-md-2.5 text-center" style="width: 15rem;margin-bottom: 0px;"  id="{{$item->id}}"   onclick="return checkItem({{$item}});"  >
                                                    <p><i class="fa fa-plus" class="float-left" style="color:green;zoom:1;" onclick="return ajouter({{$item}});"></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-minus" style="color: red;zoom:1;" onclick="return retirer({{$item}});"></i></p>
                                                   <p class="my-3 prod-name" >{{ strtoupper($item->libelle) }}</p>
                                                    <img class="image" src="images/{{$item->image}}">
                                                    <div class="price  active">
                                                        <h6 class="mb-0">{{ strtolower($item->prix) }} F cfa</h6>
                                                    </div>
                                                </div>
                                         
                                          
                                            @endforeach

                                </div>
                        </div>
                    </div>

              </div>


            </div>
         </div>
    </div>
@endsection
@push('page_scripts')
     <script>
var panier = [];

$('#valide').click(function(){
     var conf = confirm("Confirmer cette commande SVP");
     if(conf)
     {

    
    html = "<body>";
    html = html +"<p style='text-align:center;margin-top:5px;'><b>RESTAURANT MAFATIHUL BICHRI<b></p>";
    html = html +"<p style='text-align:center;margin-top:-17px;'>Adresse: Castor</p>";
    html = html +"<p style='text-align:center;margin-top:-17px;'>Tel: 77 859 96 96</p>";
    html = html +"<div class='conatiner'><table class='table  table-bordered table-sm'><tr><td>Libelle</td><td>Qt</td><td>Prix</td><td>Total</td></tr>";
    total = 0;
    panier.forEach(element => {
        total = total + (element.prix * element.qt);
        html = html + "<tr>";
            html = html + "<td>"+element.libelle+"</td>";
            html = html + "<td>"+element.qt+"</td>";
            html = html + "<td>"+element.prix+"</td>";
            html = html + "<td>"+ Math.round((element.qt * element.prix)*100)/100 +"</td>";
        html = html + "</tr>";
    });
    html = html + "</table></div>";

    html = html + "<p style='text-align:right'><b>Total: "+total+" Fcfa </b></p>";
    html = html + "<body>";
 
    var opt = {
            //margin:       1,
            filename:     'facture.pdf',
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2 },
            jsPDF:        { unit: 'in', format: 'a7', orientation: 'portrait' }
        };

            html2pdf(html,opt);

            $.ajax({
                type:'GET',
                url:"{{ route('save.ticket')}}",
                data: {'ticket': panier},
                success:function(data) {
                      panier = [];
                      charge_panier();
                    }
                });
            }
});
function vider_panier(){
    panier = [];
    charge_panier();
}
function checkItem(item){
    data = item;
     $("#"+data['id']+".block").toggleClass('active');
     $("#"+data['id']+" .price").removeClass('active');
     $("#"+data['id']+".price").addClass('active');
   
    if(panier.length > 0)
    {
      var item = {"id":data["id"],"libelle":data["libelle"] , "prix" : data["prix"] ,"qt" : 1};
      var cpt = 0;
      var index;
      panier.forEach(function(el,key) {
           if(el.id == data["id"])
           {
             cpt = 1;
             index = key;
           }
      });
      
      if(cpt != 1)
      {
        panier.push(item);
       //panier[index].qt =  panier[index].qt + 1 ;
      }
    //   }else{
    //     panier.push(item);
    //   }
     
    }else{
        var item = [{"id":data["id"],"libelle":data["libelle"] , "prix" : data["prix"],"qt" : 1}];
        panier = item;
    }

    charge_panier();
}

function retirer(item){
    //console.log(item);
    data = item;
     $("#"+data['id']+".block").toggleClass('active');
     $("#"+data['id']+" .price").removeClass('active');
     $("#"+data['id']+".price.active").addClass('active');
   
    if(panier.length > 0)
    {
      var cpt = 0;
      var index;
      panier.forEach(function(el,key) {
           if(el.id == data["id"])
           {
             cpt = 1;
             index = key;
           }
      });
      if(cpt == 1)
      {
        if(panier[index].qt > 1)
          {
            panier[index].qt =  panier[index].qt - 1 ;
          }
     
      }
     
    }

    charge_panier();
}


function ajouter(item){
    //console.log(item);
    data = item;
     $("#"+data['id']+".block").toggleClass('active');
     $("#"+data['id']+" .price").removeClass('active');
     $("#"+data['id']+".price.active").addClass('active');
   
    if(panier.length > 0)
    {
      var cpt = 0;
      var index;
      panier.forEach(function(el,key) {
           if(el.id == data["id"])
           {
             cpt = 1;
             index = key;
           }
      });
      if(cpt == 1)
      {
        if(panier[index].qt >= 0)
          {
            panier[index].qt =  panier[index].qt + 1 ;
          }
     
      }
     
    }

    charge_panier();
}



function charge_panier()
{   
    var total = 0;
    var html = "";
    panier.forEach(element => {
        total = total + (element.prix * element.qt);
        html = html + "<tr>";
            html = html + "<td>"+element.libelle+"</td>";
            html = html + "<td>"+element.qt+"</td>";
            html = html + "<td>"+element.prix+"</td>";
            html = html + "<td>"+Math.round((element.qt * element.prix)*100)/100 +"</td>";
            html = html + "<td><i class='fa fa-trash ' style='color:red' onclick='return sup_item("+element.id+");' ></i></td>";
        html = html + "</tr>";
    });
    
    $('#panier').html(html);
    $('#total_panier').html(total+" Fcfa")
    
}

function sup_item(id){
    var conf = confirm('Are yous sure wanted to delete it?');
    if(conf){
        let buffer = [];
        panier.forEach(e=>{
            if(e.id != id){
              buffer.push(e);
            }
        });
        panier = buffer;
        charge_panier();
    }
    
}


$("#categorie_id").on('change',function(){
              var id = $('#categorie_id').val();
           
              $.ajax({
                type:'GET',
                url:"{{ route('showPlat.serveur')}}",
                data: {'id': id},
                success:function(data) {
                  //  console.log(id);
                    $('#mycontent').html("");
                    $('#mycontent').html(data);
                    }
                });
             
          });
       
        
     </script>
@endpush