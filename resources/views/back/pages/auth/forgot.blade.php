@extends('back.layouts.auth-layout')
@section('pageTitle', isset($pageTitle) ?$pageTitle : 'Esqueceu palavra-passe')
@section('content')

<div class="page page-center">
      <div class="container-tight py-4">
        <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark"><img src="{{\App\Models\Setting::find(1)->blog_logo}}" height="36" alt=""></a>
        </div>
        @livewire('author-forgot-form')
        <div class="text-center text-muted mt-3">
          Esqueci isso, <a href="{{route('author.login')}}">voltar </a> para tela de login.
        </div>
      </div>
    </div>

@endsection