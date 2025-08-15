# TODOアプリ設計ドキュメント

## 1. DB設計

### users テーブル（Fortify対応）

| カラム名           | 型           | 属性           | 説明                       |
|:------------------|:-------------|:---------------|:---------------------------|
| id                | BIGINT       | PK, AUTO_INC   | ユーザーID                 |
| name              | VARCHAR(255) | NOT NULL       | ユーザー名                 |
| email             | VARCHAR(255) | UNIQUE, NOT NULL | メールアドレス           |
| email_verified_at | TIMESTAMP    | NULL           | メール認証日時             |
| password          | VARCHAR(255) | NOT NULL       | パスワード(ハッシュ)       |
| is_admin          | BOOLEAN      | DEFAULT FALSE  | 管理者フラグ               |
| remember_token    | VARCHAR(100) | NULL           | ログイン状態保持用トークン |
| created_at        | TIMESTAMP    |                | 作成日時                   |
| updated_at        | TIMESTAMP    |                | 更新日時                   |

※2要素認証やパスワードリセット用のテーブル・カラムもFortifyで追加されますが、基本的な認証のみであれば上記で十分です。

他のテーブル設計はそのままで問題ありません。

### projects テーブル
| カラム名      | 型           | 属性           | 説明             |
|:-------------|:-------------|:---------------|:-----------------|
| id           | BIGINT       | PK, AUTO_INC   | プロジェクトID   |
| name         | VARCHAR(255) | NOT NULL       | プロジェクト名   |
| owner_id     | BIGINT       | FK(users.id)   | 作成者ユーザーID |
| created_at   | TIMESTAMP    |                | 作成日時         |
| updated_at   | TIMESTAMP    |                | 更新日時         |

### project_user テーブル（プロジェクトとユーザーの中間テーブル）
| カラム名      | 型           | 属性           | 説明             |
|:-------------|:-------------|:---------------|:-----------------|
| id           | BIGINT       | PK, AUTO_INC   | ID               |
| project_id   | BIGINT       | FK(projects.id)| プロジェクトID   |
| user_id      | BIGINT       | FK(users.id)   | ユーザーID       |
| created_at   | TIMESTAMP    |                | 作成日時         |

### todos テーブル
| カラム名      | 型           | 属性           | 説明             |
|:-------------|:-------------|:---------------|:-----------------|
| id           | BIGINT       | PK, AUTO_INC   | TODO ID          |
| project_id   | BIGINT       | FK(projects.id)| プロジェクトID   |
| title        | VARCHAR(255) | NOT NULL       | タイトル         |
| description  | TEXT         |                | 詳細             |
| status       | VARCHAR(50)  | DEFAULT 'open' | 状態(open/closed)|
| created_by   | BIGINT       | FK(users.id)   | 作成ユーザーID   |
| created_at   | TIMESTAMP    |                | 作成日時         |
| updated_at   | TIMESTAMP    |                | 更新日時         |

---

## 2. 画面一覧

| 画面名             | 概要                                 |
|:-------------------|:-------------------------------------|
| ログイン画面       | ユーザー認証                         |
| プロジェクト一覧   | 所属プロジェクトの一覧表示           |
| プロジェクト作成   | 新規プロジェクト作成（管理者のみ）   |
| プロジェクト編集   | プロジェクト名編集、ユーザー追加     |
| TODO一覧           | プロジェクト内のTODOリスト表示       |
| TODO作成・編集     | TODOの追加・編集・削除               |

---

## 3. URL一覧

| URLパス                        | メソッド | 画面/機能           | 備考                       |
|:-------------------------------|:---------|:---------------------|:---------------------------|
| /login                         | GET/POST | ログイン             |                            |
| /logout                        | POST     | ログアウト           |                            |
| /projects                      | GET      | プロジェクト一覧     |                            |
| /projects/create               | GET/POST | プロジェクト作成     | 管理者のみ                 |
| /projects/{id}/edit            | GET/POST | プロジェクト編集     | 管理者のみ                 |
| /projects/{id}/users/add       | POST     | ユーザー追加         | 管理者のみ                 |
| /projects/{id}/todos           | GET      | TODO一覧             |                            |
| /projects/{id}/todos/create    | GET/POST | TODO作成             |                            |
| /projects/{id}/todos/{todo_id}/edit | GET/POST | TODO編集         |                            |
| /projects/{id}/todos/{todo_id}/delete | POST | TODO削除         |                            |

---

## 4. 備考

- ユーザー登録は管理者のみが行う想定（一般ユーザーは招待制）。
- ログイン後、必ず個人プロジェクトが1つ存在する（初回ログイン時自動作成）。
- 権限による画面・機能制御