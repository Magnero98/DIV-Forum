<?php
/**
 * Created by PhpStorm.
 * UserDomainModel: UserDomainModel
 * Date: 12/21/2018
 * Time: 10:32 PM
 */

namespace App\Domains\DomainModels;

use Illuminate\Support\Facades\File;

class ProfilePictureDomainModel
{
    protected $filename;

    /**
     * Properties GETTER
     * @author Yansen
     *
     */
    public function getFileName()	{ return $this->filename; }


    /**
     * Properties SETTER
     * @author Yansen
     *
     */
    protected function setFilename($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * UserDomainModel Constructor
     * @author Yansen
     */
    protected function __construct(){}


    /**
     * Get the image's path
     * @author Yansen
     *
     * @return String
     */
    public function getImagePath()
    {
        return self::getImageDirectory()
            . $this->getFilename();
    }


    /**
     * Get the image directory's path
     * @author Yansen
     *
     * @return String
     */
    public static function getImageDirectory()
    {
        return "uploads\profile_pictures";
    }


    /**
     * Move image file to public directory
     * @author Yansen
     *
     * @param File $file
     * @return void
     */
    public static function moveToPublicDirectory($file)
    {
        $file->move(
            ProfilePictureDomainModel::getImageDirectory(),
            $file->getFilename());
    }


    /**
     * Factory method to create Profile Picture
     * and save it to public/uploads/images
     * @author Yansen
     *
     * @param File $file
     * @return ProfilePictureDomainModel
     */
    public static function createFromFile($file)
    {
        $profilePicture = new ProfilePictureDomainModel();

        $profilePicture->setFilename($file->getFilename());

        ProfilePictureDomainModel::moveToPublicDirectory($file);

        return $profilePicture;
    }

    public static function delete($filename)
    {
        $filePath = public_path() . '\\uploads\\profile_pictures\\' . $filename;
        if(File::exists($filePath))
            File::delete($filePath);
    }

    /**
     * Factory method to create Profile Picture
     * from filename
     * @author Yansen
     *
     * @param String $filename
     * @return ProfilePictureDomainModel
     */
    public static function create($filename)
    {
        $profilePicture = new ProfilePictureDomainModel();

        $profilePicture->setFilename($filename);

        return $profilePicture;
    }
}