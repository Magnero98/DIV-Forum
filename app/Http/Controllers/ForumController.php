<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\DomainModels\ForumDomainModel;
use App\Domains\DomainModels\CategoryDomainModel;
use App\Domains\DomainModels\UserDomainModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Repository\DataModels\Forum;

class ForumController extends Controller
{
    /**
     * Display a listing of the forum.
     * @author Alvent
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = ForumDomainModel::showAllForum();
        return view('forums.index', ["forums" => $forums]);
    }

    /**
     * Show the form for creating a new resource.
     * @author Alvent
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $user = UserDomainModel::getAuthUser();
        if($user){
            $categories = CategoryDomainModel::showAllCategory();
            $input = [
                'name' => '',
                'category' => '',
                'description' => ''
            ];
            return view('forums.create', compact('input'), compact('categories'));
        }
        
        return redirect('login');
    }

    /**
     * Store a new forum to database. 
     * @author Alvent
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            
        $validator = $this->validator($request->all());

        if($validator->fails()){
            $categories = CategoryDomainModel::showAllCategory();
            return view('forums.create',["categories" => $categories])->
            withErrors($validator)->withInput(Input::all());
        }

        ForumDomainModel::createForumFromArray($request->all());

        return redirect()->route('forums.index');
    }

    /**
     * Get a validator for create forum request.
     * @author Alvent
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => 'required',
            'category' => 'required',
        ]);
    }

    /**
     * Display the specified resource.
     * @author Alvent
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @author Alvent
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $forum = ForumDomainModel::showForum($id);
        $categories = CategoryDomainModel::showAllCategory();

        return view('forums.edit',["forum" => $forum], ["categories" => $categories]);
    }

    /**
     * Update the specified forum in database.
     * @author Alvent
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validator($request->all());
        if($validator->fails()){
            $categories = CategoryDomainModel::showAllCategory();
            $forum = ForumDomainModel::showForum($id);
            $forum->title = $request->get('name');
            $forum->category_id = $request->get('category');
            $forum->description = $request->get('description');
            return view('forums.edit',["categories" => $categories],["forum" => $forum])->withErrors($validator)->withInput(Input::all());
        }

        ForumDomainModel::updateForumFromArray($request->all(), $id);

        return redirect()->route('myForum');
    }

    /**
     * Remove the specified resource from storage.
     * @author Alvent
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
    * Search forum by title and category name 
    * @author Alvent 
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function searchForum(Request $request){
        $search = $request->get('search');
        $forums = ForumDomainModel::searchForum($search);
        $forums->appends($request->only('search'));
        return view('forums.index', ["forums" => $forums]); 
    } 

    /**
    * show all forum owned 
    * @author Alvent 
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function myForum(){
        $forums = ForumDomainModel::myForum();
        return view('forums.myForum', ["forums" => $forums]);
    } 
}
