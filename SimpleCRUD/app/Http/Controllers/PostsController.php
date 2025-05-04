<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all(); // 投稿を全件取得
    
        return view('posts.index', compact('posts')); // 取得した投稿をビューに渡す
    }

    // 投稿作成ページを表示
    public function create()
    {
        return view('posts.create');
    }

    // 投稿を保存
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|string|max:255',
            'detail' => 'required|string',
        ]);

        // 保存処理
        Post::create([
            'user_id' => Auth::id(), // ログインユーザーID
            'title'   => $request->input('title'),
            'detail'  => $request->input('detail'),
        ]);

        return redirect()->route('posts.index')->with('success', '投稿が作成されました');
    }
}
