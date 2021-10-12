<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Services\HelperService;
use Goutte\Client;

class UpdateController extends Controller
{

    protected $helpers;

    public function __construct(HelperService $helpers)
    {
        $this->helpers = $helpers;
    }

    public function index($link, $lang): string
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
        $this->helpers->getComments($crawler, $lang, $link);
        for ($i = 2; $i <= 20; $i++) {
            $tempUrl = $url.'?pageNumber='.$i;
            $crawler = $client->request('GET', $tempUrl);
            $comments = $this->helpers->getComments($crawler, $lang, $link);
            if ($comments === true) {
                break;
            }
        }

        return 'OK';
    }
}
