<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;
use Auth;

class AppServiceProvider extends ServiceProvider
{

    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        \Schema::defaultStringLength(191);

        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('MAIN NAVIGATION');
            $event->menu->add([
                'text' => 'HOME',
                'url' => 'home',
                'icon' => 'home'
            ]);

           
    if(Auth::user()->is_admin() )
    {
        #ADMIN ACCOUNT
            $event->menu->add('MY ACCOUNTS');
           
            $event->menu->add([
                'text' => 'MY SAVINGS',
                'icon'    => 'money',
                'url'  => 'Your ',
            ]);

            $event->menu->add([
                'text' => 'MY LOANS',
                'icon' => 'list-ol',
                'submenu' => [
                    [
                        'text' => 'APPLY FOR LOAN',
                        'url' => 'loans/create',
                        'icon' => 'plus'
                    ],
                    [
                        'text' => 'VIEW MY LOANS',
                        'icon'    => 'chevron-right',
                        'url'  => 'Your ',
                    ],
                ]
            ]);

            
            $event->menu->add('ADMIN PANEL');
            $event->menu->add([
                    'text' => 'LOANS',
                    'icon' => 'credit-card',
                    'submenu' => [
                        [
                            'text' => 'APPLICATIONS',
                            'icon'    => 'chevron-right',
                            'url'  => 'loans/applications',
                        ],
                        [
                            'text' => 'ACTIVE LOANS',
                            'icon'    => 'chevron-right',
                            'url'  => 'loans/active',
                        ],
                        [
                            'text' => 'VIEW ALL',
                            'icon'    => 'chevron-right',
                            'url'  => 'Your ',
                        ],
                        
                    ]
                ]);

            $event->menu->add([
                    'text' => 'SAVINGS',
                    'icon' => 'university',
                    'submenu' => [
                       [
                            'text' => 'VIEW ALL SAVINGS',
                            'icon'    => 'chevron-right',
                            'url'  => 'group/savings',
                        ],
                        
                    ]
                ]);

                $event->menu->add([
                    'text' => 'SETTINGS',
                    'icon' => 'cog fa-spin',
                    'submenu' => [
                        [
                            'text' => 'SAVINGS DATE',
                            'icon'    => 'chevron-right',
                            'url'  => 'display/savings_date',
                        ],
                        [
                            'text' => 'INTEREST RATE',
                            'icon'    => 'chevron-right',
                            'url'  => 'display/savings_date',
                        ],
                        [
                            'text' => 'VIEW ALL LOANS',
                            'icon'    => 'chevron-right',
                            'url'  => 'Your ',
                        ],
                        
                    ]
                ]);

          
           
    }else {
            #USER ACCOUNT
           
            $event->menu->add('ACCOUNTS');

            $event->menu->add([
                'text' => 'SAVINGS',
                'icon' => 'money',
                'submenu' => [
                    [
                        'text' => 'GROUP SAVINGS',
                        'icon'    => 'chevron-right',
                        'url'  => 'group/savings',
                    ],
                    [
                        'text' => 'MY SAVINGS',
                        'icon'    => 'chevron-right',
                        'url'  => 'Your ',
                    ],
                ]
            ]);

            $event->menu->add([
                'text' => 'LOANS',
                'icon' => 'list-ol',
                'submenu' => [
                    [
                        'text' => 'APPLY FOR LOAN',
                        'url' => 'loans/create',
                        'icon' => 'plus'
                    ],
                    [
                        'text' => 'VIEW ACTIVE LOANS',
                        'icon'    => 'chevron-right',
                        'url'  => 'loans/active',
                    ],
                    [
                        'text' => 'MY LOANS',
                        'icon'    => 'chevron-right',
                        'url'  => 'Your ',
                    ],
                ]
            ]);

            $event->menu->add('ACCOUNTS');
            $event->menu->add([
                'text' => 'CHANGE PASSWORD',
                'url' => 'admin/settings',
                'icon' => 'lock'
            ]);

        }; //Endif


        $event->menu->add('ACTIVITY LOGS');
        $event->menu->add([
            'text' => 'LOGS',
            'icon' => 'file-text',
            'submenu' => [
                [
                    'text' => 'SAVINGS LOGS',
                    'icon'    => 'chevron-right',
                    'url'  => 'logs/savings',
                ],
                [
                    'text' => 'LOAN LOGS',
                    'icon'    => 'chevron-right',
                    'url'  => 'logs/loan',
                ],
                
            ]
        ]);

    });//BuildingMenu Events
            
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
