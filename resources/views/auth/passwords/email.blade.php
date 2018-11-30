@extends('layouts.guest')

@section('title_page')
    {{ __('pages.auth.pswr.email.title') }}
@stop
@section('content')

<div class="container">
    <h3 class="account-title">{{ __('pages.auth.pswr.email.title') }}</h3>
    <div class="account-box">
        <div class="account-wrapper">

            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="account-logo">
                <p>{{ __('pages.auth.pswr.email.text') }}</p>
            </div>
            {{ Form::open(['method'=>'POST','url'=>route('password.email') ]) }}
            <div class="form-group">
                <div class="form-focus">
                    {{ Form::label('email',__('validation.attributes.email'),['class'=>'control-label']) }}
                    {{ Form::email('email',null,['class'=> 'form-control floating','required','maxlength'=>'50','minlength' => '3']) }}
                </div>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>

            <div class="form-group text-center">
                <button class="btn btn-primary btn-block account-btn" type="submit">{{ __('pages.auth.pswr.email.btn') }}</button>
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
