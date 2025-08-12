# laravel-todo-app-practice

# 環境構築手順

## 前提条件

- Docker および Docker Compose がインストールされていること
- このリポジトリをクローン済みであること

## セットアップ手順

1. リポジトリをクローン

   ```sh
   git clone <リポジトリURL>
   cd laravel-todo-app-practice
   ```

2. `.env` ファイルの作成

   ```sh
   cp src/.env.example src/.env
   ```

3. Docker コンテナの起動

   ```sh
   docker-compose up -d
   ```

4. Composer 依存パッケージのインストール

   ```sh
   docker-compose exec php composer install
   ```

5. アプリケーションキーの生成

   ```sh
   docker-compose exec php php artisan key:generate
   ```

6. マイグレーションの実行

   ```sh
   docker-compose exec php php artisan migrate
   ```

7. アプリケーションへアクセス

   ブラウザで [http://localhost](http://localhost) にアクセスしてください。

## 補足

- MySQL の設定は [docker/mysql/my.cnf](docker/mysql/my.cnf) を参照してください。
- Nginx の設定は [docker/nginx/default.conf](docker/nginx/default.conf) を参照してください。
- PHP の設定は [docker/php/php.ini](docker/php/php.ini) を参照してください。
