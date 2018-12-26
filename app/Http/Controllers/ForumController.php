<?php

namespace App\Http\Controllers;

use App\Domains\DomainModels\ThreadDomainModel;
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
            return view('forums.create', compact('categories'));
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
            return redirect()->route('forums.create')->withErrors($validator)->withInput(Input::all());
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
     * @author Yansen
     *
     * @param \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $threads = ThreadDomainModel::getAllForumThread($id, 2, $request->keyword);
        return view('forums.show')
            ->with('forum_id', $id)
            ->with('threads', $threads);
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
           return redirect()->route('forums.edit', $id)->withErrors($validator);
        }

        ForumDomainModel::updateForumFromArray($request->all(), $id);

        return redirect()->route('myForum');
    }

    /**
     * Update the specified forum status in database.
     * @author Alvent
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function updateStatus($id){
        ForumDomainModel::updateStatus($id);

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
