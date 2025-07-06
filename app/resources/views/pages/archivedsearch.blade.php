@extends('layouts.master')
@section('content')
@livewire('archived-search',['slug' => $slug])
@endsection
