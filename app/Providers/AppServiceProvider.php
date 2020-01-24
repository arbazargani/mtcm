<?php

namespace App\Providers;

use App\Category;
use App\Tag;
use App\User;
use Illuminate\Support\ServiceProvider;
use Hekmatinasser\Verta\Verta;

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
        //
        $categories = Category::all();
        $tags = Tag::all();
        $users = User::all();
        view()->share(['categories'=> $categories, 'tags' => $tags, 'users' => $users]);

        // \Blade::directive('jalali', function($timestamp) {
        //   $jalaliDate = new Verta("$timestamp");
        //   $jalaliDate = Verta::instance("$timestamp");
        //   $jalaliDate = Facades\Verta::instance("$timestamp");
        //   return "<?php echo $jalaliDate; ";
        //});
    }
}
