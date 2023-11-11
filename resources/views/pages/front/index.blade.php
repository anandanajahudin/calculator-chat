@extends('layouts.front')

@section('title', 'Index')

@section('content')

    @include('layouts.components.front.navbar')

    @include('layouts.components.front.hero')
    @include('pages.front.service')
    @include('pages.front.about')
    @include('pages.front.team')
    @include('pages.front.contact')

@endsection
