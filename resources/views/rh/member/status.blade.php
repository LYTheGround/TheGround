@extends('layouts.app')
@section('page-title')
    status
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="card-box">
                <div class="card-title">
                    <h4>Status</h4>
                </div>
                {{ Form::open(['method' => 'PUT', 'url' => route('member.status.update',compact('member')),'class' => 'form-horizontal']) }}
                <div class="row">
                    <div class="form-group">
                        <div class="col-xs-12 m-b-30">
                            <label for="status" class="control-label">Status:</label>
                            <select name="status" id="status" class="form-control">
                                <option value="1" {{ ($member->premium->status->status == 'inactive') ? 'selected' : '' }}>inactiver</option>
                                <option value="2" {{ ($member->premium->status->status == 'active') ? 'selected' : '' }}>Activer</option>
                                <option value="3" {{ ($member->premium->status->status == 'archived') ? 'selected' : '' }}>Archiver</option>
                            </select>
                        </div>
                        @if($errors->has('status'))
                            <span class="error-box text-danger">{{ $errors->first('status') }}</span>
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
