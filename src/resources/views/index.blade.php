@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="todo__alert">
  <!-- メッセージ機能 -->
</div>

<div class="todo__content">
  <div class="todo-table">
    <table class="todo-table__inner">
      <tr class="todo-table__row">
        <th class="todo-table__header">プロジェクト名</th>
        <th class="todo-table__header">プロジェクト概要</th>
      </tr>
      <tr class="todo-table__row">
        <td class="todo-table__item">サンプルプロジェクト</td>
        <td class="todo-table__item">サンプルプロジェクトの概要</td>
      </tr>
    </table>
  </div>
</div>
@endsection
