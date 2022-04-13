<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Parrain;
use Illuminate\Http\Request;

class ParrainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $parrain = Parrain::find($id);

        if($parrain == null) { 
            return redirect()->back()->with(['flash_danger', "L'identifiant de cet parrain n'existe pas"]); 
        }

        return view('backend.parrains.edit', ['parrain' => $parrain]);
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
        $this->validate($request, [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'nin' => ['required', 'string'],
            'nce' => ['required', 'string'],
            'taille' => ['required', 'integer'],
            'phone' => ['required', 'integer'],
        ]);
        
        $parrain = Parrain::find($id);
        if($parrain == null) {
            return redirect()->back()->with(['flash_danger' => "L'identifiant fournit ne correspond à aucun enregistrement"]);
        }

        $parrain->update($request->all());

        return redirect()->route('admin.dashboard')->with(['flash_success' => "Modification de réussi !"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd($id);
        $parrain = Parrain::find($id);

        if($parrain == null) return redirect()->back()->with(['flash_danger' => "L'identifiant fournit ne correspond à aucun enregistrement"]);

        $parrain->delete();
        return redirect()->route('admin.dashboard')->with(['flash_sucess' => "Suppression réussi !"]);
    }
}
