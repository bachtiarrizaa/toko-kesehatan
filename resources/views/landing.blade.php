@extends('layouts.main')

@section('container')
    @include('components.heroes')
    {{-- @include('components.category') --}}
    @include('components.product')
    @include('components.contact')
    @include('components.footer')
@endsection