<?php

namespace App\Repository\Repositories;
use App\Repository\DataModels\Category;
use App\Domains\DomainModels\DomainModel;

Class CategoryRepository implements Repository{

	/**
     * Retrieve all data category from Database 
     * @author Alvent
     * @param Integer $perPage = 10;
     * Dont use pagination for show all category
     * @return Collection of Illuminate\Database\Eloquent\Model
     */
    public function all($perPage = 10)
    {
        $categories = Category::all();
        return $categories;
    }

    /**
     * Retrieve data from Database with specified id
     * @author Alvent
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        $category = Category::find($id);
        return $category;
    }

    /**
     * Insert new model to Database
     * @author Alvent
     *
     * @param array $data
     */
    public function create(array $data)
    {
        $category = new Category();
        $category->name = $data['name'];
        $category->created_at = date('Y-m-d H:i:s');
        $category->updated_at = date('Y-m-d H:i:s');

        $category->save();
    }

    /**
     * Update data with specified id inside Database with updated model
     * @author Alvent
     * @param array $data
     * @param $id
     * @return Boolean
     */
    public function update(array $data, $id)
    {
        $category = Category::find($id); 
        $category->name = $data['name']; 

        $category->save();
    }

    /**
     * Delete data with specified id inside Database
     * @author Alvent
     *
     * @param Integer $id
     * @return Boolean
     */
    public function delete($id)
    {
        $category = Category::find($id);
        $category->delete();
    }
}