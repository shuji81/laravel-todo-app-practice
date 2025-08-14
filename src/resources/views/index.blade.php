@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="todo__alert">
  <!-- メッセージ機能 -->
</div>

<div class="todo__content">
  <div class="todo__panel">
    <!-- TODO：ログイン後の画面は未作成で、勤怠アプリからもってきたhtmlをいれている。ここはプロジェクト一覧に変える予定 -->
    <form class="todo__button">
      <button class="todo__button-submit" type="submit">勤務開始</button>
    </form>
    <form class="todo__button">
      <button class="todo__button-submit" type="submit">勤務終了</button>
    </form>
  </div>
  <div class="todo-table">
    <table class="todo-table__inner">
      <tr class="todo-table__row">
        <th class="todo-table__header">名前</th>
        <th class="todo-table__header">開始時間</th>
        <th class="todo-table__header">終了時間</th>
      </tr>
      <tr class="todo-table__row">
        <td class="todo-table__item">サンプル太郎</td>
        <td class="todo-table__item">サンプル</td>
        <td class="todo-table__item">サンプル</td>
      </tr>
    </table>
  </div>
</div>
@endsection
