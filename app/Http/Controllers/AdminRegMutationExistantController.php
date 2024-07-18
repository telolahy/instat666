<?php

namespace App\Http\Controllers;
 
use App\Models\Proprietaire;
use Illuminate\Http\Request;
use App\Models\Etablissement;
use Illuminate\Routing\Controller;

class AdminRegMutationExistantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $etablissements = Etablissement::where('status','!=','En attente')->with('proprietaires')->get();
        return view('admin_reg.mutation_existant.index')->with('etablissements', $etablissements);
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
        return view('admin_reg.mutation_existant.edit')
            ->with('etablissement', $etablissement);  
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
        //
    }

    public function ft_search(Request $request, $id)
    {
        // $etablissements = Etablissement::where('status','!=','En attente')->with('proprietaires')->get();
        // $etablissement = Etablissement::where('status','!=','En attente')->with('proprietaires')->get();
        $etablissement = Etablissement::with('proprietaires')->find($id);
        $search = $request->search_existant;
        // dd($search);
       if ($request == "")
        {
            return redirect()->back();
        }

        
         $new_proprietaires = Proprietaire::with('etablissements')
                             ->where('nom', 'like', "%$search%")
                             ->orWhere('cin', 'like', "%$search%")
                             ->orWhere('cin', 'like', "$search%")
                             ->orWhere('nom', 'like', "$search%")
                             ->get();
        // dd($new_proprietaires);
        // $new_proprietaires = Proprietaire::whereHas('etablissements', function ($query) use ($id) {
        //                         $query->where('etablissement_id', $id);
        //                     })
        //                     ->where(function($query) use ($search) {
        //                         $query->where('cin', 'like', "%$search%")
        //                             ->orWhere('nom', 'like', "%$search%");
        //                     })
        //                     ->get();

    
        return view('admin_reg.mutation_existant.edit_existant')
                ->with('etablissement', $etablissement)
                ->with('new_proprietaires',$new_proprietaires);
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
        

        return redirect()->route('reg_etab.index')->with('message', 'Mutation enregistréé');
        
    }
}
