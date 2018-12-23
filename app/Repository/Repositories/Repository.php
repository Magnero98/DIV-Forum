<?php /** @noinspection PhpUndefinedNamespaceInspection */

/**
 * Created by PhpStorm.
 * UserDomainModel: UserDomainModel
 * Date: 12/21/2018
 * Time: 10:02 AM
 */

namespace App\Repository\Repositories;

use App\Domains\DomainModels\DomainModel;

interface Repository
{
    /**
     * Retrieve all data from Database with pagination default perpage = 10
     * @author Yansen
     *
     * @param Integer $perPage = 10
     * @return Collection of Illuminate\Database\Eloquent\Model
     */
    public function all($perPage = 10);

    /**
     * Retrieve data from Database with specified id
     * @author Yansen
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id);

    /**
     * Insert new model to Database
     * @author Yansen
     *
     * @param array $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $data);

    /**
     * Update data with specified id inside Database with updated model
     * @author Yansen
     *
     * @param array $data
     * @return Boolean
     */
    public function update(array $data);

    /**
     * Delete data with specified id inside Database
     * @author Yansen
     *
     * @param Integer $id
     * @return Boolean
     */
    public static function delete($id);

}