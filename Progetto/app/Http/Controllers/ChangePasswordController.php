<?php

namespace App\Http\Controllers;

use App\User;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Exception;

class ChangePasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("auth.passwords.change");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cambia_password(Request $request)
    {
        $input = $request->all();
        $user = User::where('email','=', $request->email)->first();
        if ($user!=null) {
            /*if ($user->password != bcrypt("UserPass")) {
                return back()->withErrors(["Hai già cambiato la password"])->withInput();
            }*/

            $validator = Validator::make($input, [
                'email' => 'required',
                'password' => 'required',
                'password_di_controllo'   => 'required|same:password',
            ]);
            if ($validator->fails()) {
                return redirect('change')
                    ->withErrors($validator)
                    ->withInput();
            }

            $user->update(['password' => bcrypt($request->password)]);
            return redirect('login');
        } else {
            return back()->withErrors(["L'indirizzo email inserito è errato"])->withInput();      
        }
    }
}
