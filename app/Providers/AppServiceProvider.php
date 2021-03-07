<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Banner;
use App\Models\Header;
use App\Models\Company;
use App\Models\AdsHeader;
use App\Models\FooterFirst;
use App\Models\FooterThird;
use App\Models\FooterFourth;
use App\Models\FooterSecond;
use App\Models\LoginPage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $header = Header::limit(1)->first();
        $menu = Menu::limit(1)->first();
        $banners = Banner::where('status', 1)->orderBy('id', 'asc')->get();
        $companys = Company::where('status', 1)->orderBy('id', 'asc')->get();
        $footer_1st = FooterFirst::orderBy('id', 'desc')->limit(1)->first();
        $footer_2nd = FooterSecond::orderBy('id', 'desc')->limit(1)->first();
        $footer_3rd = FooterThird::orderBy('id', 'desc')->limit(1)->first();
        $footer_4th = FooterFourth::orderBy('id', 'desc')->limit(1)->first();
        $ads_header = AdsHeader::orderBy('id', 'desc')->limit(1)->first();
        $login = LoginPage::orderBy('id', 'desc')->limit(1)->first();
        Schema::defaultStringLength(191);

        View::share([
            'header'  => $header,
            'menu' => $menu,
            'banners' => $banners,
            'companys' => $companys,
            'footer_1st' => $footer_1st,
            'footer_2nd' => $footer_2nd,
            'footer_3rd' => $footer_3rd,
            'footer_4th' => $footer_4th,
            'ads_header' => $ads_header,
            'login' => $login,
        ]);
    }
}
