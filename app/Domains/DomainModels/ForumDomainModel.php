<?php

namespace App\Domains\DomainModels;
use App\Repository\Repositories\ForumRepository;

Class ForumDomainModel extends DomainModel{
	protected $id; 
	protected $userId;
	protected $categoryId; 
	protected $forum_status_id; 
	protected $title; 
	protected $description; 

	/**
     * Properties GETTER
     * @author Alvent
     */

	public function getId(){ return $this->id; }
	public function getUserId(){ return $this->userId; }
	public function getCategoryId(){ return $this->categoryId; }
	public function getForumStatusId(){ return $this->forum_status_id; }
	public function getTitle(){ return $this->title; }
	public function getDescription(){ return $this->description; }

	/**
     * Properties SETTER 
     * @author Alvent 
     */

	protected function setId($id){ $this->id = $id; return $this; }
	protected function setUserId($id){ $this->userId = $id; return $this; }
	protected function setCategoryId($id){ $this->categoryId = $id; return $this; }
	protected function setForumStatusId($id){ $this->forum_status_id = $id; return $this; }
	protected function setTitle($title){ $this->title = $title; return $this; }
	protected function setDescription($description){ $this->description = $description; return $this; }

	/**
     * Add new Forum to the database
     * @author Alvent
     *
     * @return App\Repository\DataModels\Forum
     */
    public function addForum()
    {

    }

    /**
     * Factory Method to create ForumDomainModel from array of Data
     * @author Alvent
     *
     * @param array $data
     * @return Repository\DataModels\Forum
     */
     public static function createForumFromArray(array $data)
    {
        $forumRepository = new ForumRepository();
        return $forumRepository->create($data);
    }

    /**
    * Show forum with specified id
    * @author Alvent
    * @param $id
	* @return Repository/DataModels/Forum
	*/

    public static function showForum($id){
        $forumRepository = new ForumRepository();
        return $forumRepository->find($id);
    }

    /**
    * Delete Forum from db with specified Id 
    * @author Alvent 
    * @param Integer $id
    */

    public static function deleteForum($id){

    }

    /**
	* Show all forum in DB     
	* @author Alvent 
	* @param Integer $perPage
	* @return Collection of Repository/DataModels/Forum
	*/

    public static function showAllForum(){
    	$forumRepository = new ForumRepository(); 
        $forums = $forumRepository->all();
        return $forums;
    }

    /**
    * Display forum by title or name     
    * @author Alvent 
    * @param string $search
    * @return Collection of Repository/DataModels/Forum
    */
    public static function searchForum($search){
        $forumRepository = new ForumRepository();
        $forums = $forumRepository->search($search);
        return $forums;
    }

    /**
    * Display all forum owned    
    * @author Alvent 
    * @return Collection of Repository/DataModels/Forum
    */
    public static function myForum(){
        $forumRepository = new ForumRepository();
        $forums = $forumRepository->myForum();
        return $forums;
    }

}



