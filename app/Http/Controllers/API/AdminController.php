<?php

namespace App\Http\Controllers\API;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
     //todo: admin login form
     public function login_form()
     {
         return view('admin.login-form');
     }
 
     //todo: admin login functionality
     public function login_functionality(Request $request){
         $request->validate([
             'email'=>'required',
             'password'=>'required',
         ]);
 
         if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
             return redirect()->route('dashboard');
         }else{
             Session::flash('error-message','Invalid Email or Password');
             return back();
         }
     }
 
     public function dashboard()
     {
         return view('admin.dashboard');
     }
 
 
     //todo: admin logout functionality
     public function logout(){
         Auth::guard('admin')->logout();
         return redirect()->route('login.form');
     }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
