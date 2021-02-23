<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Categorie;
use App\Authorizable;
class CategorieController extends Controller
{

    use Authorizable;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $result = Categorie::get();
        return view('categorie.index', compact('result'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorie.new');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request);
        $this->validate($request, [
            'libelle' => 'bail|required|min:2',
        ]);

        $data = array('libelle' => $request->libelle,'description'=> $request->description);
        $categorie = Categorie::create($data);
        // Create the user
        if ($categorie){
          

           // Mail::to($user->email)->send(new ResetPassword($user,$password));
            flash("Catégorie est crée.");

        } else {
            flash()->error('Probléme de création  catégorie.');
        }

        return redirect()->route('categories.index');
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
        $categorie = Categorie::find($id);
        return view('categorie.edit', compact('categorie'));
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
        $this->validate($request, [
            'libelle' => 'bail|required|min:2',
            
        ]);

       
        $categorie = Categorie::findOrFail($id);
        
        $data = array('libelle' => $request->libelle,'description'=> $request->description);

        $categorie->fill($data);
        $categorie->save();
      
      
      
      
        flash()->success('User has been updated.');

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        if(Categorie::findOrFail($id)->delete())
        {
            flash()->success(" Categorie supprimé");
        }else{
            flash()->success(" Probléme .");
        }
 
        return redirect()->route('categories.index');
    }
}
