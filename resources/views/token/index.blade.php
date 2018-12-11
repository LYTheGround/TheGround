@extends('layouts.app')
@section('page-title')
{{ ucfirst(__('validation.attributes.token')) }}
@stop
@section('content')
<div class="content container-fluid">
    <div class="row">
        <div class="col-xs-7">
            <h4 class="page-title">{{ ucfirst(__('validation.attributes.token'))}}</h4>
        </div>
        <div class="col-xs-5 text-right m-b-30">
            @can('token', auth()->user()->member)
                <a href="{{ route('token.create') }}" class="btn btn-success rounded"><i class="fa fa-plus"></i> {{ __('validation.attributes.create') }}</a>
            @endcan
        </div>
    </div>
    <div class="card-box">

        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table">
                        <thead>
                        <tr>
                            <th>{{ ucfirst(__('validation.attributes.token')) }}</th>
                            <th>{{ ucfirst(__('validation.attributes.category')) }}</th>
                            <th>{{ ucfirst(__('pages.rh.user.range.range')) }}</th>
                            <th class="text-right">{{ ucfirst(__('validation.attributes.action')) }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($tokens as $token)
                            <tr>
                                <td>{{ $token->token }}</td>
                                <td>{{ $token->category->category }}</td>
                                <td>{{ $token->range }}</td>
                                <td class="text-right">
                                    <div class="dropdown">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                           aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a href="#" data-toggle="modal" data-target="#delete_token{{$token->id}}"><i
                                                        class="fa fa-trash-o m-r-5"></i> {{ ucfirst(__('validation.attributes.delete')) }}</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @foreach($tokens as $token)
    <div id="delete_token{{ $token->id }}" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('validation.attributes.delete') }}</h4>
                </div>
                <div class="modal-body card-box">
                    <p>{{ __('pages.diver.sure') }}</p>
                    <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                        <span onclick="event.preventDefault();document.getElementById('{{ 'delete-token-' . $token->id }}').submit()" class="btn btn-danger">{{ ucfirst(__('validation.attributes.delete')) }}</span>
                        <form id="delete-token-{{$token->id}}" action="{{ route('token.destroy',compact('token')) }}" method="POST" style="display: none;">
                            @csrf
                            @method('delete')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@stop
