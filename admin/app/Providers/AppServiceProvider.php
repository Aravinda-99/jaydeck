<?php

namespace App\Providers;
use App\SystemSetting;
use App\HomeSlider;
use Illuminate\Support\ServiceProvider;
use Auth;
use Validator;
use Hash;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('old_password', function ($attribute, $value, $parameters, $validator) {
            $password = auth()->user()->password;
            return Hash::check($value, $password);
            }
        );

        Validator::extend( 'admin_password', function ($attribute, $value, $parameters, $validator) {
            if (!in_array('Admin', auth()->user()->roles->pluck('title')->toArray())) {
                return false;
            }
            $password = auth()->user()->password;
            return Hash::check($value, $password);
            }
        );

        Validator::extend('home_slider_count', function($attribute, $value, $parameters, $validator){
          $sliderCount = SystemSetting::getHomeSliderCount();
          $currentCount = HomeSlider::where('priority', '>', 0)->count();

          return  $currentCount < $sliderCount ;

        });
        Validator::extend('home_slider_priority_count', function($attribute, $value, $parameters, $validator){
          $currentCount = HomeSlider::where('priority', '>', 0)->where('priority', $value)->count();

          return  $currentCount == 0 ;

        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
