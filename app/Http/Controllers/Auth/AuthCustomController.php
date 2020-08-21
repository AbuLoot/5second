<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use Auth;

use App\User;
use App\Role;
use App\Profile;
use App\Region;
use App\Http\Controllers\Controller;

class AuthCustomController extends Controller
{
    public function getLogin()
    {
        return view('account.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|min:8|max:80'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/');
        }
        else {
            return redirect()->back()->withInput()->withWarning('Не правильный логин или пароль.');
        }
    }

    public function getRegister()
    {
        return view('account.register');
    }

    protected function postRegister(Request $request, $lang)
    {
        $validatedData = $this->validate($request, [
            'surname' => 'required|min:2|max:40',
            'name' => 'required|min:2|max:40',
            'phone' => 'required|min:11|max:11|unique:profiles',
            'email' => 'required|email|max:255|unique:users',
            // 'sex' => 'required',
            // 'password' => 'required|confirmed|min:6|max:255',
            // 'rules' => 'accepted'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->surname = '';
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($user == true) {

            $role = Role::where('name', 'user')->first();
            $user->roles()->sync($role->id);

            $profile = new Profile;
            $profile->sort_id = $user->id;
            $profile->user_id = $user->id;
            $profile->region_id = 1;
            $profile->phone = $request->phone;
            $profile->gov_number = $request->gov_number;
            $profile->barcode = $request->barcode;
            $first_num = substr($request->barcode, 0, 1);
            $profile->card_type = trans('data.card_types_number.'.$first_num);
            // $profile->sex = $request['sex'];
            $profile->save();

            return redirect($lang.'/cs-login')->withInput()->withInfo('Регистрация успешно завершина. Войдите через email и пароль.');
        }
        else {
            return redirect()->back()->withInput()->withErrors('Неверные данные');
        }
    }

    public function getLoginAndRegister()
    {
        $regions = Region::orderBy('sort_id')->get()->toTree();

        return view('account.login-and-register', ['regions' => $regions]);
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect('/');
    }
}
