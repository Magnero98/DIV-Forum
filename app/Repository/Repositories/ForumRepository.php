<?php


namespace App\Repository\Repositories;
use App\Repository\DataModels\Forum;
use App\Domains\DomainModels\DomainModel;
use App\Domains\DomainModels\UserDomainModel;


Class ForumRepository implements Repository{

	/**
     * Retrieve all data from Database with pagination default perpage = 5
     * @author Alvent
     *
     * @param Integer $perPage = 5
     * @return Collection of Illuminate\Database\Eloquent\Model
     */
    public function all($perPage = 5, $search='')
    {
        $forums = Forum::where('title','LIKE','%'.$search.'%')->orWhereHas('category', function($q) use ($search)
        {
            $q->where('name', 'like', '%'.$search.'%');
        })->orderBy('forums.created_at','desc')->paginate($perPage)->appends(['search' => $search]);

        return $forums;
    }

    /**
     * Retrieve data from Database with specified id
     * @author Alvent
     *
     * @return Illuminate\Database\Eloquent\Model
     */
    public function find($id)
    {
        $forum = Forum::find($id);
        return $forum;
    }

    /**
     * Insert new model to Database
     * @author Alvent
     *
     * @param array $data
     * @return Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        $forum = new Forum();
        $forum->user_id = UserDomainModel::getAuthUser()->getId();
        $forum->category_id = $data['category'];
        $forum->forum_status_id = 1;
        $forum->title = $data['name'];
        $forum->description = $data['description'];
        $forum->created_at = date('Y-m-d H:i:s');
        $forum->updated_at = date('Y-m-d H:i:s');

        $forum->save();

        return $forum;
    }

    /**
     * Update forum with specified id inside Database from array data
     * @author Alvent
     * @param $id
     * @param array $data
     * @return Boolean
     */
    public function updateForum(array $data, $id)
    {
        $forum = Forum::find($id);
        $forum->title = $data['name'];
        $forum->category_id = $data['category'];
        $forum->description = $data['description'];

        $forum->save();
    }

    /**
     * Update forum status with specified id inside Database
     * @author Alvent
     * @param $id
     */
    public function updateStatus($id){
        $forum = Forum::find($id); 
        $forum->forum_status_id = 2;
        $forum->save();
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
        $forum = Forum::find($id);
        $forum->delete();
    }

    /**
    * Display forum owned by user  
    * @author Alvent 
    * @return Collection of Repository/DataModels/Forum
    */

    public function myForum(){
        $userId = UserDomainModel::getAuthUser()->getId();
        return Forum::where('user_id','=',$userId)->orderBy('created_at','desc')->paginate(5);
    }


}



