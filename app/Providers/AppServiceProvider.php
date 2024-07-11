<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::directive('currency', function ($expression) {
            return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
        });

        Blade::directive('hour', function ($expression) {
            return "<?php echo \Carbon\Carbon::parse($expression)->format('H:i'); ?>";
        });

        Blade::directive('date', function ($expression) {
            return "<?php echo \Carbon\Carbon::parse($expression)->format('d-m-Y H:i'); ?>";
        });

        Blade::directive('justDate', function ($expression) {
            return "<?php echo \Carbon\Carbon::parse($expression)->format('d-m-Y'); ?>";
        });

        Paginator::defaultView('view-name');

        Paginator::defaultSimpleView('view-name');
    }
}
