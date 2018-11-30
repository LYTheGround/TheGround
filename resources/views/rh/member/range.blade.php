@extends('layouts.app')
@section('page-title')
    Range
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="card-box">
                <div class="card-title">
                    <h4>Range</h4>
                </div>
                {{ Form::open(['method' => 'PUT', 'url' => route('member.range.update',compact('member')),'class' => 'form-horizontal']) }}
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-12 m-b-30">
                            <label for="range" class="control-label">Range:</label>
                            <input type="number" name="range" value="{{ old('range') ?: '1' }}" id="range" class="form-control" placeholder="Range"
                                   min="1" required>
                        </div>
                        @if($errors->has('range'))
                            <span class="error-box text-danger">{{ $errors->first('range') }}</span>
                        @endif

                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-right">
                        <input type="submit" class="btn btn-primary" value="Change Range">
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
