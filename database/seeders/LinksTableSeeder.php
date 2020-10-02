<?php

namespace Database\Seeders;

use App\Link;
use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = new Link();
        $item->title = 'Apple Airpods with Charging Case';
        $item->turkey = 'https://www.amazon.com.tr/Apple-AirPods-Bluetooth-Kulakl%C4%B1k-Garantili/product-reviews/B07QB4FG6B/reviewerType=all_reviews';
        $item->australia = 'https://www.amazon.com.au/Apple-AirPods-Charging-Latest-Model/product-reviews/B07PXGQC1Q/reviewerType=all_reviews';
        $item->canada = 'https://www.amazon.ca/Apple-MMEF2AM-AirPods-Wireless-Bluetooth/product-reviews/B01MQWUXZS/reviewerType=all_reviews';
        $item->england = 'https://www.amazon.co.uk/Apple-Airpods-Charging-latest-Model/product-reviews/B07PZR3PVB/reviewerType=all_reviews';
        $item->usa = 'https://www.amazon.com/Apple-AirPods-Charging-Latest-Model/product-reviews/B07PXGQC1Q/reviewerType=all_reviews';
        $item->save();
    }
}
