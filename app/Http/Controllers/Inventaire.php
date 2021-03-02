<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use Illuminate\Support\Facades\DB;
class Inventaire extends Controller
{
    //

    public function index(){
        $ticket = DB::table('tickets')
                ->select(DB::raw('sum(qt*prix) as total'),'id_ticket')
                ->groupBy('id_ticket')
                ->get();

        return \view('inventaire.index',compact('ticket'));
    }

    public function show(Request $request){
        $id_ticket = $request->id_ticket;
       // dd($id_ticket);
        $ticket = Ticket::where('id_ticket',$id_ticket)->get();
        return $ticket;
    }

    public function supprimer(Request $request){
        $id_ticket = $request->id_ticket;
        Ticket::where('id_ticket',$id_ticket)->delete();
        $ticket = DB::table('tickets')
            ->select(DB::raw('sum(qt*prix) as total'),'id_ticket')
            ->groupBy('id_ticket')
            ->get();
        $html = "";
      // dd($ticket);
       $html = $html."<table id='example'  style='width:100%' class='display nowrap table table-bordered table-striped table-hover' id='data-table'>
            <thead>
                <tr>
                    <th>ID TICKET</th>
                    <th>LIBELLE</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>";
                  foreach ($ticket as $item){
                  $html = $html."<tr>
                        <td>$item->id_ticket</td>
                        <td>$item->total</td>
                        <td>
                            <button class='btn-show btn btn-xs btn-success' onclick='return voir_ticket($item->id_ticket)'>
                                <i class='far fa-eye'></i>
                                 voir ticket
                            </button>
                            <button  class='btn-delete btn btn-xs btn-danger' onclick='return delete_ticket($item->id_ticket)'>
                                <i class='fa fa-trash'></i>
                            </button>
                        </td>
                    </tr>";
                  }
            $html = $html."</tbody>
     </table>";
      //dd($html);
     return $html;
    }
}
