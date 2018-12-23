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
use Illuminate\Support\Facades\Session;

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
    protected $createdAt;
    protected $updatedAt;


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
    public function getCreatedAt()		{ return $this->createdAt; }
    public function getUpdatedAt()		{ return $this->updatedAt; }

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
    protected function setCreatedAt($createdAt)             { $this->createdAt = $createdAt; return $this; }
    protected function setUpdatedAt($updatedAt)             { $this->updatedAt = $updatedAt; return $this; }


    /**
     * UserDomainModel Constructor
     * @author Yansen
     */
    protected function __construct(){}


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
     * @return void
     */
    public function saveUserToSession()
    {
        Session::put('User', $this);
    }


    /**
     * Add new user to the database and move user picture to public directory
     * @author Yansen
     *
     * @param array $data
     * @return Repository\DataModels\User
     */
    public static function addUser(array $data)
    {
        $profilePicture = ProfilePictureDomainModel::createProfilePictureFromFile($data['picture']);
        $data['picture'] = $profilePicture->getFileName();

        $userRepository = new UserRepository();
        return $userRepository->create($data);
    }


    /**
     * Save updated user to the database
     * @author Yansen
     *
     * @param array $data
     * @return Boolean
     */
    public static function editUser(array $data)
    {
        $userRepository = new UserRepository();
        return $userRepository->update($data);
    }


    /**
     * Delete user with specified Id from database
     * @author Yansen
     *
     * @param Integer $userId
     * @return Boolean
     */
    public static function deleteUser($userId)
    {
        $userRepository = new UserRepository();
        return $userRepository->delete($userId);
    }


    /**
     * Factory Method to create UserDomainModel from array of Data
     * @author Yansen
     *
     * @param Repository\DataModels\User $model
     * @return UserDomainModel
     */
    public static function createUserFromUserDataModel(User $model)
    {
        $user = new UserDomainModel();

        $user->setId($model->id)
            ->setRoleId($model->role_id)
            ->setName($model->name)
            ->setEmail($model->email)
            ->setPassword($model->password)
            ->setPhone($model->phone)
            ->setGender($model->gender)
            ->setAddress($model->address)
            ->setBirthday($model->birthday)
            ->setCreatedAt($model->created_at)
            ->setUpdatedAt($model->updated_at)
            ->setPopularity(
                UserPopularityDomainModel::createUserPopularity(
                    $model->goodPopularity,
                    $model->badPopularity))
            ->setProfilePicture(
                ProfilePictureDomainModel::createProfilePicture(
                    $model->profile_picture));

        return $user;
    }

    /**
     * Get logged in user object
     * @author Yansen
     *
     * @return UserDomainModel
     */
    public static function getAuthUser()
    {
        return Session::get('User');
    }

}