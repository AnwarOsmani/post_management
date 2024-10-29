<?php

namespace App\Helpers;

use Auth;

class NavigationHelper
{
    public static function getNavigationView()
    {
        if (Auth::check()) {
            // Determine navigation based on role
            switch (Auth::user()->role) {
                case 1:
                    return 'layouts.superadmin.navigation';
                case 2:
                    return 'layouts.admin.navigation';
                case 3:
                    return 'layouts.worker.navigation';
                default:
                    return 'layouts.public.navigation';
            }
        } else {
            // Guest user navigation
            return 'layouts.welcome.navigation';
        }
    }
}
