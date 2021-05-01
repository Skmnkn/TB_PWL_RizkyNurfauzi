<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mail = Auth::user()->email;
        $users = User::all()->where('email', $mail);
        return view('profile', compact('users'));
    }
    public function change_password()
    {
        $mail = Auth::user()->email;
        $data = User::all()->where('email', $mail);
        return view('change_password', compact('data'));
    }

    public function change_password_update(Request $request, User $profile)
    {
        $validated = $request->validate([
            'password' => 'required|confirmed|min:5',
        ]);
        if ($validated == TRUE) {
            $data = User::find($request->id);
            $data->password = bcrypt($request->password);
            $data->save();
            $notification = array(
                'message' => 'Password Berhasil Diubah',
                'alert-type' => 'success'
            );
            return redirect()->route('change.password')->with($notification);
        } else {
            return redirect()->route('change.password');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //O

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, User $profile)
    {
        //
        $newData = User::find($profile->id);
        $newData->name = $request->name;
        $newData->email = $request->email;
        $newData->username = $request->username;

        $newData->save();

        return redirect()->route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
