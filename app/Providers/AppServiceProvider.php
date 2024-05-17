<?php

namespace App\Providers;

use App\Models\barang;
use Illuminate\Support\Facades\DB;
use DateTimeZone;
use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('path.public', function () {
            return base_path('public_html');
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Config::set('app.timezone', 'Asia/Makassar');
        date_default_timezone_set('Asia/Makassar');
        $countTotal = Barang::count();
        $dataTotal = Barang::where('stok', '>', 0)->count();
        $habisTotal = Barang::where('stok', '<=', 0)->count();
        $set = $countTotal + 1;
        Barang::where('stok', '<', 0)->update(['stok' => 0]);
        Barang::where('stok', '<=', 0)->update(['status' => 'Habis']);
        DB::statement("ALTER TABLE barang AUTO_INCREMENT = $set");

        View::share([
            'countTotal' => $countTotal,
            'dataTotal' => $dataTotal,
            'habisTotal' => $habisTotal
        ]);
    }
}
