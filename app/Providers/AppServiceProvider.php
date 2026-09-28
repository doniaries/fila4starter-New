<?php

namespace App\Providers;

use App\Models\Activity;
use App\Policies\ActivityPolicy;
use Filament\Actions\EditAction;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Gate;
use App\Listeners\LogSuccessfulLogin;
use Illuminate\Support\Facades\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        Gate::before(function ($user, $ability) {
            return $user->hasRole('super_admin') ? true : null;
        });

        Gate::policy(Activity::class, ActivityPolicy::class);

        // Mencegah lazy loading & N+1 Problem (Mode Strict)
        Model::shouldBeStrict(! app()->isProduction());

        EditAction::configureUsing(function (EditAction $action) {
            $action->iconButton();
        });

        Event::listen(Login::class, LogSuccessfulLogin::class);

        if (app()->isProduction()) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        \App\Models\Post::observe(\App\Observers\PostObserver::class);
        \App\Models\Infografis::observe(\App\Observers\InfografisObserver::class);
        \App\Models\Pengaturan::observe(\App\Observers\PengaturanObserver::class);
        \App\Models\AgendaKegiatan::observe(\App\Observers\AgendaKegiatanObserver::class);
        \App\Models\Pengumuman::observe(\App\Observers\PengumumanObserver::class);
        \App\Models\Gallery::observe(\App\Observers\GalleryObserver::class);
        \App\Models\ExternalLink::observe(\App\Observers\ExternalLinkObserver::class);
        \App\Models\PelakuEkraf::observe(\App\Observers\PelakuEkrafObserver::class);
    }
}
