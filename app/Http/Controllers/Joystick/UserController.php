<?php

namespace App\Http\Controllers\Joystick;

use Illuminate\Http\Request;
use App\Http\Controllers\Joystick\Controller;

use App\User;
use App\Role;
use App\Region;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at')->paginate(50);

        return view('joystick-admin.users.index', compact('users'));
    }

    public function edit($lang, $id)
    {
        $user = User::findOrFail($id);
        $regions = Region::orderBy('sort_id')->get()->toTree();
        $roles = Role::all();

        return view('joystick-admin.users.edit', compact('user', 'regions', 'roles'));
    }

    public function update(Request $request, $lang, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:60',
            'email' => 'required',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->surname = $request->surname;
        $user->email = $request->email;
        $user->save();

        $user->roles()->sync($request->roles_id);

        $user->profile->phone = $request->phone;
        $user->profile->region_id = $request->region_id;
        $user->profile->gov_number = $request->gov_number;
        $user->profile->card_type = $request->card_type;
        $user->profile->barcode = $request->barcode;
        $user->profile->birthday = $request->birthday;
        $user->profile->sex = $request->sex;
        $user->profile->about = $request->about;
        $user->profile->save();

        return redirect($lang.'/admin/users')->with('status', 'Запись обновлена!');
    }
}