<?php

namespace App\Http\Controllers\Joystick;

use Illuminate\Http\Request;
use App\Http\Controllers\Joystick\Controller;
use App\Card;

class CardController extends Controller
{
    public function index()
    {
        $cards = Card::orderBy('sort_id')->get();

        return view('joystick-admin.cards.index', compact('cards'));
    }

    public function create($lang)
    {
        $cards = Card::orderBy('sort_id')->get();

        return view('joystick-admin.cards.create', ['cards' => $cards]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:2|max:80|unique:cards',
        ]);

        $card = new card;
        $card->sort_id = ($request->sort_id > 0) ? $request->sort_id : $card->count() + 1;
        $card->slug = (empty($request->slug)) ? str_slug($request->title) : $request->slug;
        $card->title = $request->title;
        $card->image = $request->image;
        $card->price = $request->price;
        $card->user_number = $request->user_number;
        $card->service_number = $request->service_number;
        $card->meta_title = $request->meta_title;
        $card->meta_description = $request->meta_description;
        $card->content = $request->content;
        $card->lang = $request->lang;
        $card->status = ($request->status == 'on') ? 1 : 0;
        $card->save();

        return redirect($request->lang.'/admin/cards')->with('status', 'Запись добавлена!');
    }

    public function edit($lang, $id)
    {
        $card = Card::findOrFail($id);
        $cards = Card::orderBy('sort_id')->get();

        return view('joystick-admin.cards.edit', compact('card', 'cards'));
    }

    public function update(Request $request, $lang, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:2|max:80',
        ]);

        $card = Card::findOrFail($id);
        $card->sort_id = ($request->sort_id > 0) ? $request->sort_id : $card->count() + 1;
        $card->slug = (empty($request->slug)) ? str_slug($request->title) : $request->slug;
        $card->title = $request->title;
        $card->image = $request->image;
        $card->price = $request->price;
        $card->user_number = $request->user_number;
        $card->service_number = $request->service_number;
        $card->meta_title = $request->meta_title;
        $card->meta_description = $request->meta_description;
        $card->content = $request->content;
        $card->lang = $request->lang;
        $card->status = ($request->status == 'on') ? 1 : 0;
        $card->save();

        return redirect($lang.'/admin/cards')->with('status', 'Запись обновлена!');
    }

    public function destroy($lang, $id)
    {
        $card = Card::find($id);
        $card->delete();

        return redirect($lang.'/admin/cards')->with('status', 'Запись удалена!');
    }
}
