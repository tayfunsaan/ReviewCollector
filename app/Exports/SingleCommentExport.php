<?php

namespace App\Exports;

use App\Models\Comment;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SingleCommentExport implements FromView
{
    protected $id;

    protected $lang;

    public function __construct(int $id, string $lang)
    {
        $this->id = $id;
        $this->lang = $lang;
    }

    public function view(): View
    {
        $data['comments'] = Comment::where('link_id', $this->id);
        switch ($this->lang) {
            case 'turkey':
                $data['comments'] = $data['comments']->where('lang', 'turkey');
                break;
            case 'australia':
                $data['comments'] = $data['comments']->where('lang', 'australia');
                break;
            case 'canada':
                $data['comments'] = $data['comments']->where('lang', 'canada');
                break;
            case 'england':
                $data['comments'] = $data['comments']->where('lang', 'england');
                break;
            case 'usa':
                $data['comments'] = $data['comments']->where('lang', 'usa');
                break;
        }
        $data['comments'] = $data['comments']->get();

        return view('excel.single', $data);
    }
}
