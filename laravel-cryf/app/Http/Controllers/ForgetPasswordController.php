<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ForgetPasswordController extends Controller
{
    public function show()
    {
        return view('forgetpassword');
    }

    public function handle(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $email = $request->input('email');

        $user = DB::table('utilisateur')->where('email', $email)->first();

        if ($user) {
            Session::put('reset_email', $email);
            return redirect('/resetpassword');
        } else {
            return back()->with('error_message', "Aucun compte n'est associé à cette adresse email.");
        }
    }
}
