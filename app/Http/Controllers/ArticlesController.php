<?php
namespace App\Http\Controllers;

use App\DataTables\ArticleDataTable;
use App\Models\Category;
use App\Models\Tag;

class ArticlesController extends Controller
{
    public function index(ArticleDataTable $dataTable)
    {
        $tags = Tag::all();
        $categories = Category::all();
        return $dataTable->render('articles.index',compact('tags','categories'));
    }
    public function store(ArticleDataTable $editor)
    {
        return $editor->process(request());
    }
}
