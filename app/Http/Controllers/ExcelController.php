<?php

namespace App\Http\Controllers;

use App\Exports\AllCommentExport;
use App\Exports\SingleCommentExport;
use App\Models\Link;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExcelController extends Controller
{
    public function single($id, $lang): BinaryFileResponse
    {
        $link = Link::findOrFail($id);

        return Excel::download(new SingleCommentExport($id, $lang), Str::slug($link->title).'-'.$lang.'.xlsx');
    }

    public function all(): BinaryFileResponse
    {
        return Excel::download(new AllCommentExport, 'all-comments.xlsx');
    }
}
