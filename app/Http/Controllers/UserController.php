<?php

namespace App\Http\Controllers;

use App\Transport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('transport')->get();

        return view('users.index', compact(['users']));
    }

    public function create()
    {
        $transport = Transport::all();
        return view('users.create', compact(['transport']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'transport_id' => 'nullable'
        ]);

        $user = new User;
        $user->add($request->all());

        return redirect()->route('users.index')->with('success','Новый пользователь успешно добавлен!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $transport = Transport::all();
        return view('users.edit', compact(['user','transport']));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => 'required',
            'email' =>  [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'transport_id' => 'nullable',
        ]);

        $user->edit($request->all());

        return redirect()->route('users.index')->with('success','Данные успешно обновлены!');
    }

    public function destroy($id)
    {
        User::where('id',$id)->delete();
        return redirect()->route('users.index')->with('success','Пользователь успешно удален!');
    }

}
