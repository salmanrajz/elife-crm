@extends('errors::minimal')
@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
{{-- <a href="{{route('home')}}">Click here and go home</a> --}}
{{-- <script>window.location = "/home";</script> --}}
