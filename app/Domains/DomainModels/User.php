<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/21/2018
 * Time: 11:50 AM
 */

namespace App\Domains\DomainModels;


class User extends DomainModel
{
    protected $roleId;
    protected $popularity;
    protected $name;
    protected $email;
    protected $phone;
    protected $gender;
    protected $address;
    protected $profilePicture;
    protected $birthday;

    /**
     * Properties GETTER
     * @author Yansen
     *
     */
    public function getRoleId()			{ return $this->roleId; }
    public function getPopularity()	    { return $this->popularity; }
    public function getName()			{ return $this->name; }
    public function getEmail()			{ return $this->email; }
    public function getPhone()			{ return $this->phone; }
    public function getGender()			{ return $this->gender; }
    public function getAddress()		{ return $this->address; }
    public function getProfilePicture()	{ return $this->profilePicture; }
    public function getBirthday()		{ return $this->birthday; }
}