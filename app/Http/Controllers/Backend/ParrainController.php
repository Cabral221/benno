<?php

namespace App\Http\Controllers\Backend;

use Carbon\Carbon;
use App\Models\Parrain;
use PDF;
use Shuchkin\SimpleXLSXGen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ParrainController extends Controller
{
    
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
            'nin' => ['required', 'string', 'unique:parrains,nin,' . $id],
            'nce' => ['required', 'string', 'unique:parrains,nce,' . $id],
            'taille' => ['required', 'integer'],
            'phone' => ['required', 'integer', 'unique:parrains,phone,' . $id],
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
        $parrain = Parrain::find($id);
        
        if($parrain == null) return redirect()->back()->with(['flash_danger' => "L'identifiant fournit ne correspond à aucun enregistrement"]);
        
        $parrain->delete();
        return redirect()->route('admin.dashboard')->with(['flash_success' => "Suppression réussi !"]);
    }
    
    public function exportCsv(Request $request)
    {
        $fileName = 'list-parrainage-'. Carbon::now() .'.xlsx';
        $parrains = Parrain::all();
        
        $headers = array(
            "Content-type"        => "text/xlsx",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        
        $columns = array('Prenom', 'Nom', 'NCE', 'NIN', 'Taille', 'Telephone');
        
        $callback = function() use($parrains, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            
            foreach ($parrains as $parrain) {
                $row['Prenom']  = $parrain->first_name;
                $row['Nom']    = $parrain->last_name;
                $row['NCE']    = $parrain->nce;
                $row['NIN']  = $parrain->nin;
                $row['Taille']  = $parrain->taille;
                $row['Telephone']  = $parrain->phone;
                
                fputcsv($file, array($row['Prenom'], $row['Nom'], $row['NCE'], $row['NIN'], $row['Taille'], $row['Telephone']));
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
    
    public function exportExcel(Request $request)
    {
        $parrains = Parrain::all();
        $array = [
            ['Prenom', 'Nom', 'NCE', 'NIN', 'Taille', 'Telephone']
        ];
        
        foreach ($parrains as $parrain) {
            $array[] = [
                $parrain->first_name,
                $parrain->last_name,
                $parrain->nce,
                $parrain->nin,
                $parrain->taille,
                $parrain->phone,
            ];
        }
        
        $xlsx = SimpleXLSXGen::fromArray($array);
        $xlsx->downloadAs('liste-parrains-'. Carbon::now() .'.xlsx');
    }

    public function exportPdf()
    {
        $data = ['title' => "Tester l'exportation PDF avec un Design"];

        $pdf = PDF::loadView('backend.parrains.exportPdf', $data);

        $pdf->setPaper('A4', 'landscape');
  
        return $pdf->download('itsolutionstuff.pdf');
    }
}
