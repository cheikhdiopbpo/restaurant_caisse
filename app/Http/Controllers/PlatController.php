<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Image;
use Illuminate\Support\Facades\File;
use App\Categorie;
use App\Plat;
use App\Ticket;
class PlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::get();
        $result = Plat::with('categories')->get();
        return \view('plat.index',\compact('result','categories'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       $cats = Categorie::get();
       return view('plat.new',\compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'libelle' => 'required',
            'prix'=>'required',
            'description'=> 'required',
          ]);
        if($request->file('image')) {
        $imagePath = $request->file('image');
        $imageName = $imagePath->getClientOriginalName();

        //dd($imageName);
        $destination = public_path('images');
        $img = Image::make($imagePath->path());
        $img->resize(120,120,function($cons){
            $cons->aspectRatio();
        })->save($destination."/".$imageName);
        //$path = $request->file('image')->storeAs('images', $imageName, 'public');
        //$request->image->move(public_path('images'),$imageName);
       

        }
       
        $plat = new Plat();
        $plat->libelle = $request->libelle;
        $plat->description = $request->description;
        $plat->prix = $request->prix;
        $plat->image = $imageName;
        $plat->categories()->associate($request->id_categorie);
       
        $plat->save();
 
        return \Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     
        $plats = Plat::find((int)$id);
        if($plats)
        {

            if(Plat::findOrFail($id)->delete()){
               // $path = public_path()."".$plats->image;
                File::delete(public_path('images/'.$plats->image));
                //unlink($path);
                return redirect()->route('plats.index');
            }
         
        }
      
    }

    public function showPlatByCategorie(Request $request){

        $plats = Plat::with('categories')->where('categories_id',$request->id)->get();
         $html = "";

     
     
        foreach($plats as $item){
            $html = $html . "<div class='block col-md-2.5  text-center' style='width: 15rem;margin-bottom: 15px'>
                        
            <p class='my-3 prod-name'>".strtoupper($item->libelle)."</p> <img class='image' src='images/$item->image' title='$item->description' >
            <a href='/plats/destroy/$item->id' onclick=' return confirm('Are yous sure wanted to delete it?') '>
                <button type='submit' class='btn-delete btn btn-xs btn-danger'>
                    <i class='fa fa-trash'></i>
                </button>
            </a>
            <div class='price'>
                <h6 class='mb-0'>".strtolower($item->prix) ."F cfa</h6>
            </div>
            
           </div>";
       
        }
      
        return $html;

    }

    public function  showPlatByCategorieForSerevur(Request $request){
       
         $plats = Plat::with('categories')->where('categories_id',$request->id)->get();
         $html = "";

        foreach($plats as $item){

            $html = $html . "<div class='block col-md-2.5 text-center' style='width: 15rem; margin-bottom: 15px;' id='$item->id'  onclick='return checkItem($item);' draggable='true' ondragstart='return retirer($item);'>
                                <p class='my-3 prod-name'>".strtoupper($item->libelle)."</p> <img class='image' src='images/$item->image' title='$item->description' >
                                <div class='price'>
                                    <h6 class='mb-0'>".strtolower($item->prix) ."F cfa</h6>
                                </div>
            
                            </div>";
       
        }
      
        return $html;

    }


    public function saveTicket(Request $request){
         $id_ticket = hexdec(uniqid());
         //dd($id_ticket);
         ['id_ticket','libelle','qt','prix','date_enreg'];

         $date = now()->format('Y-m-d');
         // dd($request->ticket);
        foreach($request->ticket  as $item){
            $data = array('id_ticket'=> $id_ticket, "libelle"=> $item["libelle"] , "qt"=> $item["qt"], "prix"=>$item["prix"],"date_enreg"=>$date);
            $ticket = new Ticket();
            $ticket->create($data);
            $data = '';
        }
       

        return redirect()->route('home');
       
    }
}
