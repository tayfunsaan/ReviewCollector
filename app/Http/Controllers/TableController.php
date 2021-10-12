<?php

namespace App\Http\Controllers;

use App\Models\Comment;

class TableController extends Controller
{
    public function index($id)
    {
        $data['request'] = request()->only([
            'star', 'lang',
        ]);
        $data['id'] = $id;
        $data['comments'] = Comment::where('link_id', $id);
        if (isset($data['request']['lang'])) {
            switch ($data['request']['lang']) {
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
        }
        if (isset($data['request']['star'])) {
            switch ($data['request']['star']) {
                case 1:
                    $data['comments'] = $data['comments']->where('star', '1');
                    break;
                case 2:
                    $data['comments'] = $data['comments']->where('star', '2');
                    break;
                case 3:
                    $data['comments'] = $data['comments']->where('star', '3');
                    break;
                case 4:
                    $data['comments'] = $data['comments']->where('star', '4');
                    break;
                case 5:
                    $data['comments'] = $data['comments']->where('star', '5');
                    break;
            }
        }
        $data['comments'] = $data['comments']->get();

        return view('table', $data);
    }
}
