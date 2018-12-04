@extends('layouts.app')
@section('page-title')
    {{ $unload->name }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h4 class="page-title">Unload</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="card-box">
                    <div class="mailview-content">
                        <div class="mailview-header">
                            <div class="row">
                                <div class="col-sm-9">
                                    <div class="text-ellipsis m-b-10">
                                        <span class="mail-view-title">{{ strtoupper($unload->name) }}</span>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="mail-view-action">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete"> <i class="fa fa-trash-o"></i></button>

                                            <a href="{{ route('unload.create') }}">
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="create"> <i class="fa fa-share"></i></button>
                                            </a>
                                            <a href="{{ route('unload.edit',compact('unload')) }}">
                                                <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="edit"> <i class="fa fa-reply"></i></button>
                                                </a>
                                        </div>
                                        <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Print"> <i class="fa fa-print"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="sender-info">
                                <div class="sender-img">
                                    <img width="40" alt="" src="{{ asset('img/user.jpg') }}" class="img-circle">
                                </div>
                                <div class="receiver-details pull-left">
                                    <span class="sender-name">{{ $unload->member->info->last_name . ' ' . $unload->member->info->first_name }} ({{ $unload->member->info->emails[0]->email }})</span>
                                    <span class="receiver-name"></span>
                                </div>
                                <div class="mail-sent-time">
                                    <span class="mail-time">18 Sep. 2017 9:42 AM</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        @if($unload->description)
                        <div class="mailview-inner">
                            <p>{{ $unload->description }}
                                <br> {{ $unload->member->info->last_name . ' ' . $unload->member->info->first_name  }}</p>
                        </div>
                            @endif
                    </div>
                    <div class="mail-attachments">
                        <p><i class="fa fa-paperclip"></i> 1 Attachments - <a href="#">View justify</a></p>
                        <ul class="attachments clearfix">
                            <li>
                                <div class="attach-file"><img src="{{ asset('img/placeholder.jpg') }}" alt="Attachment"></div>
                                <div class="attach-info"> <a href="#" class="attach-filename">{{ $unload->name }}</a>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="mailview-footer">
                        <div class="row">
                            <div class="col-sm-6 left-action">
                                <a href="{{ route('unload.create') }}">
                                    <button type="button" class="btn btn-default"><i class="fa fa-reply"></i> Create</button>
                                </a>
                                <a href="{{ route('unload.edit',compact('unload')) }}">
                                    <button type="button" class="btn btn-default"><i class="fa fa-share"></i> Edit</button>
                                </a>
                            </div>
                            <div class="col-sm-6 right-action">
                                <button type="button" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                <a href="#" data-toggle="modal"
                                   data-target="#delete-unload">
                                    <button type="button" class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="delete-unload" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h4 class="modal-title">Unload name: {{ $unload->name }}</h4>
                    </div>
                    <div class="modal-body card-box">
                        <p>Are you sure want to delete this?</p>
                        <div class="m-t-20"><a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                            <span
                                onclick="event.preventDefault();document.getElementById('delete-unload-form').submit()"
                                class="btn btn-danger">Delete</span>
                            {{ Form::open(['method' => 'delete', 'url' => route('unload.destroy',compact('unload')),'id' => 'delete-unload-form', 'style' => "display:none"  ]) }}
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
