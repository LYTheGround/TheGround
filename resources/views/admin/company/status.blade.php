@extends('layouts.admin.admin')
@section('page-title')
    Sold
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            {{ Form::open(['method' => 'PUT', 'url' => route('company.updateStatus',compact('company'))]) }}
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        {{ Form::label('status','Status :',['class' => 'control-label']) }}
                        <select name="status" id="status" title="status" class="form-control">
                            <option value="2" {{ ($company->premium->status->status == 'active') ? 'selected' : '' }}>active</option>
                            <option value="1" {{ ($company->premium->status->status == 'inactive') ? 'selected' : '' }}>inactive</option>
                            <option value="3" {{ ($company->premium->status->status == 'archived') ? 'selected' : '' }}>archived</option>
                        </select>
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
