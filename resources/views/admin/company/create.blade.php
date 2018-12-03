@extends('layouts.app')
@section('page-title')
    Create
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h1>Create</h1>
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        {{ Form::label('brand','brand') }}
                        {{ Form::file('brand',null,['class' => 'form-control']) }}
                    </div>
                </div>
                
                <div class="form-group">
                    {{ Form::label('brand','brand') }}
                    {{ Form::text('brand',null,['class' => 'form-control']) }}
                </div>

            </div>
        </div>
    </div>
@stop
