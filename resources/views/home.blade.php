@extends('layouts.app')
@section('title', 'Сказокнет отзывы без иллюзий')

@section('content')
    @include('index.head_background')
    @include('index.complexes')
    @include('index.property_developers')
    @include('index.comments')


    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- Sidebar -->

@endsection
