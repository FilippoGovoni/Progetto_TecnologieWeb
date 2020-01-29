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
        $user = User::all()->where('email', '=', $request->email);
        if (count($user) == 0) {
            return back()->withErrors(["L'indirizzo email inserito è errato"])->withInput();
        } else {

            if ($user[1]->password == "UserPass") {
                return back()->withErrors(["Hai già cambiato la password"])->withInput();
            }

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

            $user[1]->update(['password' => $request->password]);
            return redirect('login');
        }
    }
}
