<?php

namespace App\Http\Controllers;

use App\Domains\DomainModels\ThreadDomainModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\DomainModels\ForumDomainModel;
use App\Domains\DomainModels\CategoryDomainModel;
use App\Domains\DomainModels\UserDomainModel;
use App\Repository\DataModels\Forum;

class ForumController extends Controller
{

    /**
     * ForumController Constructor
     * @author Alvent
     */
    public function __construct()
    {
        $this->middleware(
            'validateForumData',
            ['only' => ['store', 'update']]);
    }
    /**
     * Display a listing of the forum.
     * @author Alvent
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {   
        $forums = ForumDomainModel::showAllForum(5, $request->search);
        return view('forums.index', ["forums" => $forums]);
    }

    /**
    * Display all forum for Admin
    * @author Alvent
    * @return \Illuminate\Http\Response 
    */
    public function masterForum(){
        $forums = ForumDomainModel::showAllForum(10);
        return view('forums.admins.index', ["forums" => $forums]);
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
        ForumDomainModel::createForumFromArray($request->all());

        return redirect()->route('forums.index');
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
        $forum = ForumDomainModel::showForum($id);
        $threads = ThreadDomainModel::getAllForumThread($id, 5, $request->keyword);
        return view('forums.show')
            ->with('forum', $forum)
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

        return back();
    }

    /**
     * Remove the specified forum from database.
     * @author Alvent
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ForumDomainModel::deleteForum($id);
        return back();
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
