@extends('layouts.admin.admin')
@section('page-title')
    Sold
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            {{ Form::open(['method' => 'PUT', 'url' => route('company.updateSold',compact('company'))]) }}
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        {{ Form::label('sold','Sold :',['class' => 'control-label']) }}
                        {{ Form::number('sold',null,['class'=> 'form-control','placeholder' => 'Sold :', 'required']) }}
                    </div>
                </div>
                <div class="col-xs-12 text-right">
                    <input type="submit" value="Add" class="btn btn-primary">
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
