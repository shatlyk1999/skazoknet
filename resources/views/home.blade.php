@extends('layouts.app')
@section('title', 'Сказокнет отзывы без иллюзий')

@section('content')
    @include('index.head_background')
    @include('index.complexes_residential')
    @include('index.complexes_hotel')
    @include('index.property_developers')
    @include('index.comments')

@endsection
