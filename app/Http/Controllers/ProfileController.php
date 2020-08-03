<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\User;
use App\City;
use App\Order;
use App\Country;
use App\Http\Requests;

class ProfileController extends Controller
{
    public function balance()
    {
        $user = Auth::user();
        $operations = Operation::all();

        return view('profile.balance', compact('user', 'operations'));
    }

    public function topUpBalance(Request $request)
    {
        $this->validate($request, [
            'balance' => 'required|numeric|min:1'
        ]);

        $payment = new Payment;
        $payment->amount = $request->balance;
        $payment->operation_id = $request->operation_id;
        $payment->user_id = Auth::id();
        $payment->status = false;
        $payment->save();

        return view('profile.pay', compact('payment'));
    }

    public function payment()
    {
        return view('profile.pay-success');
        // return 'Платеж выполнен успешно! <a href="/">Вернуться на сайт.</a>';
    }

    public function orders(Request $request)
    {
        $countries = Country::all();

        if ($request->session()->has('items')) {

            $items = $request->session()->get('items');
            $data_id = collect($items['products_id']);
            $products = Product::whereIn('id', $data_id->keys())->get();
        }

        return view('account.order', compact('products', 'countries'));
    }

    public function myOrders()
    {
        $user = Auth::user();
        $orders = $user->orders()->paginate(10);

        return view('account.orders', compact('user', 'orders'));
    }

    public function profile(Request $request)
    {
        $user = Auth::user();

        return view('account.profile', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        $cities = City::orderBy('sort_id')->get();

        $date = [];

        list($date['year'], $date['month'], $date['day']) = explode('-', $user->profile->birthday);

        return view('profile.edit', compact('user', 'cities', 'date'));
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'surname' => 'required|min:2|max:40',
            'name' => 'required|min:2|max:40',
            'phone' => 'required|min:11|max:11',
            'email' => 'required|email|max:255',
            'city_id' => 'required|numeric',
            'sex' => 'required',
            'day' => 'required|numeric|between:1,31',
            'month' => 'required|numeric|between:1,12',
            'year' => 'required|numeric'
        ]);

        $user = Auth::user();
        $id = Auth::id();

        $user->surname = $request->surname;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->save();

        if ($request->hasFile('avatar')) {

            if (!file_exists('img/users/'.$id)) {
                mkdir('img/users/'.$id);
            }

            if (!empty($user->profile->avatar)) {
                Storage::delete('img/users/'.$id.'/'.$user->profile->avatar);
            }

            $imageName = 'avatar-'.str_random(10).'.'.$request->avatar->getClientOriginalExtension();
            $imagePath = 'img/users/'.$id.'/'.$imageName;

            $this->resizeImage($request->avatar, 200, 200, $imagePath, 100);
            $user->profile->avatar = $imageName;
        }

        $user->profile->city_id = $request->city_id;
        $user->profile->birthday = $request['year'].'-'.$request['month'].'-'.$request['day'];
        $user->profile->growth = $request->growth;
        $user->profile->weight = $request->weight;
        $user->profile->sex = $request->sex;
        $user->profile->save();

        return redirect('/my-profile')->with('status', 'Запись обновлена!');
    }
}
