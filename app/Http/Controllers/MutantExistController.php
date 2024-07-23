<?php

namespace App\Http\Controllers;

use App\Models\Proprietaire;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MutantExistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etablissements = Etablissement::where('status','!=','En attente')->with('proprietaires')->get();
        return view('saisisseur.mutation_existant.index')->with('etablissements', $etablissements);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $etablissement = Etablissement::with('proprietaires')->find($id);
        return view('saisisseur.mutation_existant.edit')
            ->with('etablissement', $etablissement);  
    }

    public function index_existant()
    {
        if (Auth()->user()->role == "admin_par_region") {
            $etablissements = DB::table('communes')
                ->join('etablissements as a', 'a.commune_id', '=', 'communes.id')
                ->join('proprietaires', 'proprietaires.id', '=', 'a.proprietaire_id')
                ->join('etablissements as b', 'b.proprietaire_id', '=', 'proprietaires.id')
                ->select('*')
                ->where('region', '=', Auth()->user()->region_user)->get();
        } else {
            $etablissements = DB::table('proprietaires')
                ->join('etablissements', 'etablissements.proprietaire_id', '=', 'proprietaires.id')
                ->select('*')
                ->get();
        }
        return view('saisisseur.mutation_existant.index_existant')->with('etablissements', $etablissements);
    }

    public function mutation_existant($etab_id, $new_prop_id)
    {
        $nouveau_prop = Proprietaire::findOrFail($new_prop_id);
        $nouveau_prop->lien = $nouveau_prop->lien + 1;
        //dd($nouveau_prop);
        $etablissement = Etablissement::with('proprietaires')->find($etab_id);
        // dd($etablissement);
        
        $temp = $etablissement->proprietaires->first()->id;
        
        $etablissement->proprietaires->first()->id= $nouveau_prop->id;
        $etablissement->type= "U";
        $etablissement->status= "En attente";
        $etablissement->save();

        $ancien_prop = Proprietaire::findOrFail($temp);
        if (intval($ancien_prop->lien))
        {
            $ancien_prop->lien = $ancien_prop->lien - 1;
            $etablissement->proprietaires()->detach($ancien_prop->id);
        }
        else
        {
            $ancien_prop->delete();
        }
        $ancien_prop->save();
        $nouveau_prop->save();

        $etablissement->proprietaires()->attach($nouveau_prop->id);
        

        return redirect()->route('mutation_existant.index')->with('message', 'Mutation enregistréé');
        
    }
    public function ft_search(Request $request, $id)
    {
        
        // $etablissement = Etablissement::findOrFail($id);
        $etablissement = Etablissement::with('proprietaires')->find($id);
       // $etablissements = Etablissement::where('status','!=','En attente')->with('proprietaires')->get();
       // dd($etablissement->proprietaires->first()->id);
       if ($request->search_existant == "")
        {
            return redirect()->back();
        }
        $new_proprietaires = Proprietaire::with('etablissements')
                            ->where('cin', 'like', "%$request->search_existant%")
                            ->orWhere('nom', 'like', "%$request->search_existant%")->get();
      //  dd($etablissement);
        return view('saisisseur.mutation_existant.edit_existant')->with('etablissement', $etablissement)->with('new_proprietaires',$new_proprietaires);
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
      //  dd('coucou');
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
    }
}
