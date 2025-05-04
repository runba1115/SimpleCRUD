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
        // 投稿詳細表示
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    // 投稿の作者とログイン中のユーザーが違ったらリダイレクト先（投稿一覧ページ）を返す
    private function ensureAuthor(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index');
        }
        return null;
    }

    // 投稿編集ページ表示
    public function edit(Post $post)
    {
        if ($redirect = $this->ensureAuthor($post)) {
            return $redirect;
        }

        return view('posts.edit', compact('post'));
    }

    // 投稿削除
    public function delete(Post $post)
    {
        if ($redirect = $this->ensureAuthor($post)) {
            return $redirect;
        }

        $post->delete();
        return redirect()->route('posts.index')->with('success', '投稿が削除されました');
    }
}
