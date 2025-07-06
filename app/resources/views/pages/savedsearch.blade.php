@extends('layouts.master')
@section('content')
@livewire('saved-search',['slug' => $slug])
@endsection
