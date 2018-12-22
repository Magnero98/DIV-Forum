<?php
/**
 * Created by PhpStorm.
 * UserDomainModel: UserDomainModel
 * Date: 12/21/2018
 * Time: 9:07 AM
 */

namespace App\Repository\Repositories;

use App\User;
use App\Domains\DomainModels\DomainModel;

class UserRepository implements Repository
{

    /**
     * Retrieve all data from Database with pagination default perpage = 10
     * @author Yansen
     *
     * @param Integer $perPage = 10
     * @return Collection of Repository/DataModels/UserDomainModel
     */
    public function all($perPage = 10)
    {
        return User::where('id', '!=', 0)
            ->paginate($perPage);
    }

    /**
     * Retrieve data from Database with specified id
     * @author Yansen
     *
     * @return Repository/DataModels/UserDomainModel
     */
    public function find($id)
    {
        return User::find($id);
    }

    /**
     * Insert new model to Database
     * @author Yansen
     *
     * @param DomainModel $model
     * @return User
     */
    public function create(DomainModel $model)
    {
        return User::create([
            'name' => $model->getName(),
            'email' => $model->getEmail(),
            'password' => $model->getPassword(),
            'phone' => $model->getPhone(),
            'gender' => $model->getGender(),
            'address' => $model->getAddress(),
            'profile_picture' => $model
                ->getProfilePicture()
                ->getImageFile()
                ->getFilename(),
            'birthday' => $model->getBirthday(),
            'good_popularity' => $model->getPopularity()->getGoodPopularity(),
            'bad_popularity' => $model->getPopularity()->getBadPopularity(),
        ]);
    }

    /**
     * Update data with specified id inside Database with updated model
     * @author Yansen
     *
     * @param DomainModel $model
     * @param Integer $id
     * @return Boolean
     */
    public function update(DomainModel $model, $id)
    {
        // TODO: Implement update() method.
    }

    /**
     * Delete data with specified id inside Database
     * @author Yansen
     *
     * @param Integer $id
     * @return Boolean
     */
    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

}