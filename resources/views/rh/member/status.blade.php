@extends('layouts.app')
@section('page-title')
    {{ ucfirst(__('validation.attributes.status')) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="card-box">
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
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#edit_status">
                            <i class="fa fa-edit"></i> {{ __('validation.attributes.edit') }}
                        </a>
                    </div>
                </div>
                <div id="edit_status" class="modal custom-modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content modal-md">
                            <div class="modal-header">
                                <h4 class="modal-title">{{ __('validation.attributes.status') }} : </h4>
                            </div>
                            <div class="modal-body card-box">
                                <p>Vous être sûr ?</p>
                                {!!  __('pages.rh.user.status.modal_update') !!}
                                <div class="m-t-20"><a href="#" class="btn btn-default" data-dismiss="modal">{{ __('validation.attributes.close') }}</a>
                                    <input type="submit" class="btn btn-danger" value="{{ __('validation.attributes.edit') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop
