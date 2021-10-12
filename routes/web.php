<?php

use App\Exports\AllCommentExport;
use App\Exports\SingleCommentExport;
use App\Models\Comment;
use App\Models\Link;
use App\Services\HelperService;
use Goutte\Client;
use Maatwebsite\Excel\Facades\Excel;

$helpers = new HelperService();

Route::get('/', function () {
    return redirect()->route('links');
});

Route::get('links', function () {
    $data['links'] = Link::all();

    return view('links', $data);
})->name('links');

Route::get('links-edit', function () {
    $data['links'] = Link::all();

    return view('links_edit', $data);
})->name('links.edit');

Route::get('links-delete/{id}', function ($id) {
    Comment::where('link_id', $id)->delete();
    Link::destroy($id);

    return redirect()->back();
})->name('links.delete');

Route::post('links-save', function () {
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
})->name('links.save');

Route::get('table/{id}', function ($id) {
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
})->name('table');

Route::get('update/{link}/{lang}', function ($link, $lang) use($helpers) {
    $link = Link::where('id', $link)->firstOrFail();
    $client = new Client();
    switch ($lang) {
        case 'turkey':
            $url = $link->turkey;
            break;
        case 'australia':
            $url = $link->australia;
            break;
        case 'canada':
            $url = $link->canada;
            break;
        case 'england':
            $url = $link->england;
            break;
        case 'usa':
            $url = $link->usa;
            break;
        default:
            $url = $link->turkey;
    }
    $crawler = $client->request('GET', $url);
    $helpers->getComments($crawler, $lang, $link);
    for ($i = 2; $i <= 20; $i++) {
        $tempUrl = $url.'?pageNumber='.$i;
        $crawler = $client->request('GET', $tempUrl);
        $comments = $helpers->getComments($crawler, $lang, $link);
        if ($comments === true) {
            break;
        }
    }

    return 'OK';
})->name('update');

Route::get('excel/single/{id}/{lang}', function ($id, $lang) {
    $link = Link::findOrFail($id);

    return Excel::download(new SingleCommentExport($id, $lang), \Illuminate\Support\Str::slug($link->title).'-'.$lang.'.xlsx');
})->name('excel.single');

Route::get('excel/all', function () {
    return Excel::download(new AllCommentExport, 'all-comments.xlsx');
})->name('excel.all');
