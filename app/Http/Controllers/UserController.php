<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("admin.users.index")->with("users", User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.users.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route("admin.users.index")
            ->with("success", "User created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("admin.users.edit")->with("user", User::findOrFail($id));
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
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->route("admin.users.index")
            ->with("success", "User updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($id == 1)
        {
            return redirect()->route("admin.users.index")
                ->with("errors", "The default user cannot be removed");
        }

        User::findOrFail($id)->delete();

        return redirect()->route("admin.users.index")
            ->with("success", "User deleted successfully");
    }

    /**
     * Update the user's password
     * 
     * @param  Request $request
     * @param  int     $id
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route("admin.users.index")
            ->with("success", "User's password updated successfully");
    }

    /**
     * Change the role of a user (atm only admin exists)
     * 
     * @param  Request $request
     * @param  int     $id
     * @return \Illuminate\Http\Response
     */
    public function elevatePrivileges(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($id == 1 && $request->is_admin == 0)
        {
            return redirect()->route("admin.users.index")
                ->with("errors", "The default user must be an admin");
        }

        $user->is_admin = $request->is_admin;
        $user->save();

        return redirect()->route("admin.users.index")
            ->with("success", $user->name . " had their privileges elevated");
    }
}
