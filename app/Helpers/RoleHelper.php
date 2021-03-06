<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/26/2018
 * Time: 5:25 PM
 */

if(!function_exists('adminRole'))
{
    function adminRole()
    {
        return \App\Domains\DomainModels\UserRoleEnumeration::Admin;
    }
}

if(!function_exists('memberRole'))
{
    function memberRole()
    {
        return \App\Domains\DomainModels\UserRoleEnumeration::Member;
    }
}

if(!function_exists('roleName'))
{
    function roleName($value)
    {
        return \App\Domains\DomainModels\UserRoleEnumeration::valueName[$value];
    }
}