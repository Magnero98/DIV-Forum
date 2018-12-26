<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/24/2018
 * Time: 1:19 PM
 */

namespace App\Domains\DomainModels;


abstract class PopularityStatusEnumeration
{
    const Good = 1;
    const Bad = 2;

    /**
     * To get name of enumeration constant
     * @author Yansen
     *
     * @var String array
     */
    const valueName = array(
        "",
        "Good",
        "Bad"
    );
}