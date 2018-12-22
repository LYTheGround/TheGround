@extends('layouts.app')
@section('page-title')
    notifications
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-sm-7">
                <h4 class="page-title">Activities</h4>
            </div>
            <div class="col-xs-5 m-b-5 text-right">
                @if(isset(auth()->user()->notifications[0]))
                    <a href="#" data-toggle="modal"
                       data-target="#delete_notif" class="btn btn-danger">
                        <i class="fa fa-trash"></i> Vider tous
                    </a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="activity">
                    <div class="activity-box">
                        <ul class="activity-list">
                            @if(isset(auth()->user()->notifications[0]))
                                @foreach(auth()->user()->notifications  as $notification)
                                    <li>
                                        <div class="activity-user">
                                            <a href="#" title="{{ $notification->data['name'] }}" data-toggle="tooltip"
                                               class="avatar">
                                                @if(isset($notification->data['img']))
                                                    <img alt="{{ $notification->data['name'] }}"
                                                         src="{{ asset('storage' . $notification->data['img']) }}"
                                                         class="img-responsive img-circle">
                                                @else
                                                    <span
                                                        class="img-responsive img-circle">{{ substr($notification->data['name'],0,1) }}</span>
                                                @endif
                                            </a>
                                        </div>
                                        <div class="activity-content">
                                            <div class="timeline-content">
                                                <a href="#"
                                                   class="name">{{ $notification->data['name'] }}</a> {{ $notification->data['task'] }}
                                                <a href="{{ (!is_null($notification->data['url'])) ? $notification->data['url'] : '#' }}">{{ $notification->data['msg'] }}</a>
                                                <span
                                                    class="time">{{ \Carbon\Carbon::parse($notification->created_at)->format('d/m/y à H:i:s') }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            @else
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ auth()->user()->member->name }}" data-toggle="tooltip"
                                           class="avatar">
                                            <span
                                                class="img-responsive img-circle">{{ substr(auth()->user()->member->name ,0,1) }}</span>
                                        </a>
                                    </div>
                                    <div class="activity-content m-t-10">
                                        <div class="timeline-content">
                                            {{ 'Aucune notification pour le moment veuillez revenir plus tard ' }}
                                        </div>
                                    </div>
                                </li>
                            @endif

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div id="delete_notif" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ __('validation.attributes.delete')}}</h4>
                    </div>
                    <div class="modal-body card-box">
                        <p>{{ __('pages.diver.sure') }}</p>
                        <div class="m-t-20"><a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                            <span
                                onclick="event.preventDefault();document.getElementById('{{ 'delete-provider'}}').submit()"
                                class="btn btn-danger">Delete</span>
                            <form action="{{route('notification.destroy')}}" method="POST"
                                  id="{{ 'delete-provider'}}">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
