@extends('layouts.app')
@section('page-title')
    Echeance
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4>Echeance</h4>
            </div>
        </div>
        <div class="row card-box">
            <div class="row card-title">
                <div class="col-xs-12 text-right m-b-5">
                    <span class="text-dark">Prix TTC : </span>
                    <span class="label label-success-border">{{ $echeance->prince }}</span>
                </div>
            </div>
            {{ Form::model($echeance,['method' => 'PUT', 'url' => route('echeance.update',compact('echeance'))]) }}
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        {{ Form::label('date','Date :',['class' => 'label-control']) }}
                        <div class="input-group">
                            <div class="input-group-addon" id="sizing-addon2">
                                <i class="fa fa-calendar"></i>
                            </div>
                            {{ Form::date('date',(old('date')) ?: gmdate('Y-m-d'),['class' => 'form-control', 'placeholder' => gmdate('d-m-Y'), 'required']) }}
                        </div>
                        @if($errors->has('date'))
                            <span class="text-danger">{{ $errors->first('date') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="form-group text-right">
                        {{ Form::submit(__('validation.attributes.edit'),['class' => 'btn btn-primary']) }}
                    </div>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
