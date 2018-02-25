@extends('layouts.app')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    <example-component />

    <ul>
      <li v-for="item in items">
        @{{ item.message }}
      </li>
    </ul>

    <p>You have role admin</p>
    <p>You have role saler</p>
    <p>You have role customer</p>


    <p>You are logged in!</p>
@stop