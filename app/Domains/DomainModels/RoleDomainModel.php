<?php /** @noinspection PhpUndefinedNamespaceInspection */

/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/22/2018
 * Time: 12:17 PM
 */

namespace App\Domains\DomainModels;


class RoleDomainModel
{
    protected $id;
    protected $name;


    /**
     * Properties GETTER
     * @author Yansen
     *
     */
    public function getId()		{ return $this->id; }
    public function getName()	{ return $this->name; }


    /**
     * Properties SETTER
     * @author Yansen
     *
     */
    public function setId($id)		{ $this->id = $id; return $this; }
    public function setName($name)	{ $this->name = $name; return $this; }


    /**
     * RoleDomainModel Constructor
     * @author Yansen
     */
    protected function __construct(){}


    /**
     * Add new role to the database
     * @author Yansen
     *
     * @return App\Repository\DataModels\Role
     */
    public function addRole()
    {

    }


    /**
     * Delete role with specified id from database
     * @author Yansen
     *
     * @param Integer $roleId
     * @return void
     */
    public static function removeRole($roleId)
    {

    }
}