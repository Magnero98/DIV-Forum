<?php /** @noinspection PhpUndefinedNamespaceInspection */

/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/22/2018
 * Time: 9:44 AM
 */

namespace App\Repository\Repositories;


class PopularityRepository implements Repository
{

    /**
     * Retrieve all data from Database with pagination default perpage = 10
     * @author Yansen
     *
     * @param Integer $perPage = 10
     * @return Collection of Illuminate\Database\Eloquent\Model
     */
    public function all($perPage = 10)
    {
        // TODO: Implement all() method.
    }

    /**
     * Retrieve data from Database with specified id
     * @author Yansen
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        // TODO: Implement find() method.
    }

    /**
     * Insert new model to Database
     * @author Yansen
     *
     * @param array $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        // TODO: Implement create() method.
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