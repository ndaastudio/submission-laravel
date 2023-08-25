<?php

namespace App\Http\Controllers\Home;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class ArticleController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Beranda',
            'latestArticles' => Article::latest()->limit(1)->get(),
            'otherLatestArticles' => Article::latest()->skip(1)->take(3)->get(),
            'interestingArticles' => Article::inRandomOrder()->limit(3)->get(),
        ];
        return view('home.article.index', $data);
    }

    public function show(string $uid, string $slug)
    {
        $userId = User::where('uid', $uid)->firstOrFail()->id;
        $article = Article::where('user_id', $userId)->where('slug', $slug)->firstOrFail();
        $data = [
            'title' => $article->judul,
            'article' => $article,
            'categories' => Category::has('articles')->get(),
            'latestArticles' => Article::latest()->skip(1)->take(5)->get(),
        ];
        return view('home.article.show', $data);
    }

    public function showByCategory(string $category)
    {
        $categoryName = Category::where('id', $category)->firstOrFail()->nama_kategori;
        $articles = Article::where('category_id', $category)->get();
        $data = [
            'title' => $categoryName,
            'articleByCategories' => $articles,
        ];
        return view('home.article.show-by-category', $data);
    }

    public function showAll()
    {
        $data = [
            'title' => 'Semua Artikel',
            'articles' => Article::all(),
        ];
        return view('home.article.show-all', $data);
    }
}
