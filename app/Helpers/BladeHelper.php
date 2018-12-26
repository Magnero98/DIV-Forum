<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/26/2018
 * Time: 5:22 PM
 */

if(!function_exists('roles'))
{
    function roles($userRoles)
    {
        if(authUserDomain() == null)
            return false;

        $authUserRole = roleName(authUserDomain()->getRoleId());
        return (is_array($userRoles)
            ? in_array($authUserRole, $userRoles)
            : $authUserRole == $userRoles);
    }
}