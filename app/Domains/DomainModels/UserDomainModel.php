<?php /** @noinspection ALL */

/**
 * Created by PhpStorm.
 * UserDomainModel: UserDomainModel
 * Date: 12/21/2018
 * Time: 11:50 AM
 */

namespace App\Domains\DomainModels;

use App\Repository\DataModels\User;
use App\Repository\Repositories\PopularityRepository;
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
    protected $goodPopularity;
    protected $badPopularity;
    protected $createdAt;
    protected $updatedAt;


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
    public function getGoodPopularity()	{ return $this->goodPopularity; }
    public function getBadPopularity()	{ return $this->badPopularity; }
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
    protected function setGoodPopularity($goodPopularity)   { $this->goodPopularity = $goodPopularity; return $this; }
    protected function setBadPopularity($badPopularity)     { $this->badPopularity = $badPopularity; return $this; }
    protected function setCreatedAt($createdAt)             { $this->createdAt = $createdAt; return $this; }
    protected function setUpdatedAt($updatedAt)             { $this->updatedAt = $updatedAt; return $this; }


    /**
     * UserDomainModel Constructor
     * @author Yansen
     */
    protected function __construct(){}


    /**
     * Add one point to current user Good Popularity
     * @author Yansen
     *
     * @return void
     */
    public function increaseGoodPopularityByOne()
    {
        $this->goodPopularity += 1;
    }


    /**
     * Substract one point from current user Good Popularity
     * @author Yansen
     *
     * @return void
     */
    public function decreaseGoodPopularityByOne()
    {
        $this->goodPopularity -= 1;
    }


    /**
     * Add one point to current user Bad Popularity
     * @author Yansen
     *
     * @return void
     */
    public function increaseBadPopularityByOne()
    {
        $this->badPopularity += 1;
    }


    /**
     * Substract one point from current user Bad Popularity
     * @author Yansen
     *
     * @return void
     */
    public function decreaseBadPopularityByOne()
    {
        $this->badPopularity -= 1;
    }

    /**
     * Update other user's vote to current user from Bad Vote to Good Vote
     * @author Yansen
     *
     * @return void
     */
    public function revoteToGood()
    {
        $this->increaseGoodPopularityByOne();
        $this->decreaseBadPopularityByOne();
    }


    /**
     * Update other user's vote to current user from Good Vote to Bad Vote
     * @author Yansen
     *
     * @return void
     */
    public function revoteToBad()
    {
        $this->increaseBadPopularityByOne();
        $this->decreaseGoodPopularityByOne();
    }

    /**
     * Create a new popularity vote in popularities table
     * and update target user's popularity
     * @author Yansen
     *
     * @param UserDomainModel $targetUser
     * @param Integer $voteStatus
     * @return void
     */
    public function createNewPopularityVoteAndUpdateTargetUserPopularity(UserDomainModel $targetUser, $voteStatus)
    {
        $popularity = PopularityDomainModel::createWithStatus(
                        $this->getId(),
                        $targetUser->getId(),
                        $voteStatus);
        $popularity->addPopularity();

        if($voteStatus == PopularityStatusEnumeration::Good)
            $targetUser->increaseGoodPopularityByOne();
        else
            $targetUser->increaseBadPopularityByOne();

        $userRepository = new UserRepository();
        $userRepository->updateUserPopularity($targetUser);
    }


    /**
     * Update existing popularity vote in popularities table
     * and update target user's popularity
     * @author Yansen
     *
     * @param UserDomainModel $targetUser
     * @param Integer $voteStatus
     * @return void
     */
    public function updateExistingPopularityVoteAndUpdateTargetUserPopularity(UserDomainModel $targetUser, $voteStatus)
    {
        $popularityRepository = new PopularityRepository();
        $popularity = PopularityDomainModel::createFromUserDataModel(
                        $popularityRepository->find($this->getId(), $targetUser->getId()));
        $popularity->setVoteStatus($voteStatus);
        $popularity->editPopularity();

        if($voteStatus == PopularityStatusEnumeration::Good)
            $targetUser->revoteToGood();
        else
            $targetUser->revoteToBad();

        $userRepository = new UserRepository();
        $userRepository->updateUserPopularity($targetUser);
    }

    /**
     * Create new popularity vote in popularities table if record exists
     * Otherwise update popularity vote record in popularities table
     * and then update target user popularity
     * @author Yansen
     *
     * @param Integer $targetUserId
     * @return void
     */
    public function voteGoodForUser($targetUserId)
    {
        if(!PopularityDomainModel::isVoted($this->getId(), $targetUserId))
        {
            $targetUser = UserDomainModel::createFromDataModel(User::find($targetUserId));

            $this->createNewPopularityVoteAndUpdateTargetUserPopularity(
                $targetUser,
                PopularityStatusEnumeration::Good);
        }
        else
        {
            $targetUser = UserDomainModel::createFromDataModel(
                (new UserRepository())->find($targetUserId));

            $this->updateExistingPopularityVoteAndUpdateTargetUserPopularity(
                $targetUser,
                PopularityStatusEnumeration::Good);
        }
    }


    /**
     * Create new popularity vote in popularities table if record exists
     * Otherwise update popularity vote record in popularities table
     * and then update target user popularity
     * @author Yansen
     *
     * @param Integer $targetUserId
     * @return void
     */
    public function voteBadForUser($targetUserId)
    {
        if(!PopularityDomainModel::isVoted($this->getId(), $targetUserId))
        {
            $targetUser = UserDomainModel::createFromDataModel(User::find($targetUserId));

            $this->createNewPopularityVoteAndUpdateTargetUserPopularity(
                $targetUser,
                PopularityStatusEnumeration::Bad);
        }
        else
        {
            $targetUser = UserDomainModel::createFromDataModel(
                (new UserRepository())->find($targetUserId));

            $this->updateExistingPopularityVoteAndUpdateTargetUserPopularity(
                $targetUser,
                PopularityStatusEnumeration::Bad);
        }
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
     * Get logged in user object
     * @author Yansen
     *
     * @return UserDomainModel
     */
    public static function getAuthUser()
    {
        return Session::get('User');
    }


    /**
     * Get all users and show them with pagination
     * @author Yansen
     *
     * @param Integer $perPage = 10
     * @return Collection of Repository\DataModels\User
     */
    public static function getAllUsers($perPage)
    {
        return (new UserRepository())->all($perPage);
    }


    /**
     * Get specified user with related id
     * @author Yansen
     *
     * @param Integer $id
     * @return Repository\DataModels\User
     */
    public static function findUser($id)
    {
        return (new UserRepository())->find($id);
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
        $profilePicture = ProfilePictureDomainModel::createFromFile($data['picture']);
        $data['picture'] = $profilePicture->getFileName();

        return (new UserRepository())->create($data);
    }


    /**
     * Remove old profile picture from server
     * Add new uploaded profile picture to server
     * and Save updated user to the database
     * @author Yansen
     *
     * @param array $data
     * @return Boolean
     */
    public static function editUser(array $data, $id)
    {
        $user = self::findUser($id);
        ProfilePictureDomainModel::delete($user->profile_picture);

        $profilePicture = ProfilePictureDomainModel::createFromFile($data['picture']);
        $data['picture'] = $profilePicture->getFileName();

        return (new UserRepository())->update($data, $id);
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
        $user = self::findUser($userId);
        ProfilePictureDomainModel::delete($user->profile_picture);

        return (new UserRepository())->delete($userId);
    }


    /**
     * Factory Method to create UserDomainModel from array of Data
     * @author Yansen
     *
     * @param Repository\DataModels\User $model
     * @return UserDomainModel
     */
    public static function createFromDataModel(User $model)
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
            ->setGoodPopularity($model->good_popularity)
            ->setBadPopularity($model->bad_popularity)
            ->setProfilePicture(
                ProfilePictureDomainModel::create(
                    $model->profile_picture));

        return $user;
    }

}