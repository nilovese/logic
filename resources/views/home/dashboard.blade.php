@extends('layout.layout')
@section('home')
<div class="jumbotron">
	<h1>Gagagugu Logic</h1>
	<p class="lead">{{ \Auth::user() }}</p>
	
</div>
@stop