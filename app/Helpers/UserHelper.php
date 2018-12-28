<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/24/2018
 * Time: 8:52 PM
 */

if(!function_exists('authUserDomain()'))
{
    function authUserDomain()
    {
        return \App\Domains\DomainModels\UserDomainModel::getAuthUser();
    }
}

if(!function_exists('isAuthUserProfile'))
{
    function isAuthUserProfile($userId)
    {
        if (authUserDomain() == null) return false;
        return (authUserDomain()->getId() == $userId);
    }
}