<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/27/2018
 * Time: 9:07 AM
 */

if(!function_exists('isAuthUserThread'))
{
    function isAuthUserThread($threadId)
    {
        return \App\Domains\DomainModels\ThreadDomainModel::isAuthUserThread($threadId);
    }
}