<?php

namespace App\Http\Controllers;

use Validator;

use App\Client;
use App\User;
use App\Project;
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

        return view('project.index',compact('elements'));
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
            'data_inizio'   => 'required',
            'data_fine'   => 'required',
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
        $input = $request->all();

        $project = Project::find($id);
        $project->update($input);

        return redirect("/project"); // Show
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $elemento = Project::find($id);
        $elemento->delete();

        redirect("\project");
    }
}
