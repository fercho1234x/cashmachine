<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.store')->only('store');
        $this->middleware('can:users.show')->only('show');
        $this->middleware('can:users.update')->only('update');
        $this->middleware('can:users.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('type')->paginate(5);
        return $this->showAll($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create($request->validated());
        $user->assignRole($request->role ? $request->role : 'cliente');
        return $this->showOne($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return $this->showOne($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UserRequest $request)
    {
        $user->update($request->validated());
        if ($request->role && $user->getRoleNames()[0] != $request->role) {
            $user->removeRole($user->roles[0]->name);
            $user->assignRole($request->role);
        }
        return $this->showOne($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return $this->showOne($user);
    }
}
