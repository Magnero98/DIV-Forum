<?php /** @noinspection PhpUndefinedNamespaceInspection */

/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/24/2018
 * Time: 2:47 PM
 */

namespace App\Repository\Repositories;

use App\Repository\DataModels\User;
use App\Domains\DomainModels\PopularityDomainModel;

class PopularityRepository implements Repository
{

    /**
     * Find voter user and target user in popularities table
     * @author Yansen
     *
     * @param Integer $voterUserId
     * @param Integer $targetUserId
     * @return Illuminate\Database\Eloquent\Relations\Pivot
     */
    public function find($voterUserId, $targetUserId)
    {
        $voter = User::find($voterUserId);
        $target = $this->getVoteTarget($voter, $targetUserId);

        if(!is_null($target))
        {
            return $target->pivot;
        }

        return null;
    }

    /**
     * Find user's vote target
     * @author Yansen
     *
     * @param User $voter
     * @param Integer $targetUserId
     * @return Repository\DataModels\User
     */
    public function getVoteTarget($voter, $targetUserId)
    {
        return $voter->popularities
                    ->where('id', '=', $targetUserId)
                    ->first();
    }


    /**
     * Insert new popularity to popularities table
     * @author Yansen
     *
     * @param PopularityDomainModel $model
     * @return void
     */
    public function create(PopularityDomainModel $model)
    {
        User::find($model->getVoterUserId())
            ->popularities()
            ->attach(
                $model->getTargetUserId(),
                ['popularity_status_id' => $model->getVoteStatus()]);
    }


    /**
     * Update popularities table with new user's vote
     * @author Yansen
     *
     * @param PopularityDomainModel $model
     * @return void
     */
    public function update(PopularityDomainModel $model)
    {
        User::find($model->getVoterUserId())
            ->popularities()
            ->updateExistingPivot(
                $model->getTargetUserId(),
                ['popularity_status_id' => $model->getVoteStatus()]);
    }

}