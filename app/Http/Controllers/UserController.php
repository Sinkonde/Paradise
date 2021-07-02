<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\UserControllerTrait;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    use UserControllerTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('app.resource.user.index', ['users'=>User::where('email','!=', null)->get()]);
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
        //add roles
        if($request->store == 'role'){
            $request->validate(['role'=>'required', 'user_id'=>'required']);
            User::find($request->user_id)->assignRole($request->role);
        }

        //remove roles
        if($request->action == 'deleteRole'){
            $request->validate(['role'=>'required', 'user_id'=>'required']);
            User::find($request->user_id)->removeRole($request->role);
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('app.resource.user.crud.show', ['user'=>$user, 'roles'=>Role::all()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('app.resource.user.crud.edit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->for == 'block_'.$user->id.csrf_token()) {
            $this->blockUser($user);
        }
        elseif($request->for == 'grant_'.$user->id.csrf_token()){
            $this->grantUser($user);
        }
        else
        {
            $request->validate([
                'first_name' => 'required',
                'sur_name' => 'required',
            ]);

            $user->update($request->except(['_token', '_method', '_callback']));
        }

        return redirect(route('users.show',$user->id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
