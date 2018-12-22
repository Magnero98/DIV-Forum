<?php /** @noinspection ALL */

/**
 * Created by PhpStorm.
 * UserDomainModel: UserDomainModel
 * Date: 12/21/2018
 * Time: 11:50 AM
 */

namespace App\Domains\DomainModels;

use App\Repository\DataModels\User;
use App\Repository\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Model;

class UserDomainModel extends DomainModel
{
    protected $id;
    protected $roleId;
    protected $name;
    protected $email;
    protected $password;
    protected $phone;
    protected $gender;
    protected $address;
    protected $birthday;

    /**
     * UserDomainModel popularity
     * @author Yansen
     *
     * @var UserPopularityDomainModel
     */
    protected $popularity;

    /**
     * UserDomainModel profile picture
     * @author Yansen
     *
     * @var ProfilePictureDomainModel
     */
    protected $profilePicture;

    /**
     * UserRepository Object
     * @author Yansen
     *
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * Properties GETTER
     * @author Yansen
     *
     */
    public function getId() 			{ return $this->id; }
    public function getRoleId()			{ return $this->roleId; }
    public function getPopularity()	    { return $this->popularity; }
    public function getName()			{ return $this->name; }
    public function getEmail()			{ return $this->email; }
    public function getPassword()		{ return $this->password; }
    public function getPhone()			{ return $this->phone; }
    public function getGender()			{ return $this->gender; }
    public function getAddress()		{ return $this->address; }
    public function getProfilePicture()	{ return $this->profilePicture; }
    public function getBirthday()		{ return $this->birthday; }

    /**
     * Properties SETTER
     * @author Yansen
     *
     */
    protected function setId($id)                           { $this->id = $id; return $this; }
    protected function setRoleId($roleId)                   { $this->roleId = $roleId; return $this; }
    protected function setPopularity($popularity)           { $this->popularity = $popularity; return $this; }
    protected function setName($name)                       { $this->name = $name; return $this; }
    protected function setEmail($email)                     { $this->email = $email; return $this; }
    protected function setPhone($phone)                     { $this->phone = $phone; return $this; }
    protected function setPassword($password)               { $this->password = $password; return $this; }
    protected function setGender($gender)                   { $this->gender = $gender; return $this; }
    protected function setAddress($address)                 { $this->address = $address; return $this; }
    protected function setProfilePicture($profilePicture)   { $this->profilePicture = $profilePicture; return $this; }
    protected function setBirthday($birthday)               { $this->birthday = $birthday; return $this; }


    /**
     * UserDomainModel Constructor
     * @author Yansen
     */
    protected function __construct()
    {
        $this->userRepository = new UserRepository();
    }


    /**
     * Give another user a good vote by increase another user's
     * good popularity and insert new UserPopularityDomainModel record to the Database
     * @author Yansen
     *
     * @param Integer $userId
     * @return void
     */
    public function voteGoodForUser($userId)
    {

    }


    /**
     * Give another user a bad vote by increase another user's
     * bad popularity and insert new UserPopularityDomainModel record to the Database
     * @author Yansen
     *
     * @param Integer $userId
     * @return void
     */
    public function voteBadForUser($userId)
    {

    }


    /**
     * Add new user to the database and save user profile picture
     * @author Yansen
     *
     * @param Integer $userId
     */
    protected function saveUserToSession()
    {
        session(['User' => $this]);
    }


    /**
     * Add new user to the database and save user to session
     * @author Yansen
     *
     * @param Integer $userId
     * @return App\Repository\DataModels\User
     */
    public function addUser()
    {
        $userDataModel = $this->userRepository->create($this);

        $this->setId($userDataModel->id);
        $this->saveUserToSession();

        return $userDataModel;
    }


    /**
     * Save updated user to the database
     * @author Yansen
     *
     * @param Integer $userId
     * @return App\Repository\DataModels\User
     */
    public function editUser()
    {

    }


    /**
     * Delete user with specified Id from database
     * @author Yansen
     *
     * @param Integer $userId
     * @return void
     */
    public static function deleteUser()
    {

    }


    /**
     * Factory Method to create UserDomainModel from array of Data
     * @author Yansen
     *
     * @param array $data
     * @return UserDomainModel
     */
    public static function createUserFromArray(array $data)
    {
        $user = new UserDomainModel();

        $user->setRoleId(2)
            ->setPopularity(UserPopularityDomainModel::createUserPopularity())
            ->setName($data['name'])
            ->setEmail($data['email'])
            ->setPassword($data['password'])
            ->setPhone($data['phone'])
            ->setGender($data['gender'])
            ->setAddress($data['address'])
            ->setProfilePicture(
                ProfilePictureDomainModel::createProfilePictureFromFile($data['picture']))
            ->setBirthday($data['birthday']);

        return $user;
    }

}