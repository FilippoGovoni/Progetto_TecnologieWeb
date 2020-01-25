<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Client;
use Validator;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax())
        {
            return datatables()->of(Client::latest()->get())
                    ->addColumn('action', function($data){
                        $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm">Modifica</button>';
                        $button .= '&nbsp;&nbsp;';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm">Elimina</button>';
                        return $button;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('client.index');
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
        $rules = array(
            'ragione_sociale'      => 'required|max:16',
            'nome_referente'        => 'required|max:20',
            'cognome_referente'   => 'required|max:20',
            'Email_referente'   => 'required',
            'SSID'   => 'required',
            'PEC'   => 'required',
            'PIVA'   => 'required',
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $form_data = array(
            'ragione_sociale'        =>  $request->ragione_sociale,
            'nome_referente'         =>  $request->nome_referente,
            'cognome_referente'         =>  $request->cognome_referente,
            'Email_referente'         =>  $request->Email_referente,
            'SSID'         =>  $request->SSID,
            'PEC'         =>  $request->PEC,
            'PIVA'              =>  $request->PIVA

        );

        Client::create($form_data);

        return response()->json(['success' => 'Elemento aggiunto con successo.']);
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
        if(request()->ajax())
        {
            $data = Client::findOrFail($id);
            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
            $rules = array(
                'ragione_sociale'      => 'required|max:16',
            'nome_referente'        => 'required|max:20',
            'cognome_referente'   => 'required|max:20',
            'Email_referente'   => 'required',
            'SSID'   => 'required',
            'PEC'   => 'required',
            'PIVA'   => 'required',

            );
            $error = Validator::make($request->all(), $rules);
            if($error->fails())
            {
                return response()->json(['errors' => $error->errors()->all()]);
            }
        

        $form_data = array(
            'ragione_sociale'        =>  $request->ragione_sociale,
            'nome_referente'         =>  $request->nome_referente,
            'cognome_referente'         =>  $request->cognome_referente,
            'Email_referente'         =>  $request->Email_referente,
            'SSID'         =>  $request->SSID,
            'PEC'         =>  $request->PEC,
            'PIVA'              =>  $request->PIVA

        );
        Client::whereId($request->hidden_id)->update($form_data);

        return response()->json(['success' => 'Elemento aggiornato']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Client::findOrFail($id);
        $data->delete();
    }
}