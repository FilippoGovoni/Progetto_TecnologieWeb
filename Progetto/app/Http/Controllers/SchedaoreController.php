<?php

namespace App\Http\Controllers;

use App\lavora_su;
use Illuminate\Http\Request;
use Validator;
use App\SchedaOre;
use App\Project;
class SchedaoreController extends Controller
{
    
    public function index()
    {
        $schede=SchedaOre::orderBy('data_scheda')->get();
        return view('schedaore.index',compact('schede'));
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
        
        for($i=0; $i < count(SchedaOre::all()) ;$i++){
            $scheda=SchedaOre::all()[$i];
            if(($scheda->user_id == $controllo->user_id) &&($scheda->data_scheda == $controllo->data_scheda)){
                $errors=['Hai già inserito una scheda con questa data'];
                return back()
                    ->withErrors($errors)
                    ->withInput();
            }
        }
        /*$progetto=Project::where('name','=',$request->project_name);
        if(($request->data_scheda < $progetto->data_inizio) && ($request->data_scheda > $progetto->data_fine)){
            $errors=['La data inserita contrasta le date del progetto'];
            return back()
                ->withErrors($errors)
                ->withInput();
        }*/

        $validator=Validator::make($input,[
            'data_scheda'=>'required|date',
            'hours_work'=>'required|min:0',
            'note'   => 'required|max:255',
            'project_name'   => 'required|exists:projects,name',
            'user_id' =>'required'
        ]);
        if ($validator->fails()) {
            return redirect('schedaore/create')
                ->withErrors($validator)
                ->withInput();
        }


        SchedaOre::create($input);
        return redirect('schedaore');

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
        return redirect('/schedaore');
    }
}
