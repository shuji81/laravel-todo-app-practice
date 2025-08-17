# TODOアプリ設計ドキュメント

## 1. DB設計

### 1-1. users テーブル（Fortify標準）

| カラム名         | 型           | 備考                       |
|------------------|--------------|----------------------------|
| id               | BIGINT       | PK, AUTO_INCREMENT         |
| name             | VARCHAR(255) | ユーザー名                 |
| email            | VARCHAR(255) | UNIQUE, メールアドレス     |
| email_verified_at| TIMESTAMP    | メール認証日時             |
| password         | VARCHAR(255) | パスワード（ハッシュ）     |
| remember_token   | VARCHAR(100) | ログイン保持トークン       |
| created_at       | TIMESTAMP    | 作成日時                   |
| updated_at       | TIMESTAMP    | 更新日時                   |
| role             | ENUM         | 'user', 'admin'（追加）    |

### 1-2. projects テーブル

| カラム名     | 型           | 備考                       |
|--------------|--------------|----------------------------|
| id           | BIGINT       | PK, AUTO_INCREMENT         |
| name         | VARCHAR(255) | プロジェクト名             |
| description  | TEXT         | プロジェクト説明           |
| created_at   | TIMESTAMP    | 作成日時                   |
| updated_at   | TIMESTAMP    | 更新日時                   |

### 1-3. project_user テーブル（プロジェクト管理者・メンバー）

| カラム名     | 型           | 備考                       |
|--------------|--------------|----------------------------|
| id           | BIGINT       | PK, AUTO_INCREMENT         |
| project_id   | BIGINT       | FK: projects.id            |
| user_id      | BIGINT       | FK: users.id               |
| is_admin     | BOOLEAN      | プロジェクト管理者フラグ   |
| created_at   | TIMESTAMP    | 作成日時                   |
| updated_at   | TIMESTAMP    | 更新日時                   |

### 1-4. todos テーブル

| カラム名     | 型           | 備考                       |
|--------------|--------------|----------------------------|
| id           | BIGINT       | PK, AUTO_INCREMENT         |
| project_id   | BIGINT       | FK: projects.id            |
| title        | VARCHAR(255) | TODOタイトル               |
| description  | TEXT         | TODO内容                   |
| status       | ENUM         | 'pending', 'done'          |
| created_by   | BIGINT       | FK: users.id（作成者）     |
| created_at   | TIMESTAMP    | 作成日時                   |
| updated_at   | TIMESTAMP    | 更新日時                   |

---

## 2. 画面一覧

| 画面名             | 概要                                 |
|:-------------------|:-------------------------------------|
| ログイン画面       | ユーザー認証                         |
| ユーザー画面       | ユーザーを登録する画面                |
| プロジェクト一覧   | 所属プロジェクトの一覧表示           |
| プロジェクト作成   | 新規プロジェクト作成（管理者のみ）   |
| プロジェクト編集   | プロジェクト名編集、ユーザー追加     |
| TODO一覧           | プロジェクト内のTODOリスト表示       |
| TODO作成・編集     | TODOの追加・編集・削除               |

---

## 3. URL一覧

| URLパス                               | メソッド  | 画面/機能         | 備考                       |
|:--------------------------------------|:---------|:-----------------|:---------------------------|
| /login                                | GET/POST | ログイン          |                            |
| /logout                               | POST     | ログアウト        |                            |
| /register                             | POST     | ユーザー登録      |                            |
| /projects                             | GET      | プロジェクト一覧  |                            |
| /projects/create                      | GET/POST | プロジェクト作成  | 管理者のみ                 |
| /projects/{id}/edit                   | GET/POST | プロジェクト編集  | 管理者のみ                 |
| /projects/{id}/users/add              | POST     | ユーザー追加      | 管理者のみ                 |
| /projects/{id}/todos                  | GET      | TODO一覧         |                            |
| /projects/{id}/todos/create           | GET/POST | TODO作成         |                            |
| /projects/{id}/todos/{todo_id}/edit   | GET/POST | TODO編集         |                            |
| /projects/{id}/todos/{todo_id}/delete | POST     | TODO削除         |                            |

---

## 4. 備考

- プロジェクトのユーザーへの紐づけは管理者のみが実施できる
- ログイン後、必ず個人プロジェクトが1つ存在する（初回ログイン時自動作成）。
- 権限による画面・機能制御