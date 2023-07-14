@extends('errors::minimal')

@section('title', __('Server Error'))
@section('code', '500')
@section('message', $exception->getMessage() ?? __('Server Error'))
