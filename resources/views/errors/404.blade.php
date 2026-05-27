@php
    $hideFooter = true; 
@endphp
@extends('layouts.main')

@section('content')
 
 <section class="section-404">
      <img class="section-404__bg" src="../default.webp" alt="404 bg">
      <div class="section-404__container container mx-auto">
        <h1 class="section-404__title">404</h1>
        <p class="section-404__description" data-line-reveal>Страница недоступна или была удалена</p>
        <a href="/" class="btn btn--primary  btn--md section-404__btn">
          <div class="btn__label"> на главную </div>
        </a>
      </div>
    </section>
 
@endsection