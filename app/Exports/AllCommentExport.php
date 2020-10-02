<?php

namespace App\Exports;

use App\Models\Comment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AllCommentExport implements FromView
{
    public function view(): View
    {
        $data['comments'] = Comment::with('links')->get();

        return view('excel.all', $data);
    }
}
