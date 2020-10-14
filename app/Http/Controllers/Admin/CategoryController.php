<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Validation\Rule;

class CategoryController extends Controller {

    private $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $categories = $this->category->paginate(5);

        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request) {

        $data = $request->all();

        $category = $this->category->create($data);

        flash('Categoria criada com sucesso!')->success();
        return redirect()->route('admin.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function show($category) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category) {

        $category = $this->category->findOrFail($category);

        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $category) {

        $data = $request->all();

        $category = $this->category->findOrFail($category);

        $category->update($data);

        flash('Categoria atualiza com sucesso')->success();
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category) {

        $category = $this->category->findOrFail($category);

        $category->delete();

        flash('Categoria excluída com sucesso!')->success();
        return redirect()->route('admin.categories.index');
    }

}
