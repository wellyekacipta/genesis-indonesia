<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\Blade;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(\App\Filament\Pages\Auth\Login::class)
            ->colors([
                'primary' => '#1e40af', // genesis-blue
            ])
            ->brandName('Genesis Indo')
            ->font('Poppins')
            ->renderHook(
                PanelsRenderHook::STYLES_AFTER,
                fn (): string => Blade::render('
                @if(request()->routeIs(\'filament.admin.auth.*\'))
                <style>
                    .fi-simple-layout {
                        background: linear-gradient(135deg, #1e40af 0%, #ec4899 100%) !important;
                        min-height: 100vh;
                    }
                    .fi-simple-main-ctn {
                        background: transparent !important;
                    }
                    .fi-simple-main {
                        background: rgba(255, 255, 255, 0.95) !important;
                        backdrop-filter: blur(10px);
                        border-radius: 1.5rem !important;
                        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important;
                        border: 1px solid rgba(255, 255, 255, 0.2) !important;
                        padding: 3rem !important;
                    }
                    .dark .fi-simple-main {
                        background: rgba(17, 24, 39, 0.95) !important;
                        border: 1px solid rgba(255, 255, 255, 0.1) !important;
                    }
                    .fi-logo {
                        font-size: 1.5rem !important;
                        font-weight: 700 !important;
                    }
                </style>
                @endif
                ')
            )
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                PreventRequestForgery::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
