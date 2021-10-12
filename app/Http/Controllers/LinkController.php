<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Link;
use Illuminate\Http\RedirectResponse;

class LinkController extends Controller
{
    public function index()
    {
        $data['links'] = Link::all();

        return view('links', $data);
    }

    public function save()
    {
        $request = request()->all();
        $item = new Link();
        $item->title = $request['title'];
        $item->turkey = $request['turkey'];
        $item->australia = $request['australia'];
        $item->canada = $request['canada'];
        $item->england = $request['england'];
        $item->usa = $request['usa'];
        $item->save();

        return redirect()->back();
    }

    public function edit()
    {
        $data['links'] = Link::all();

        return view('links_edit', $data);
    }

    public function delete($id): RedirectResponse
    {
        Comment::where('link_id', $id)->delete();
        Link::destroy($id);

        return redirect()->back();
    }
}
