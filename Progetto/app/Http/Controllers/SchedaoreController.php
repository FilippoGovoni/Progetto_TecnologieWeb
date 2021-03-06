<?php

namespace App\Http\Controllers;
use DB;
use App\lavora_su;
use Illuminate\Http\Request;
use Validator;
use App\SchedaOre;
use App\Project;
class SchedaoreController extends Controller
{
    
    public function index()
    {
        /*$schede=SchedaOre::orderBy('data_scheda')->get();
        return view('schedaore.index',compact('schede'));*/
    }

    
    public function create()
    {   
        $elements= lavora_su::all();
        $schede=SchedaOre::all();
        return view('schedaore.create',compact('elements','schede'));
    }

   
    public function store(Request $request)
    {

        $input=$request->all();
        
        $controllo=new Schedaore();
        $controllo->user_id=request('user_id');
        $controllo->data_scheda=request('data_scheda');
        $controllo->project_id=request('project_id');
        
        for($i=0; $i < count(SchedaOre::all()) ;$i++){
            $scheda=SchedaOre::all()[$i];
            if(($scheda->user_id == $controllo->user_id) &&($scheda->data_scheda == $controllo->data_scheda) && ($scheda->project_id == $controllo->project_id)){
                $errors=['Hai già inserito una scheda con questa data'];
                return back()
                    ->withErrors($errors)
                    ->withInput();
            }
        }
        $progetto=Project::find($controllo->project_id);

        
        if(($controllo->data_scheda< $progetto->data_inizio) || ($controllo->data_scheda> $progetto->data_fine)){
            return back()->withErrors(['Data scheda non valida (fuori dalle date del progetto)'])->withInput();
        }
        if( ($controllo->hours_work >24) || ($controllo->hours_work <1) ){
            return back()->withErrors(['Ore lavoro della scheda non valido'])->withInput();
        } 


        $validator=Validator::make($input,[
            'data_scheda'=>'required|date',
            'hours_work'=>'required|min:0',
            'note'   => 'required|max:255',
            'project_id'   => 'required',
            'user_id' =>'required'
        ]);
        if ($validator->fails()) {
            return redirect('schedaore/create')
                ->withErrors($validator)
                ->withInput();
        }

        $month = date('n');
        $anno = date('Y');
        SchedaOre::create($input);
        return redirect("/att_mensile/{$month}/{$anno}");

    }

    
    public function show($id)
    {
        $schede=SchedaOre::all();
        return view('schedaore.index',compact('schede'));
    }

   
    public function edit($id)
    {
        //
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        SchedaOre::find($id)->delete();
        $month = date('n');
        $anno = date('Y');
        return redirect("/att_mensile/{$month}/{$anno}");
    }




    public function att_mensile($month,$anno){    

        $schede=SchedaOre::whereMonth('data_scheda',$month)->whereYear('data_scheda',$anno)->orderBy('data_scheda')->get();
        //$schede=SchedaOre::whereMonth('data_scheda',$month)->get();
        return view('schedaore.att_mensile',compact('schede','month','anno'));
    }
}