<?php

namespace App\Helper;

use App\Constant\RoleConstant;

class RedirectionHelper
{
    public static function routeBasedOnRegistrationStage($targetPath)
    {
        $user = auth()->user();

        if ($user == null) {
            return route('login');
        }

        if ($user->is_active == true) {
            return $targetPath;
        }

        $role = $user->roles();
        if ($role->count() == 0) {
            return route('register.choice.page');
        }
        switch ($role->first()->name) {
            case RoleConstant::CUSTOMER:
                if ($user->customer == null) {
                    return route('register.customer.page');
                } else {
                    if ($user->customer->projects()->count() == 0) {
                        return route('register.customer.project.page');
                    } else {
                        // TO DO : change to error template
                        return abort(403, 'Unauthorized action.');
                    }
                }
                break;
            case RoleConstant::PARTNER:
                if ($user->partner == null) {
                    return route('register.partner.page');
                } else {
                    // TO DO : change to error template
                    return abort(403, 'Unauthorized action.');
                }
                break;
            default:
                // TO DO : change to error template
                return abort(403, 'Unauthorized action.');
        }
    }
}