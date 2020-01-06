<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use App\SchedaOre;
use App\Project;
class SchedaoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements=SchedaOre::all();
        return view('schedaore.index',compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $elements= Project::all();
        return view('schedaore.create',compact('elements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input=$request->all();
        $validator=Validator::make($input,[
            'data_scheda'=>'required|date',
            'hours_work'=>'required|min:0',
            'note'   => 'required|max:255',
            'project_name'   => 'required|exists:projects,name'
        ]);
        if ($validator->fails()) {
            return redirect('schedaore/create')
                ->withErrors($validator)
                ->withInput();
        }

        SchedaOre::create($input);
        return redirect('schedaore');

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
        SchedaOre::find($id)->delete();
        return redirect('schedaore');
    }
}
