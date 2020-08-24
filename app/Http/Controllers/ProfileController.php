<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\App;
use App\User;
use App\Card;
use App\Order;
use App\Region;
use App\Product;
use App\PaymentLog;
use App\Http\Requests;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $card = Card::where('slug', $user->privilege->slug)->first();

        $future = strtotime($user->privilege->term); //Future date.
        $current = time();
        $time_left = $future - $current;
        $days_left = round((($time_left/24)/60)/60);

        switch($days_left) {
            case 0:
                $user->privilege->term = NULL;
                $user->privilege->status = 0;
                $user->privilege->save();
                break;

            case 1: case 21:
                $days_left .= ' день';
                break;

            case 2: case 3: case 4: case 22: case 23: case 24:
                $days_left .= ' дня';
                break;

            default:
                $days_left .= ' дней';
        }

        return view('account.profile-show', compact('user', 'card', 'days_left'));
    }

    public function edit()
    {
        $user = Auth::user();
        $regions = Region::orderBy('sort_id')->get()->toTree();

        // $date = [];
        // list($date['year'], $date['month'], $date['day']) = explode('-', $user->profile->birthday);

        return view('account.profile-edit', compact('user', 'regions'));
    }

    public function cardSelection(Request $request)
    {
        $user = Auth::user();
        $cards = Card::orderBy('sort_id')->get();

        return view('account.card-selection', compact('user', 'cards'));
    }

    public function setCard(Request $request, $lang, $card_type)
    {
        $user = Auth::user();
        $card = Card::where('slug', $card_type)->first();
        $payment = PaymentLog::where('user_id', $user->id)->orderBy('id', 'DESC')->first();

        $status_text = 'Не достаточно средств!';

        if ($payment->amount >= $card->price) {
            $user->privilege->card_type = $card_type;
            $user->privilege->save();
            $status_text = 'Карта изменена!';
        }

        return redirect($lang.'/my-profile')->with('status', $status_text);
    }

    public function update(Request $request, $lang, $id)
    {
        $this->validate($request, [
            'surname' => 'required|min:2|max:40',
            'name' => 'required|min:2|max:40',
            'phone' => 'required|min:11|max:13',
            'sex' => 'required'
        ]);

        $user = Auth::user();

        $user->surname = $request->surname;
        $user->name = $request->name;
        // $user->email = $request->email;
        $user->save();

        $user->profile->phone = $request->phone;
        $user->profile->region_id = $request->region_id;
        $user->profile->birthday = $request->birthday;
        $user->profile->sex = $request->sex;
        $user->profile->about = $request->about;
        $user->profile->save();

        $user->privilege->gov_number = $request->gov_number;
        $user->privilege->card_type = $request->card_type;
        $user->privilege->barcode = $request->barcode;
        $user->privilege->save();

        return redirect($lang.'/my-profile')->with('status', 'Запись обновлена!');
    }

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

    public function myApps()
    {
        $user = Auth::user();
        $ids = $user->companies()->pluck('id');
        $apps = App::whereIn('company_id', $ids)->orderBy('created_at', 'desc')->paginate(30);

        return view('account.my-apps', compact('user', 'apps'));
    }

    public function statistics()
    {
        $user = Auth::user();
        $ids = $user->companies()->pluck('id');
        $count_apps = App::whereIn('company_id', $ids)->count();
        $count_ads = Product::whereIn('company_id', $ids)->count();

        return view('account.statistics', compact('user', 'count_apps', 'count_ads'));
    }

    public function myOrders()
    {
        $user = Auth::user();
        $orders = $user->orders()->paginate(10);

        return view('account.orders', compact('user', 'orders'));
    }
}
