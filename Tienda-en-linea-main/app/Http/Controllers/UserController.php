<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\ChangePasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $users = User::get();
        return view('admin.user.index', compact('users'));
    }
    public function create()
    {

        return view('admin.user.create');
    }
    public function store(Request $request)
    {
        $user = User::create($request->all());
        $user->update(['password' => Hash::make($request->password)]);
        return redirect()->route('users.index');
    }
    public function show(User $user)
    {
        $total_amount_sold = 0;
        foreach ($user->sales as $key =>  $sale) {
            $total_amount_sold += $sale->total;
        }
        return view('admin.user.show', compact('user', 'total_amount_sold'));
    }
    public function edit(User $user)
    {
        $roles = Role::get();
        return view('admin.user.edit', compact('user'));
    }
    public function update(Request $request, User $user)
    {
        if ($user->id == 1) {
            return redirect()->route('users.index');
        } else {
            $user->update($request->all());
            return redirect()->route('users.index');
        }
    }
    public function destroy(User $user)
    {
        if ($user->id == 1) {
            return back();
        } else {
            $user->delete();
            return back();
        }
    }
    public function update_client(Request $request, User $user)
    {
        $user->update_client($request);
        return back();
    }
    public function update_password(ChangePasswordRequest $request, User $user)
    {
        $user->update([
            'password'=> Hash::make($request->password)
        ]);
        return back();
    }
}
