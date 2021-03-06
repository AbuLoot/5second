<?php

namespace App\Http\Controllers\Joystick;

use Illuminate\Http\Request;
use App\Http\Controllers\Joystick\Controller;

use App\Slide;

use Storage;

class SlideController extends Controller
{
    public function index()
    {
        $slides = Slide::orderBy('sort_id')->paginate(50);

        return view('joystick-admin.slides.index', compact('slides'));
    }

    public function create($lang)
    {
        return view('joystick-admin.slides.create');
    }

    public function store(Request $request)
    {    	
        $this->validate($request, [
            'title' => 'required|min:2|max:80|unique:slides',
            'image' => 'required',
        ]);

        $item = new Slide;

        if ($request->hasFile('image')) {

            $imageName = $request->image->getClientOriginalName();

            $request->image->storeAs('img/slides', $imageName);
        }

        $item->sort_id = ($request->sort_id > 0) ? $request->sort_id : $item->count() + 1;
        $item->slug = (empty($request->slug)) ? str_slug($request->title) : $request->slug;
        $item->title = $request->title;
        $item->marketing = $request->marketing;
        $item->link = $request->link;
        $item->image = $imageName;
        $item->lang = $request->lang;
        $item->status = ($request->status == 'on') ? 1 : 0;
        $item->direction = $request->direction;
        $item->color = $request->color;
        $item->save();

        return redirect($request->lang.'/admin/slides')->with('status', 'Запись добавлена.');
    }

    public function edit($lang, $id)
    {
        $item = Slide::findOrFail($id);

        return view('joystick-admin.slides.edit', compact('item'));
    }

    public function update(Request $request, $lang, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:2|max:80',
        ]);

        $item = Slide::findOrFail($id);

        if ($request->hasFile('image')) {

            if (file_exists('img/slides/'.$item->image)) {
                Storage::delete('img/slides/'.$item->image);
            }

            $imageName = $request->image->getClientOriginalName();

            $request->image->storeAs('img/slides', $imageName);
        }

        $item->sort_id = ($request->sort_id > 0) ? $request->sort_id : $item->count() + 1;
        $item->slug = (empty($request->slug)) ? str_slug($request->title) : $request->slug;
        $item->title = $request->title;
        $item->marketing = $request->marketing;
        $item->link = $request->link;
        if (isset($imageName)) $item->image = $imageName;
        $item->lang = $request->lang;
        $item->status = ($request->status == 'on') ? 1 : 0;
        $item->direction = $request->direction;
        $item->color = $request->color;
        $item->save();

        return redirect($lang.'/admin/slides')->with('status', 'Запись обновлена.');
    }

    public function destroy($lang, $id)
    {
        $item = Slide::find($id);

        if (file_exists('img/slides/'.$item->image)) {
            Storage::delete('img/slides/'.$item->image);
        }

        $item->delete();

        return redirect($lang.'/admin/slides')->with('status', 'Запись удалена.');
    }
}
