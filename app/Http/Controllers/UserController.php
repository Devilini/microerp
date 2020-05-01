<?php

namespace App\Http\Controllers;

use App\Transport;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function index()
    {
        $users = User::with('transport')->paginate(15);

        return view('users.index', compact(['users']));
    }

    public function create()
    {
        $transport = Transport::all();

        return view('users.create', compact(['transport']));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'transport_id' => 'nullable'
        ];

        User::validate($request->all(), $rules);
        $user = new User;
        $user->add($request->all());

        return redirect()->route('users.index')->with('success','Новый пользователь успешно добавлен!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $transport = Transport::all()->except($user->transport ? $user->transport->id : '');

        return view('users.edit', compact(['user','transport']));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $rules = [
            'name' => 'required|max:100',
            'email' =>  [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'transport_id' => 'nullable'
        ];
        User::validate($request->all(), $rules);
        $user->edit($request->all());

        return redirect()->route('users.index')->with('success','Данные успешно обновлены!');
    }

    public function destroy($id)
    {
        $transport = User::findOrFail($id);
        $transport->delete();

        return redirect()->route('users.index')->with('success','Пользователь успешно удален!');
    }

    public function showProfile()
    {
        //$user = User::with('transport.type')->where('id', Auth::user()->id)->get();
        $user = Auth::user();

        return view('users.profile', compact('user'));
    }

}
