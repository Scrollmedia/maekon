@extends('layouts.main')

@section('content')
 
 
@includeIf('pages.templates.' . $template, ['blocks' => $blocks])
 

@endsection