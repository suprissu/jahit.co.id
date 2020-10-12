<?php

namespace App\Helper;

use App\Constant\RoleConstant;
use App\Constant\WarningStatusConstant;

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
                        return route('warning', ['type' => WarningStatusConstant::WAITING_VALIDATION]);
                    }
                }
                break;
            case RoleConstant::PARTNER:
                if ($user->partner == null) {
                    return route('register.partner.page');
                } else {
                    return route('warning', ['type' => WarningStatusConstant::WAITING_VALIDATION]);
                }
                break;
            default:
                return route('warning', ['type' => WarningStatusConstant::CAN_NOT_ACCESS]);
        }
    }
}