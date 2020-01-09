<?php

namespace App\Http\Controllers;

use Validator;

use App\Client;
use App\User;
use App\Project;
use App\lavora_su;
use App\SchedaOre;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements=Project::all();
        $lavora= lavora_su::all();

        return view('project.index',compact('elements','lavora'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $clients=Client::all();

        return view('project.create',compact('users','clients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        
        $validator = Validator::make($input, [
            'name'      => 'required|max:50',
            'description'        => 'required|max:255',
            'notes'   => 'required|max:50',
            'data_inizio'   => 'required|date',
            'data_fine'   => 'required|date|after:data_inizio',
            'costo_orario'   => 'required|min:0',
            'client_id'   => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('project/create')
                ->withErrors($validator)
                ->withInput();
        }

        Project::create($input);
        
        return redirect('/project');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $elemento= Project::find($id);
        $utenti= lavora_su::all()->where('project_id','=',$id);

        return view("project.show",compact('elemento','utenti'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project=Project::find($id);
        $users=User::all();

        return view('project.edit',compact('project','users'));
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
        $project_id = $id;
        $user_id = $request->user_id;
        
        lavora_su::create(['user_id'=>$user_id,'project_id'=>$project_id]);

        return redirect("/project");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Project::find($id)->delete();

        return redirect("/project");
    }
}
