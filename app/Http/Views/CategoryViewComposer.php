<?php

namespace App\Http\Views;

use App\Models\Category;

/**
 * Description of CategoryViewComposer
 * Classe utilizada para compartilhar dados com as views
 *
 * @author ULASOU5
 */
class CategoryViewComposer {

    private $category;

    public function __construct(Category $category) {

        $this->category = $category;
    }

    public function compose($view) {

        return $view->with('categories', $this->category->all(['name', 'slug']));
    }

}
