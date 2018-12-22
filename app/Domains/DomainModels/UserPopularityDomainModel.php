<?php
/**
 * Created by PhpStorm.
 * UserDomainModel: UserDomainModel
 * Date: 12/21/2018
 * Time: 12:11 PM
 */

namespace App\Domains\DomainModels;


class UserPopularityDomainModel
{
    protected $goodPopularity;
    protected $badPopularity;

    /**
     * Properties GETTER
     * @author Yansen
     *
     */
    public function getGoodPopularity()	{ return $this->goodPopularity; }
    public function getBadPopularity()	{ return $this->badPopularity; }


    /**
     * Properties SETTER
     * @author Yansen
     *
     */
    protected function setGoodPopularity($goodPopularity)
    {
        $this->goodPopularity = $goodPopularity;
        return $this;
    }
    protected function setBadPopularity($badPopularity)
    {
        $this->badPopularity = $badPopularity;
        return $this;
    }

    /**
     * Increase goodPopularity by one
     * @author Yansen
     *
     * @return Integer
     */
    public function addOnePointToGoodPopularity()
    {
        $this->goodPopularity++;
        // TODO save updated user's goodPopularity to Database
        return $this->goodPopularity;
    }

    /**
     * Increase badPopularity by one
     * @author Yansen
     *
     * @param Integer $userId
     * @return Integer
     */
    public function addOnePointToBadPopularity()
    {
        $this->badPopularity++;
        // TODO save updated user's badPopularity to Database
        return $this->badPopularity;
    }

    public static function createUserPopularity($goodPopularity = 0, $badPopularity = 0)
    {
        $popularity = new UserPopularityDomainModel();
        $popularity->setGoodPopularity($goodPopularity)
            ->setBadPopularity($badPopularity);
        return $popularity;
    }
}