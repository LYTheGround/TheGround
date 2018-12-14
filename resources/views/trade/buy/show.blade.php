@extends('layouts.app')
@section('page-title')
    {{ $buy->slug }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h3>{{ $buy->slug }}</h3>
            </div>
            @can('delete',$buy)
                <div class="col-xs-5 text-right">
                    <a href="#" data-toggle="modal" data-target="#delete_buy" class="btn btn-danger"><i
                            class="fa fa-trash-o m-r-5"></i> Delete</a>
                </div>
            @endcan
        </div>
        <div class="row">
            <div class="col-md-6 panel activity-panel">
                <div class="panel-heading">
                    <div class="col-xs-12">
                        <div class="col-xs-7">
                            <h4 class="text-center">{{ ucfirst(__('validation.attributes.activity')) }}</h4>
                            <p class="m-b-5">{{ __('validation.attributes.progress') }} <span
                                    class="text-success pull-right">{{ $tasks->progress }}
                                    %</span></p>
                            <div class="progress progress-xs m-b-0">
                                <div class="progress-bar progress-bar-success" role="progressbar" data-toggle="tooltip"
                                     title="{{ $tasks->progress }}%" style="width: {{ $tasks->progress }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="activity-box">
                        <ul class="activity-list">
                            @if($buy->trade_action->bc)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $buy->trade_action->bc_member->info->last_name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $buy->trade_action->bc_member->info->last_name }}"
                                                 src="{{ ($buy->trade_action->bc_member->info->face) ? asset('storage/' . $buy->trade_action->bc_member->info->face) : asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $buy->trade_action->bc_member->name }}</a>
                                            {{ __('validation.attributes.buy_bc_task') }}
                                            <span
                                                class="time">{{ __('validation.attributes.tasks_time',['date' => \Carbon\Carbon::parse($buy->trade_action->bc_time)->format('d-m'),'hour' => \Carbon\Carbon::parse($buy->trade_action->bc_time)->format('H'),'min' => \Carbon\Carbon::parse($buy->trade_action->bc_time)->format('m')]) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($buy->trade_action->dv)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $buy->trade_action->dv_member->info->last_name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $buy->trade_action->dv_member->info->last_name }}"
                                                 src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#"
                                               class="name">{{ $buy->trade_action->dv_member->name }}</a> {{ __('validation.attributes.buy_dv_task') }}
                                            <span class="time">{{ __('validation.attributes.tasks_time',[
                                            'date' => \Carbon\Carbon::parse($buy->trade_action->dv_time)->format('d-m'),
                                            'hour' => \Carbon\Carbon::parse($buy->trade_action->dv_time)->format('H'),
                                            'min' => \Carbon\Carbon::parse($buy->trade_action->dv_time)->format('m')
                                            ]) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($buy->trade_action->done)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $buy->trade_action->done_member->info->last_name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $buy->trade_action->done_member->info->last_name }}"
                                                 src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#"
                                               class="name">{{ $buy->trade_action->done_member->name }}</a> {{ __('validation.attributes.buy_done_task') }}
                                            <span class="time">{{ __('validation.attributes.tasks_time',[
                                            'date' => \Carbon\Carbon::parse($buy->trade_action->done_time)->format('d-m'),
                                            'hour' => \Carbon\Carbon::parse($buy->trade_action->done_time)->format('H'),
                                            'min' => \Carbon\Carbon::parse($buy->trade_action->done_time)->format('m')
                                            ]) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($buy->trade_action->delivery)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $buy->trade_action->delivery_member->info->last_name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $buy->trade_action->delivery_member->info->last_name }}"
                                                 src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $buy->trade_action->delivery_member->name }}</a>
                                            {{ __('validation.attributes.buy_delivery_task') }}
                                            <span class="time">{{ __('validation.attributes.tasks_time',[
                                            'date' => \Carbon\Carbon::parse($buy->trade_action->delivery_time)->format('d-m'),
                                            'hour' => \Carbon\Carbon::parse($buy->trade_action->delivery_time)->format('H'),
                                            'min' => \Carbon\Carbon::parse($buy->trade_action->delivery_time)->format('m')
                                            ]) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($buy->trade_action->store)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $buy->trade_action->store_member->info->last_name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $buy->trade_action->store_member->info->last_name }}"
                                                 src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $buy->trade_action->store_member->name }}</a>
                                            {{ __('validation.attributes.buy_store_task') }}
                                            <span class="time">{{ __('validation.attributes.tasks_time',[
                                            'date' => \Carbon\Carbon::parse($buy->trade_action->store_time)->format('d-m'),
                                            'hour' => \Carbon\Carbon::parse($buy->trade_action->store_time)->format('H'),
                                            'min' => \Carbon\Carbon::parse($buy->trade_action->store_time)->format('m')
                                            ]) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($buy->trade_action->bl)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $buy->trade_action->bl_member->info->last_name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $buy->trade_action->bl_member->info->last_name }}"
                                                 src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $buy->trade_action->bl_member->name }}</a>
                                            {{ __('validation.attributes.buy_bl_task') }}
                                            <span class="time">{{ __('validation.attributes.tasks_time',[
                                            'date' => \Carbon\Carbon::parse($buy->trade_action->bl_time)->format('d-m'),
                                            'hour' => \Carbon\Carbon::parse($buy->trade_action->bl_time)->format('H'),
                                            'min' => \Carbon\Carbon::parse($buy->trade_action->bl_time)->format('m')
                                            ]) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($buy->trade_action->fc)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $buy->trade_action->fc_member->info->last_name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $buy->trade_action->fc_member->info->last_name }}"
                                                 src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $buy->trade_action->fc_member->name }}</a>
                                            {{ __('validation.attributes.buy_fc_task') }}
                                            <span class="time">{{ __('validation.attributes.tasks_time',[
                                            'date' => \Carbon\Carbon::parse($buy->trade_action->fc_time)->format('d-m'),
                                            'hour' => \Carbon\Carbon::parse($buy->trade_action->fc_time)->format('H'),
                                            'min' => \Carbon\Carbon::parse($buy->trade_action->fc_time)->format('m')
                                            ]) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                @if($tasks->next != null)
                    <div class="panel-footer text-right bg-white">
                        <a href="{{ $tasks->next->url }}" class="btn-success btn">{{ $tasks->next->name }}</a>
                    </div>
                @endif
            </div>
            @if($buy->trade_action->store)
                <div class="col-md-6">
                    <div class="col-xs-6 card-box">
                        @if(!$buy->trade_action->bl)
                            {{ Form::open(['method' => 'POST', 'url' => route('buy.bl',compact('buy')), 'enctype'=>"multipart/form-data"]) }}
                            <div class="row m-b-0">
                                <div class="form-group text-center">
                                    <div class="wrap-custom-file">
                                        <input type="file" name="bl" id="bl" accept=".gif, .jpg, .png" required/>
                                        <label for="bl" class="covimgs"
                                               style="background-image: url({{ asset('img/placeholder.jpg') }})">
                                            <span>{{ __('pages.trade.buy.dv.bl.select')}}</span>
                                            <i class="fa fa-plus-circle"></i>
                                        </label>
                                    </div>
                                    <div>
                                        @if($errors->has('bl'))
                                            <span class="text-danger">{{ $errors->first('bl') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    {{ Form::submit(__('validation.attributes.upload'),['class' => 'btn btn-primary']) }}
                                </div>
                            </div>
                            {{ Form::close() }}
                        @else
                            <div class="row">
                                {{ Form::open(['method' => 'delete', 'url' => route('buy.bl.destroy',compact('buy'))]) }}
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group text-right">
                                            {{ Form::submit(__('validation.attributes.delete'),['class' => 'btn btn-danger']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <a href="{{ asset('storage/' . $buy->trade_action->bl) }}"
                                           title="{{ __('validation.attributes.bl') }}">
                                            <img src="{{ asset('storage/' . $buy->trade_action->bl) }}"
                                                 class="col-xs-12" alt="{{ __('validation.attributes.bl') }}">
                                        </a>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        @endif
                    </div>
                    <div class="col-xs-6 card-box">
                        @if(!$buy->trade_action->fc)
                            {{ Form::open(['method' => 'POST', 'url' => route('buy.fc',compact('buy')), 'enctype'=>"multipart/form-data"]) }}
                            <div class="row m-b-0">
                                <div class="form-group text-center">
                                    <div class="wrap-custom-file">
                                        <input type="file" name="fc" id="fc" accept=".gif, .jpg, .png" required/>
                                        <label for="fc" class="covimgs"
                                               style="background-image: url({{ asset('img/placeholder.jpg') }})">
                                            <span>{{ __('pages.trade.buy.dv.fc.select')}}</span>
                                            <i class="fa fa-plus-circle"></i>
                                        </label>
                                    </div>
                                    <div>
                                        @if($errors->has('fc'))
                                            <span class="text-danger">{{ $errors->first('fc') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    {{ Form::submit(__('validation.attributes.upload'),['class' => 'btn btn-primary']) }}
                                </div>
                            </div>
                            {{ Form::close() }}
                        @else
                            <div class="row">
                                {{ Form::open(['method' => 'delete', 'url' => route('buy.fc.destroy',compact('buy'))]) }}
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group text-right">
                                            {{ Form::submit(__('validation.attributes.delete'),['class' => 'btn btn-danger']) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 text-center">
                                        <a href="{{ asset('storage/' . $buy->trade_action->fc) }}"
                                           title="{{ __('validation.attributes.fc') }}">
                                            <img src="{{ asset('storage/' . $buy->trade_action->fc) }}"
                                                 class="col-xs-12" alt="{{ __('validation.attributes.fc') }}">
                                        </a>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        @endif
                    </div>
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-6 card-box">
                <div class="row">
                    <div class="col-xs-7">
                        <h4>{{ ucfirst(__('validation.attributes.bc')) }}</h4>
                    </div>
                    @if(!$buy->trade_action->bc)
                        <div class="col-xs-5 text-right">
                            <a href="{{ route('bc.create',compact('buy')) }}" class="btn btn-success">update</a>
                            @if(isset($buy->bcs[0]))
                                <a href="{{ route('buy.bc.confirm',compact('buy')) }}"
                                   class="btn btn-primary m-b-5">confirm</a>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="row">
                    <table class="table table-striped custom-table">
                        <thead>
                        <tr>
                            <th>product</th>
                            <th>REF</th>
                            <th class="text-right">Qt</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($buy->bcs as $bc)
                            <tr>
                                <td><a href="#">{{ $bc->product->name }}</a></td>
                                <td><a href="#">{{ $bc->product->ref }}</a></td>
                                <td class="text-right">{{ $bc->qt }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6 card-box">
                <div class="row">
                    <div class="col-xs-7">
                        <h4>{{ ucfirst(__('validation.attributes.dvs')) }}</h4>
                    </div>
                    @if(($buy->trade_action->bc) && (!$buy->trade_action->dv))
                        <div class="col-xs-5 text-right">
                            <a href="{{ route('dv.create',compact('buy')) }}"
                               class="btn btn-success m-b-5">{{ ucfirst(__('validation.attributes.add')) }}</a>
                            @if(isset($buy->dvs[0]))
                                <a href="{{ route('buy.dv.confirm',compact('buy')) }}"
                                   class="btn btn-primary m-b-5">{{ ucfirst(__('validation.attributes.confirm')) }}</a>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="row">
                    <table class="table table-striped custom-table">
                        <thead>
                        <tr>
                            <th>{{ ucfirst(__('pages.deal.provider.index.title')) }}</th>
                            <th>{{ ucfirst(__('validation.attributes.dv')) }}</th>
                            <th>{{ strtoupper(__('validation.attributes.ttc')) }}</th>
                            <th>{{ ucfirst(__('validation.attributes.selected')) }}</th>
                            @if(!$buy->trade_action->dv)
                                <th class="text-right">{{ ucfirst(__('validation.attributes.action')) }}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($buy->dvs as $dv)
                            <tr>
                                <td>
                                    <span class="avatar">{{ substr($dv->provider->info_box->name,0,1) }}</span>
                                    <a href="#">{{ $dv->provider->info_box->name }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('dv.show',compact('buy','dv')) }}">{{ $dv->slug }}</a>
                                </td>
                                <td>{{ $dv->ttc }}</td>
                                <td>{{ ($dv->selected) ? 'selected' : 'null' }}</td>

                                @if(!$buy->trade_action->dv)
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="{{ route('buy.dv.selected',['buy' => $buy, 'dv' => $dv]) }}"><i
                                                            class="fa fa-hand-o-left m-r-5"></i> {{ __('validation.attributes.selected') }}
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" onclick="event.preventDefault();
                                                        document.getElementById('{{ 'delete-dv-' . $dv->id }}').submit();"><i
                                                            class="fa fa-trash-o m-r-5"></i> {{ __('validation.attributes.delete') }}
                                                    </a>
                                                    {{ Form::open(['method'=>'DELETE','url'=>route('dv.destroy',compact('buy','dv')),'id' => "delete-dv-$dv->id",'style'=>"display:none;"]) }}
                                                    {{ Form::close() }}
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div id="delete_buy" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content modal-md">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $buy->slug}}</h4>
                    </div>
                    <div class="modal-body card-box">
                        <p>{{ __('pages.diver.sure') }}</p>
                        {!! __('pages.trade.buy.delete.modal_delete') !!}
                        <div class="m-t-20"><a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                            <span onclick="event.preventDefault();document.getElementById('delete-buy').submit()"
                                  class="btn btn-danger">{{ __('validation.attributes.delete') }}</span>
                            <form action="{{route('buy.destroy',compact('buy'))}}" method="POST" id="delete-buy">
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
