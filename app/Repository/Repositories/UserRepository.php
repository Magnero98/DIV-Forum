<?php /** @noinspection PhpUndefinedNamespaceInspection */

/**
 * Created by PhpStorm.
 * UserDomainModel: UserDomainModel
 * Date: 12/21/2018
 * Time: 9:07 AM
 */

namespace App\Repository\Repositories;

use App\Domains\DomainModels\UserDomainModel;
use App\Repository\DataModels\Popularity;
use DateTime;
use App\Repository\DataModels\User;
use App\Domains\DomainModels\UserRoleEnumeration;

class UserRepository implements Repository
{

    /**
     * Retrieve all data from Database with pagination default per page = 10
     * @author Yansen
     *
     * @param Integer $perPage = 10
     * @return Collection of Repository\DataModels\User
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
     * @param Integer $id
     * @return Repository\DataModels\User
     */
    public function find($id)
    {
        return User::find($id);
    }

    /**
     * Insert new model to Database
     * @author Yansen
     *
     * @param array $data
     * @return Repository\DataModels\User
     */
    public function create(array $data)
    {
        return User::create([
            'role_id' => userRole(),
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'profile_picture' => $data['picture'],
            'birthday' => $data['birthday'],
            'good_popularity' => 0,
            'bad_popularity' => 0,
            'created_at' => date_format(new DateTime(), 'Y-m-d H:i:s'),
            'updated_at' => date_format(new DateTime(), 'Y-m-d H:i:s')
        ]);
    }

    /**
     * Update data with specified id inside Database with updated model
     * @author Yansen
     *
     * @param array $data
     * @param Integer $id
     * @return Boolean
     */
    public function update(array $data, $id)
    {
        return User::where('id', $id)
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'phone' => $data['phone'],
                'gender' => $data['gender'],
                'address' => $data['address'],
                'profile_picture' => $data['picture'],
                'birthday' => $data['birthday'],
                'updated_at' => date_format(new DateTime(), 'Y-m-d H:i:s')
            ]);
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
        return User::destroy($id);
    }


    /**
     * Update user good and bad popularity
     * @author Yansen
     *
     * @param Integer $userId
     * @param UserDomainModel $model
     * @return Repository\DataModels\User
     */
    public function updateUserPopularity(UserDomainModel $model)
    {
        return User::where('id', '=', $model->getId())
            ->update([
               'good_popularity' => $model->getGoodPopularity(),
               'bad_popularity' => $model->getBadPopularity()
            ]);
    }
}