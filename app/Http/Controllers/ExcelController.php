<?php

namespace App\Http\Controllers;

class ExcelController extends Controller
{
    public function single($id, $lang)
    {
        $link = Link::findOrFail($id);

        return Excel::download(new SingleCommentExport($id, $lang), \Illuminate\Support\Str::slug($link->title).'-'.$lang.'.xlsx');
    }

    public function all()
    {
        return Excel::download(new AllCommentExport, 'all-comments.xlsx');
    }
}
