<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class ResetPasswordController extends Controller
{
    public function show()
    {
        if (!Session::has('reset_email')) {
            return redirect()->route('forgetpassword');
        }

        return view('resetpassword');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password'
        ]);

        $email = Session::get('reset_email');

        try {
            DB::table('utilisateur')
                ->where('email', $email)
                ->update(['mot_de_passe' => Hash::make($request->new_password)]);

            Session::forget('reset_email');
            Session::flash('reset_success', true);
            return redirect()->route('signin');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Une erreur est survenue.'])->withInput();
        }
    }
}