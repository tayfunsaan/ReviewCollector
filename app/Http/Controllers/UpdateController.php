<?php

namespace App\Http\Controllers;

class UpdateController extends Controller
{
    public function index($link, $lang)
    {
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
    }
}
