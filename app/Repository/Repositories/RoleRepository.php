<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/22/2018
 * Time: 2:53 PM
 */

namespace App\Repository\Repositories;


use App\Domains\DomainModels\DomainModel;

class RoleRepository implements Repository
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
        // TODO: Implement all() method.
    }

    /**
     * Retrieve data from Database with specified id
     * @author Yansen
     *
     * @return Repository/DataModels/UserDomainModel
     */
    public function find($id)
    {
        // TODO: Implement find() method.
    }

    /**
     * Insert new model to Database
     * @author Yansen
     *
     * @param DomainModel $model
     * @return Repository/DataModels/UserDomainModel
     */
    public function create(DomainModel $model)
    {
        // TODO: Implement create() method.
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