<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Blade;

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
        $length = env('EXCERPT_LENGTH', 300);
        Blade::directive('excerpt', function ($text, $length = 300) {
            return "<?php echo Str::limit($text, $length); ?>";
        });

        $lengthlong = env('EXCERPT_LENGTH_LONG', 900);
        Blade::directive('excerpt_long', function ($text, $lengthlong = 900) {
            return "<?php echo Str::limit($text, $lengthlong); ?>";
        });

        $titlelength = env('EXCERPT_LENGTH', 100);
        Blade::directive('title', function ($text, $titlelength = 100) {
            return "<?php echo Str::limit($text, $titlelength); ?>";
        });

        Blade::directive('pr', function ($text) {
            return "<?php echo '<pre>'; print_r($text); echo '</pre>'; die; ?>";
        });
    }
}
