<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Constants\Constants;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostsController extends Controller
{
    /**
     * 投稿の一覧を表示する。
     * 
     * @return \Illuminate\View\View 投稿一覧ページのビュー
     */
    public function index()
    {
        $posts = Post::all(); // 投稿を全件取得
    
        return view('posts.index', compact('posts')); // 取得した投稿をビューに渡す
    }

    /**
     * 投稿作成ページを表示する。
     * 
     * @return \Illuminate\View\View 投稿作成ページのビュー
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * リクエストデータのバリデーションを実行する。
     * 
     * @param  \Illuminate\Http\Request  $request バリデーション対象のリクエスト
     * @return array バリデーションを通過したデータ
     */
    private function validatePost(Request $request)
    {
        return $request->validate([
            Constants::POST_COLUMN_TITLE => Constants::POST_TITLE_VALIDATE,
            Constants::POST_COLUMN_DETAIL => Constants::POST_DETAIL_VALIDATE,
        ]);
    }

    /**
     * 投稿を保存する。
     * 
     * @param  \Illuminate\Http\Request  $request フォームに入力されたデータ
     * @return \Illuminate\Http\RedirectResponse 投稿一覧ページへのリダイレクト
     */
    public function store(Request $request)
    {
        // バリデーションを行う
        $validated = $this->validatePost($request);

        // 保存処理
        Post::create([
            Constants::POST_COLUMN_USER_ID => Auth::id(), // ログインユーザーID
            Constants::POST_COLUMN_TITLE   => $validated[Constants::POST_COLUMN_TITLE],
            Constants::POST_COLUMN_DETAIL  => $validated[Constants::POST_COLUMN_DETAIL],
        ]);

        return redirect()->route('posts.index')->with('success', Constants::POST_CREATED_SUCCESS);
    }

    /**
     * 投稿をIDをもとに取得する。
     * 
     * @param  int  $id 投稿ID
     * @return \App\Models\Post | \Illuminate\Http\RedirectResponse 投稿が見つかった場合は投稿、見つからなかった場合はリダイレクト
     */
    private function findPostById($id)
    {
        try 
        {
            return Post::findOrFail($id);
        } catch (ModelNotFoundException $e) 
        {
            return redirect()->route('posts.index')->with('error', Constants::POST_NOT_FOUND_ERROR);
        }
    }

    /**
     * 投稿詳細を表示する。
     * 
     * @param  int  $id 投稿のID
     * @return \Illuminate\View\View 投稿詳細ページのビュー
     */
    public function show($id)
    {
        $post = $this->findPostById($id);
        if ($post instanceof \Illuminate\Http\RedirectResponse) {
            return $post; // 投稿が見つからない場合はリダイレクト
        }
    
        return view('posts.show', compact('post'));
    }

    /**
     * 投稿の作者とログイン中のユーザーが違った場合にリダイレクト先を返す。
     * 
     * @param  \App\Models\Post  $post 投稿モデル
     * @return \Illuminate\Http\RedirectResponse|null リダイレクトする場合はその応答
     */
    private function ensureAuthor(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('posts.index')->with('error', Constants::INVALID_OPERATION_ERROR);
        }
        return null;
    }

    /**
     * 投稿編集ページを表示する。
     * 
     * @param  int  $id 編集対象の投稿ID
     * @return \Illuminate\View\View 投稿編集ページのビュー
     */
    public function edit($id)
    {
        $post = $this->findPostById($id);
        if ($post instanceof \Illuminate\Http\RedirectResponse) {
            return $post; // 投稿が見つからない場合はリダイレクト
        }
        
        if ($redirect = $this->ensureAuthor($post)) {
            return $redirect;
        }
    
        return view('posts.edit', compact('post'));
    }

    /**
     * 投稿を更新する。
     * 
     * @param  \Illuminate\Http\Request  $request フォームに入力されたデータ
     * @param  int  $id 更新対象の投稿ID
     * @return \Illuminate\Http\RedirectResponse 投稿一覧ページへのリダイレクト
     */
    public function update(Request $request, $id)
    {
        $post = $this->findPostById($id);
        if ($post instanceof \Illuminate\Http\RedirectResponse) {
            return $post; // 投稿が見つからない場合はリダイレクト
        }
    
        // バリデーションを行う
        $validated = $this->validatePost($request);
    
        // 投稿を更新する
        $post->update([
            Constants::POST_COLUMN_TITLE => $validated[Constants::POST_COLUMN_TITLE],
            Constants::POST_COLUMN_DETAIL => $validated[Constants::POST_COLUMN_DETAIL],
        ]);
    
        return redirect()->route('posts.index')->with('success', Constants::POST_UPDATED_SUCCESS);
    }

    /**
     * 投稿を削除する。
     * 
     * @param  int  $id 削除対象の投稿ID
     * @return \Illuminate\Http\RedirectResponse 投稿一覧ページへのリダイレクト
     */
    public function destroy($id)
    {
        $post = $this->findPostById($id);
        if ($post instanceof \Illuminate\Http\RedirectResponse) {
            return $post; // 投稿が見つからない場合はリダイレクト
        }
    
        $post->delete();
        return redirect()->route('posts.index')->with('success', Constants::POST_DELETED_SUCCESS);
    }
}
