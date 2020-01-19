<?php

use App\SiteSettings;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SiteSettings::create(['facebook_link' => 'www.facebook.com','twitter_link'=>'www.twitter.com','instagram_link'=>'www.instagram.com','logo_header'=>'sitesettings_image/logo.jpg','email'=>'some@some.com','phonenumber'=>'033 033033033',]);
    }
}
