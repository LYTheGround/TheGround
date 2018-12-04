@extends('layouts.admin.admin')
@section('page-title')
    edit
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h1>{{ $admin->user->login }}</h1>
            </div>
        </div>
        <div class="card-box">
            {{ Form::model($admin->user,['method' => 'PUT', 'url' => route('admin.update',compact('admin')),'enctype' => 'multipart/form-data' ]) }}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('email','E-mail : ',['class' => 'control-label']) }}
                        {{ Form::email('email',null,['class' => 'form-control','placeholder' => 'E-mail :','required']) }}
                        @if($errors->has('email'))
                            <span class="text-danger">
                                {{ $errors->first('email') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('login','login : ',['class' => 'control-label']) }}
                        {{ Form::text('login',null,['class' => 'form-control','placeholder' => 'login :','required']) }}
                        @if($errors->has('login'))
                            <span class="text-danger">
                                {{ $errors->first('login') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('city','Ville :',['class' => 'control-label']) }}
                        <select name="city" id="city" title="city" class="form-control">
                            @foreach($cities as $city)
                                <option
                                    value="{{ $city->id }}" {{ (old('city_id') == $city->id) ? 'selected' : '' }}>{{ $city->city }}</option>
                            @endforeach
                        </select>
                        @if($errors->has('city'))
                            <span class="text-danger">
                                {{ $errors->first('city') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="form-group">
                        {{ Form::label('password','Password : ',['class' => 'control-label']) }}
                        {{ Form::password('password',['class' => 'form-control','placeholder' => 'Password :']) }}
                        @if($errors->has('password'))
                            <span class="text-danger">
                                {{ $errors->first('password') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="form-group">
                        {{ Form::label('password_confirmation','Password : ',['class' => 'control-label']) }}
                        {{ Form::password('password_confirmation',['class' => 'form-control','placeholder' => 'password confirmation :']) }}
                        @if($errors->has('password_confirmation'))
                            <span class="text-danger">
                                {{ $errors->first('password_confirmation') }}
                            </span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 text-right">
                    <input type="submit" value="update" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
