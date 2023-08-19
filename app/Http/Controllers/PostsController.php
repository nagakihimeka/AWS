<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// ①use宣言
use App\Post;

class PostsController extends Controller
{
    public function hello()
    {
        echo 'hello world!<br>';
        echo 'コントローラーを使ったルーティング成功です。';
    }

    public function index()
    {
        $list = Post::get();
        return view('posts.index',['list'=>$list]);
    }

    public function createForm()
    {
        return view('posts.createForm');
    }

    //✴︎投稿処理
    public function create(Request $request)
    {
         // <input>タグのname属性が「newPost」と指定されていたところの値を$post変数内に入れている流れ
        $post = $request->input('newPost');
        // テーブルのpostカラムに、$post変数を当てはめて登録
        Post::create(['post' => $post]);
        return redirect('read');
    }

    //update（更新ボタンを押すと更新ページへ遷移）
    public function updateForm($id)
    {
        // (where)postsテーブルのidカラムがフォームから持ってきた$id変数の値と一致するレコードを選択するという処理
        $post = Post::where('id', $id)->first();
        return view('posts.updateForm', ['post'=>$post]);
    }

    //update機能
    public function update(Request $request)
    {
        // ①
        $id = $request->input('id');
        $up_post = $request->input('upPost');
        // ②
        Post::where('id',$id)->update(['post'=>$up_post]);
        // ③
        return redirect('read');
    }

    //delete
    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect('read');
    }

    // auth認証
    public function __construct()
    {
        $this->middleware('auth');
    }
}
