<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 12/26/2018
 * Time: 8:29 AM
 */

namespace App\Domains\DomainModels;


use App\Repository\Repositories\ThreadRepository;

class ThreadDomainModel extends DomainModel
{
    protected $id;
    protected $userId;
    protected $forumId;
    protected $content;
    protected $createdAt;
    protected $updatedAt;


    /**
     * Properties GETTER
     * @author Yansen
     *
     */
    public function getId()			{ return $this->id; }
    public function getUserId()		{ return $this->userId; }
    public function getForumId()	{ return $this->forumId; }
    public function getContent()	{ return $this->content; }
    public function getCreatedAt()	{ return $this->createdAt; }
    public function getUpdatedAt()	{ return $this->updatedAt; }


    /**
     * Properties SETTER
     * @author Yansen
     *
     */
    public function setId($id)					{ $this->id = $id; return $this; }
    public function setUserId($userId)			{ $this->userId = $userId; return $this; }
    public function setForumId($forumId)		{ $this->forumId = $forumId; return $this; }
    public function setContent($content)		{ $this->content = $content; return $this; }
    public function setCreatedAt($createdAt)	{ $this->createdAt = $createdAt; return $this; }
    public function setUpdatedAt($updatedAt)	{ $this->updatedAt = $updatedAt; return $this; }

    public static function getAllForumThread($forumId, $perPage = 10, $keyword = '')
    {
        return (new ThreadRepository())->all($forumId, $perPage, $keyword);
    }

    public static function findThread($id)
    {
        return (new ThreadRepository())->find($id);
    }

    public static function addThread(array $data)
    {
        return (new ThreadRepository())->create($data);
    }

    public static function editThread(array $data, $id)
    {
        return (new ThreadRepository())->update($data, $id);
    }

    public static function deleteThread($id)
    {
        return (new ThreadRepository())->delete($id);
    }
}