<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/24/2018
 * Time: 1:20 PM
 */

namespace App\Domains\DomainModels;


abstract class UserRoleEnumeration
{
    const Admin = 1;
    const User = 2;

    /**
     * To get name of enumeration constant
     * @author Yansen
     *
     * @var String array
     */
    const valueName = array(
        "",
        "Admin",
        "User"
    );
}