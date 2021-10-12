<?php

namespace App\Services;

class HelperService
{
    function processStar($star, $lang)
    {
        if ($lang == 'turkey') {
            $star = str_replace('5 yıldız üzerinden ', '', $star);
        } else {
            $star = str_replace(' out of 5 stars', '', $star);
        }
        $star = str_replace(',0', '', $star);
        $star = str_replace('.0', '', $star);

        return $star;
    }

    function processVerified($verified)
    {
        $verified = str_replace('Doğrulanmış Alışveriş', 'Doğrulanmış', $verified);
        $verified = str_replace('Verified Purchase', 'Doğrulanmış', $verified);

        return $verified;
    }

    function changeDateLang($date)
    {
        $trToEn = [
            'Monday'    => 'Pazartesi',
            'Tuesday'   => 'Salı',
            'Wednesday' => 'Çarşamba',
            'Thursday'  => 'Perşembe',
            'Friday'    => 'Cuma',
            'Saturday'  => 'Cumartesi',
            'Sunday'    => 'Pazar',
            'January'   => 'Ocak',
            'February'  => 'Şubat',
            'March'     => 'Mart',
            'April'     => 'Nisan',
            'May'       => 'Mayıs',
            'June'      => 'Haziran',
            'July'      => 'Temmuz',
            'August'    => 'Ağustos',
            'September' => 'Eylül',
            'October'   => 'Ekim',
            'November'  => 'Kasım',
            'December'  => 'Aralık',
            'Mon'       => 'Pts',
            'Tue'       => 'Sal',
            'Wed'       => 'Çar',
            'Thu'       => 'Per',
            'Fri'       => 'Cum',
            'Sat'       => 'Cts',
            'Sun'       => 'Paz',
            'Jan'       => 'Oca',
            'Feb'       => 'Şub',
            'Mar'       => 'Mar',
            'Apr'       => 'Nis',
            'Jun'       => 'Haz',
            'Jul'       => 'Tem',
            'Aug'       => 'Ağu',
            'Sep'       => 'Eyl',
            'Oct'       => 'Eki',
            'Nov'       => 'Kas',
            'Dec'       => 'Ara',
        ];
        foreach ($trToEn as $en => $tr) {
            $date = str_replace($tr, $en, $date);
        }
        //if(strpos($z, 'Mayıs') !== false && strpos($format, 'F') === false) $z = str_replace('Mayıs', 'May', $z);
        return $date;
    }

    function processDate($date, $lang)
    {
        switch ($lang) {
            case 'turkey':
                $date = \DateTime::createFromFormat('d M Y', changeDateLang($date));
                break;
            case 'australia':
                $date = trim(str_replace('Reviewed in Australia on ', '', $date));
                $date = \DateTime::createFromFormat('d M Y', changeDateLang($date));
                break;
            case 'england':
                $date = trim(str_replace('Reviewed in the United Kingdom on ', '', $date));
                $date = \DateTime::createFromFormat('d M Y', changeDateLang($date));
                break;
            default:
                $date = \DateTime::createFromFormat('M d, Y', $date);
                break;
        }

        return $date->format('d-m-Y');
    }

    function clearText($text)
    {
        $text = trim(preg_replace('/\s\s+/', ' ', $text));

        return strip_tags($text);
    }

    function getComments($crawler, $lang, $link)
    {
        $emptyNode = false;
        $crawler->filterXPath('//div[contains(@id, "cm_cr-review_list")]')->children()->each(function ($node) use ($lang, &$emptyNode, $link) {
            if ($node->count()) {
                $wrongHtml = false;
                $id = $node->attr('id');
                if (! empty($title = $node->filterXPath('//a[contains(@data-hook, "review-title")]')) && $title->count() > 0) {
                    $title = clearText($title->html());
                } else {
                    $wrongHtml = true;
                }
                if (! empty($body = $node->filterXPath('//span[contains(@data-hook, "review-body")]')) && $body->count() > 0) {
                    $body = clearText($body->html());
                } else {
                    $wrongHtml = true;
                }
                if (! empty($star = $node->filterXPath('//i[contains(@data-hook, "review-star-rating")]')) && $star->count() > 0) {
                    $star = clearText($star->html());
                } else {
                    $wrongHtml = true;
                }
                if (! empty($name = $node->filterXPath('//span[contains(@class, "a-profile-name")]')) && $name->count() > 0) {
                    $name = clearText($name->html());
                } else {
                    $wrongHtml = true;
                }
                if (! empty($date = $node->filterXPath('//span[contains(@data-hook, "review-date")]')) && $date->count() > 0) {
                    $date = clearText($date->html());
                } else {
                    $wrongHtml = true;
                }
                if (! empty($verified = $node->filterXPath('//span[contains(@data-hook, "avp-badge")]')) && $verified->count() > 0) {
                    $verified = clearText($verified->html());
                } else {
                    $wrongHtml = true;
                }
                if ($wrongHtml != true) {
                    $item = Comment::firstOrNew([
                        'amazon_id' => $id,
                        'lang' => $lang,
                        'title' => $title,
                        'body' => $body,
                        'star' => processStar($star, $lang),
                        'name' => $name,
                        'date' => processDate($date, $lang),
                        'verified' => processVerified($verified),
                        'link_id' => $link->id,
                    ]);
                    $item->save();
                }
            } else {
                $emptyNode = true;
            }
        });

        return $emptyNode;
    }
}
