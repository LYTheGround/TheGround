@extends('layouts.app')
@section('page-title')
    Create Token
@stop
@section('content')
    <div class="content container-fluid">
        <div class="card-box">
            <div class="card-title">
                <h4>Create Token</h4>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    {{ Form::open(['method' => 'POST', 'url' => route('token.store'), 'class' => 'form-horizontal']) }}
                    <div class="row">
                        <div class="form-group">
                            <div class="col-md-6">
                                {{ Form::label('category','Category',['class' => 'label-control']) }}
                                <select name="category" id="category" title="category" class="form-control" required>
                                    <option value="3" {{ (old('category') == '3') ? 'selected' : '' }}>manager</option>
                                    <option value="4" {{ (old('category') == '4') ? 'selected' : '' }}>accounting
                                    </option>
                                    <option value="5" {{ (old('category') == '5') ? 'selected' : '' }}>commercial
                                    </option>
                                    <option value="6" {{ (old('category') == '6') ? 'selected' : '' }}>delivery</option>
                                    <option value="7" {{ (old('category') == '7') ? 'selected' : '' }}>storekeeper
                                    </option>
                                </select>
                                @if($errors->has('category'))
                                    <span class="text-danger">{{ $errors->first('category') }}</span>
                                @endif
                            </div>
                            <div class="col-md-6">
                                {{ Form::label('range','Range:',['class'=>'label-form']) }}
                                {{ Form::number('range',null,['class'=>'form-control','min'=>'1','required']) }}
                                @if($errors->has('range'))
                                    <span class="text-danger">{{ $errors->first('range') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group text-right">
                            <div class="col-xs-12">
                                {{ Form::submit('Create',['class'=>'btn btn-success']) }}
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
