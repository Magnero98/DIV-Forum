<?php

namespace App\Domains\DomainModels;
use App\Repository\Repositories\CategoryRepository;

Class CategoryDomainModel extends DomainModel{
	protected $id; 
	protected $name; 

	/**
     * Properties GETTER
     * @author Alvent
     */

	public function getId(){ return $this->id; }
	public function getName(){ return $this->name; }

	/**
     * Properties SETTER 
     * @author Alvent 
     */

	public function setId($id){ $this->id = $id; return $this; }
	public function setName($name){ $this->name = $name; return $this; }

    /**
	* Show all category in DB     
	* @author Alvent 
	* @return Collection of Repository/DataModels/Category
	*/
	public static function showAllCategory(){
		$categoryRepository = new CategoryRepository();
		$categories = $categoryRepository->all();
		return $categories;
	}

	/**
	* Create new category from array data   
	* @author Alvent 
	* @param array $data
	*/
	public static function createCategoryFromArray(array $data){
		$categoryRepository = new CategoryRepository();
		$categoryRepository = $categoryRepository->create($data);
	}

	/**
	* delete specified category from DB     
	* @author Alvent 
	* @param $id
	*/

	public static function deleteCategory($id){
		$categoryRepository = new CategoryRepository();
		$categoryRepository->delete($id);
	}


	/**
	* get specified category from DB     
	* @author Alvent 
	* @param $id
	* @return Repository/DataModels/Category
	*/

	public static function findCategory($id){
		$categoryRepository = new CategoryRepository();
		return $categoryRepository->find($id);
	}

	/**
	* update category from array $data    
	* @author Alvent 
	* @param $id
	* @return Repository/DataModels/Category
	*/
	public static function updateCategoryFromArray(array $data, $id){
		$categoryRepository = new CategoryRepository();
        $categoryRepository->update($data, $id);
	}


}




