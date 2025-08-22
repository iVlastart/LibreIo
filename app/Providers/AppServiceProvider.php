<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

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
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        VerifyEmail::toMailUsing(function ($notifiable, $url) {
            Log::info('Verification URL generated: '.$url);

            return (new \Illuminate\Notifications\Messages\MailMessage)
                ->subject('Verify Email Address')
                ->line('Please click the button below to verify your email address.')
                ->action('Verify Email Address', $url);
            }
        );
    }
}
