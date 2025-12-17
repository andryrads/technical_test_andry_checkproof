<?php

namespace App\Providers;

use App\Mail\LaravelMailer;
use App\Repositories\OrderReadRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use App\Services\Auth\CurrentUser;
use App\Services\Contracts\CurrentUserProvider;
use App\Services\Contracts\Mailer;
use App\Services\Contracts\OrderReadRepository;
use App\Services\Contracts\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->singleton(OrderReadRepository::class, OrderReadRepositoryEloquent::class);

        $this->app->singleton(CurrentUserProvider::class, CurrentUser::class);

        $this->app->singleton(Mailer::class, function ($app) {
            $adminEmail = config('mail.admin_address')
                ?? env('ADMIN_EMAIL', config('mail.from.address'));

            return new LaravelMailer($adminEmail);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
