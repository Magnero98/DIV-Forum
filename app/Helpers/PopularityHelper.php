<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/27/2018
 * Time: 10:03 AM
 */

if(!function_exists('getUserPopularityVote'))
{
    function getUserPopularityVote($userId)
    {
        $popularity = \App\Domains\DomainModels\PopularityDomainModel::findPopularity(
            authUserDomain()->getId(),
            $userId
        );

        if($popularity == null)
            return "No Vote";

        return \App\Domains\DomainModels\PopularityStatusEnumeration::valueName[$popularity->popularity_status_id];
    }
}