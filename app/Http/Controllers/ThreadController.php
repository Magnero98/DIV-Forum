<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Domains\DomainModels\ThreadDomainModel;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * UserDomainModel Constructor
     * @author Yansen
     */
    public function __construct()
    {
        $this->middleware(
            'validateThreadData',
            ['only' => ['store', 'update']]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ThreadDomainModel::addThread($request->all());

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thread = ThreadDomainModel::findThread($id);

        return view('threads.edit')
            ->with('thread', $thread);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ThreadDomainModel::editThread($request->all(), $id);

        return redirect(route('forums.show', ['id' => $request->forum_id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ThreadDomainModel::deleteThread($id);

        return back();
    }
}
