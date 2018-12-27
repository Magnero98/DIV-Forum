<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Domains\DomainModels\CategoryDomainModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @author Alvent
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = CategoryDomainModel::showAllCategory();
        return view('categories.index', ["categories" => $categories]);
    }

    /**
     * Get a validator for create category request.
     * @author Alvent
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    protected function validator(array $data){
        return Validator::make($data, [
            'name' => 'required|max:10',
        ]);
    }

    /**
     * Store a newly created category to DB.
     * @author Alvent
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());

        if($validator->fails()){
             return redirect()->route('categories.index')->withErrors($validator)->withInput(Input::all());
        }

        CategoryDomainModel::createCategoryFromArray($request->all());

        return redirect()->route('categories.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @author Alvent
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = CategoryDomainModel::findCategory($id);
        return view('categories.edit', ["category" => $category]);
    }

    /**
     * Update the specified resource in storage.
     * @author Alvent
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = $this->validator($request->all());

        if($validator->fails()){
           return redirect()->route('categories.edit', $id)->withErrors($validator);
        }

        CategoryDomainModel::updateCategoryFromArray($request->all(), $id);

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     * @author Alvent
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CategoryDomainModel::deleteCategory($id);
        return back();
    }
}
