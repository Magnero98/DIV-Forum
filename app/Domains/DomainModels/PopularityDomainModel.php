<?php /** @noinspection ALL */

/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/24/2018
 * Time: 1:13 PM
 */

namespace App\Domains\DomainModels;



use App\Repository\DataModels\Popularity;
use App\Repository\DataModels\User;
use App\Repository\Repositories\PopularityRepository;

class PopularityDomainModel
{
    protected $voterUserId;
    protected $targetUserId;
    protected $voteStatus;

    /**
     * Properties GETTER
     * @author Yansen
     *
     */
    public function getVoterUserId()    { return $this->voterUserId; }
    public function getTargetUserId()   { return $this->targetUserId; }
    public function getVoteStatus()     { return $this->voteStatus; }

    /**
     * Properties SETTER
     * @author Yansen
     *
     */
    public function setVoterUserId($voterUserId)    { $this->voterUserId = $voterUserId; return $this; }
    public function setTargetUserId($targetUserId)  { $this->targetUserId = $targetUserId; return $this; }
    public function setVoteStatus($voteStatus)      { $this->voteStatus = $voteStatus; return $this; }


    /**
     * PopularityDomainModel Constructor
     * @author Yansen
     */
    protected function __construct(){}


    /**
     * Add new popularity's vote to database
     * @author Yansen
     *
     * @return Repository\DataModels\Popularity
     */
    public function addPopularity()
    {
        $popularityRepository = new PopularityRepository();
        $popularityRepository->create($this);
    }


    /**
     * Save updated popularity's vote to the database
     * @author Yansen
     *
     * @return Repository\DataModels\Popularity
     */
    public function editPopularity()
    {
        $popularityRepository = new PopularityRepository();
        $popularityRepository->update($this);
    }


    /**
     * Check if this user has gave a vote to target user
     * @author Yansen
     *
     * @param Integer $voterUserId
     * @param Integer $targetUserId
     * @return Boolean
     */
    public static function isVoted($voterUserId, $targetUserId)
    {
        $popularityRepository = new PopularityRepository();
        return (is_null($popularityRepository->find($voterUserId, $targetUserId)))
            ? false
            : true;
    }

    /**
     * Factory Method to create PopularityDomainModel
     * @author Yansen
     *
     * @return PopularityDomainModel
     */
    public static function create()
    {
        return new PopularityDomainModel();
    }


    /**
     * Factory Method to create PopularityDomainModel with fields
     * @author Yansen
     *
     * @param Integer $voterUserId
     * @param Integer $targetUserId
     * @param Integer $status
     * @return PopularityDomainModel
     */
    public static function createWithStatus($voterUserId, $targetUserId, $status)
    {
        $popularity = new PopularityDomainModel();

        $popularity->setVoterUserId($voterUserId)
            ->setTargetUserId($targetUserId)
            ->setVoteStatus($status);

        return $popularity;
    }


    /**
     * Factory Method to create PopularityDomainModel from Pivot
     * @author Yansen
     *
     * @param Repository\DataModels\User $model
     * @return PopularityDomainModel
     */
    public static function createFromUserDataModel($model)
    {
        $popularity = new PopularityDomainModel();

        $popularity->setVoterUserId($model->voter_user_id)
            ->setTargetUserId($model->target_user_id)
            ->setVoteStatus($model->popularity_status_id);

        return $popularity;
    }
}