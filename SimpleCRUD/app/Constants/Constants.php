<?php

namespace App\Constants;

class Constants
{
    // ------------------- カラム名 -------------------
    // ユーザー関連カラム名
    const USER_COLUMN_NAME = 'name';
    const USER_COLUMN_EMAIL = 'email';
    const USER_COLUMN_PASSWORD = 'password';

    // 投稿関連カラム名
    const POST_COLUMN_USER_ID = 'user_id';
    const POST_COLUMN_TITLE = 'title';
    const POST_COLUMN_DETAIL = 'detail';

    // ------------------- バリデーション -------------------
    // ユーザー関連のバリデーションルール
    const USER_NAME_VALIDATE = 'required|max:255';
    const USER_EMAIL_VALIDATE = 'required|email|unique:users,email';
    const USER_PASSWORD_VALIDATE = 'required|min:8|confirmed';

    // 投稿関連のバリデーションルール
    const POST_TITLE_VALIDATE = 'required|string|max:255';
    const POST_DETAIL_VALIDATE = 'required|string';

    // ------------------- メッセージ -------------------
    // ユーザー関連のメッセージ
    // 成功メッセージ
    const USERS_REGISTER_SUCCESS = 'ユーザー登録が完了しました。ログインしてください。';
    const USERS_LOGIN_SUCCESS = 'ログインに成功しました';
    const USERS_LOGOUT_SUCCESS = 'ログアウトしました';

    // エラーメッセージ
    const USERS_REGISTER_ERROR = 'ユーザー登録に失敗しました';
    const USERS_LOGIN_FAILED = '認証に失敗しました。';


    // 投稿関連のメッセージ
    // 成功メッセージ
    const POST_CREATED_SUCCESS = '投稿が作成されました';
    const POST_UPDATED_SUCCESS = '投稿が更新されました';
    const POST_DELETED_SUCCESS = '投稿が削除されました';

    // エラーメッセージ
    const POST_NOT_FOUND_ERROR = '投稿が見つかりませんでした';
    const INVALID_OPERATION_ERROR = '不正な操作が行われました';

    // 追加する他のメッセージ...
}