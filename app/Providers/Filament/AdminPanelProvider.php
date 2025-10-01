<?php

namespace App\Providers\Filament;

use App\Filament\Resources\OrderResource\Widgets\OrderStats;
use App\Filament\Resources\YResource\Widgets\OrderPieChart;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Filament\Resources\YResource\Widgets\OrdersChart;
use App\Filament\Widgets\LatestOrders;

// Tambahkan use ExportOrdersWidget di sini:
use App\Filament\Widgets\ExportOrdersWidget;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->brandName('Admin Panel')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources\\YResource')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            // ->pages([
            //     Pages\Dashboard::class,
            // ])
            ->pages([
                \App\Filament\Pages\Dashboard::class,
            ])

        
            ->widgets([

                OrderStats::class,
                OrderPieChart::class,
                OrdersChart::class,
                LatestOrders::class,
                // ExportOrdersWidget::class,  
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
