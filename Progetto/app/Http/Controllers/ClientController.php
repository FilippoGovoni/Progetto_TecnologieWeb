<?php

namespace App\Http\Controllers;

use Validator;

use App\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $elements=Client::all();

        return view('client.index',compact('elements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('client.create');
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
            'ragione_sociale'      => 'required|max:16',
            'nome_referente'        => 'required|max:20',
            'cognome_referente'   => 'required|max:20',
            'Email_referente'   => 'required',
            'SSID'   => 'required',
            'PEC'   => 'required',
            'PIVA'   => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('client/create')
                ->withErrors($validator)
                ->withInput();
        }

        Client::create($input);
        
        return redirect('/client');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $elemento = Client::find($id);
        
        return view('client.show', compact('elemento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = Client::find($id);

        return view('client.edit',compact('client'));
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

        $client = Client::find($id);
        $client->update($input);

        return redirect("/client/{$id}"); // Show
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $elemento = Client::find($id);
        $elemento->delete();

        redirect("\client");
    }
}
