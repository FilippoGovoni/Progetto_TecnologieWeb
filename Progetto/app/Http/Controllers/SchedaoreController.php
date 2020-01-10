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
        $schede=SchedaOre::all();
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
        $validator=Validator::make($input,[
            'data_scheda'=>'required|date|unique:scheda_ores,data_scheda',
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
