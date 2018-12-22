<?php
/**
 * Created by PhpStorm.
 * UserDomainModel: UserDomainModel
 * Date: 12/21/2018
 * Time: 10:32 PM
 */

namespace App\Domains\DomainModels;


class ProfilePictureDomainModel
{
    protected $imageFile;

    /**
     * Properties GETTER
     * @author Yansen
     *
     */
    public function getImageFile()	{ return $this->imageFile; }


    /**
     * Properties SETTER
     * @author Yansen
     *
     */
    protected function setImageFile($imageFile)
    {
        $this->imageFile = $imageFile;
        return $this;
    }

    /**
     * UserDomainModel Constructor
     * @author Yansen
     */
    protected function __construct(){}


    /**
     * Get the image directory's path
     * @author Yansen
     *
     * @return String
     */
    public function getImageDirectory()
    {
        return "/uploads/profile_pictures";
    }


    /**
     * Get the image's path
     * @author Yansen
     *
     * @return String
     */
    public function getImagePath()
    {
        return $this->getImageDirectory()
            . $this->imageFile->getFilename();
    }


    /**
     * Move image file to specific path
     * @author Yansen
     *
     * @param String
     * @return void
     */
    protected function moveTo($path)
    {
        $this->imageFile->move($path, $this->imageFile->getFilename());
    }


    /**
     * Factory method to create Profile Picture
     * and save it to public/uploads/images
     * @author Yansen
     *
     * @param array
     * @return ProfilePictureDomainModel
     */
    public static function createProfilePictureFromFile($file)
    {
        $profilePicture = new ProfilePictureDomainModel();
        $profilePicture->setImageFile($file);
        $profilePicture->moveTo($profilePicture->getImageDirectory());

        return $profilePicture;
    }
}