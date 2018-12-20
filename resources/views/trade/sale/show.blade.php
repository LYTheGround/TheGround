@extends('layouts.app')
@section('page-title')
    {{ $sale->slug }}
@stop

@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h3>{{ $sale->slug }}</h3>
            </div>
            <div class="col-xs-5 text-right">
                @can('delete',$sale)
                    <a href="#" data-toggle="modal" data-target="#delete_sale" class="btn btn-danger"><i
                            class="fa fa-trash-o m-r-5"></i> {{ ucfirst(__('validation.attributes.delete')) }}</a>
                    <form id="delete-sale-{{ $sale->id }}" method="post"
                          action="{{route('sale.destroy', compact('sale')) }}">
                        {!! method_field('delete') !!}
                        {!! csrf_field() !!}
                    </form>
                @endcan
                @can('bl',$sale)
                    <a href="{{ route('sale.show',compact('sale')) . '/tasks/bl' }}" class="btn btn-primary">{{ ucfirst(__('validation.attributes.bc')) }}</a>
                @endcan
                @can('fc',$sale)
                    <a href="{{ route('sale.show',compact('sale')) . '/tasks/fc' }}" class="btn btn-danger">{{ ucfirst(__('validation.attributes.fc')) }}</a>
                @endcan
            </div>

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
                            @if($sale->trade_action->bc)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $sale->trade_action->bc_member->info->last_name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $sale->trade_action->bc_member->info->last_name }}"
                                                 src="{{ ($sale->trade_action->bc_member->info->face) ? asset('storage/' . $sale->trade_action->bc_member->info->face) : asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $sale->trade_action->bc_member->name }}</a>
                                            {{ __('validation.attributes.buy_bc_task') }}
                                            <span
                                                class="time">{{ __('validation.attributes.tasks_time',['date' => \Carbon\Carbon::parse($sale->trade_action->bc_time)->format('d-m'),'hour' => \Carbon\Carbon::parse($sale->trade_action->bc_time)->format('H'),'min' => \Carbon\Carbon::parse($sale->trade_action->bc_time)->format('m')]) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($sale->trade_action->dv)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $sale->trade_action->dv_member->info->last_name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $sale->trade_action->dv_member->info->last_name }}"
                                                 src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#"
                                               class="name">{{ $sale->trade_action->dv_member->name }}</a> {{ __('validation.attributes.buy_dv_task') }}
                                            <span class="time">{{ __('validation.attributes.tasks_time',[
                                            'date' => \Carbon\Carbon::parse($sale->trade_action->dv_time)->format('d-m'),
                                            'hour' => \Carbon\Carbon::parse($sale->trade_action->dv_time)->format('H'),
                                            'min' => \Carbon\Carbon::parse($sale->trade_action->dv_time)->format('m')
                                            ]) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($sale->trade_action->done)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $sale->trade_action->done_member->info->last_name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $sale->trade_action->done_member->info->last_name }}"
                                                 src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#"
                                               class="name">{{ $sale->trade_action->done_member->name }}</a> {{ __('validation.attributes.buy_done_task') }}
                                            <span class="time">{{ __('validation.attributes.tasks_time',[
                                            'date' => \Carbon\Carbon::parse($sale->trade_action->done_time)->format('d-m'),
                                            'hour' => \Carbon\Carbon::parse($sale->trade_action->done_time)->format('H'),
                                            'min' => \Carbon\Carbon::parse($sale->trade_action->done_time)->format('m')
                                            ]) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($sale->trade_action->delivery)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $sale->trade_action->delivery_member->info->last_name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $sale->trade_action->delivery_member->info->last_name }}"
                                                 src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#"
                                               class="name">{{ $sale->trade_action->delivery_member->name }}</a>
                                            {{ __('validation.attributes.buy_delivery_task') }}
                                            <span class="time">{{ __('validation.attributes.tasks_time',[
                                            'date' => \Carbon\Carbon::parse($sale->trade_action->delivery_time)->format('d-m'),
                                            'hour' => \Carbon\Carbon::parse($sale->trade_action->delivery_time)->format('H'),
                                            'min' => \Carbon\Carbon::parse($sale->trade_action->delivery_time)->format('m')
                                            ]) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($sale->trade_action->store)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $sale->trade_action->store_member->info->last_name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $sale->trade_action->store_member->info->last_name }}"
                                                 src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $sale->trade_action->store_member->name }}</a>
                                            {{ __('validation.attributes.buy_store_task') }}
                                            <span class="time">{{ __('validation.attributes.tasks_time',[
                                            'date' => \Carbon\Carbon::parse($sale->trade_action->store_time)->format('d-m'),
                                            'hour' => \Carbon\Carbon::parse($sale->trade_action->store_time)->format('H'),
                                            'min' => \Carbon\Carbon::parse($sale->trade_action->store_time)->format('m')
                                            ]) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($sale->trade_action->bl)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $sale->trade_action->bl_member->info->last_name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $sale->trade_action->bl_member->info->last_name }}"
                                                 src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $sale->trade_action->bl_member->name }}</a>
                                            {{ __('validation.attributes.buy_bl_task') }}
                                            <span class="time">{{ __('validation.attributes.tasks_time',[
                                            'date' => \Carbon\Carbon::parse($sale->trade_action->bl_time)->format('d-m'),
                                            'hour' => \Carbon\Carbon::parse($sale->trade_action->bl_time)->format('H'),
                                            'min' => \Carbon\Carbon::parse($sale->trade_action->bl_time)->format('m')
                                            ]) }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($sale->trade_action->fc)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $sale->trade_action->fc_member->info->last_name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $sale->trade_action->fc_member->info->last_name }}"
                                                 src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $sale->trade_action->fc_member->name }}</a>
                                            {{ __('validation.attributes.buy_fc_task') }}
                                            <span class="time">{{ __('validation.attributes.tasks_time',[
                                            'date' => \Carbon\Carbon::parse($sale->trade_action->fc_time)->format('d-m'),
                                            'hour' => \Carbon\Carbon::parse($sale->trade_action->fc_time)->format('H'),
                                            'min' => \Carbon\Carbon::parse($sale->trade_action->fc_time)->format('m')
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
        </div>
        <div class="row">
            <div class="card-box">
                <div class="card-title">
                    <div class="col-xs-7">
                        <h4>{{ __('validation.attributes.bc') }}</h4>
                    </div>
                    <div class="col-xs-5 text-right">
                        @if(!$sale->trade_action->dv)
                            <a href="{{ route('sale_bc.create',compact('sale')) }}"
                               class="btn btn-success">{{ __('validation.attributes.edit') }}</a>
                            @if(isset($sale->bcs[0]))
                                <a href="{{ route('sale.bc.confirm',compact('sale')) }}"
                                   class="btn btn-primary">{{ __('validation.attributes.confirm') }}</a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row">
                    <table class="table table-striped custom-table">
                        <thead>
                        <tr>
                            <th>{{ ucfirst(__('validation.attributes.products')) }}</th>
                            <th>{{ strtoupper(__('validation.attributes.qt')) }}</th>
                            <th>{{ strtoupper(__('validation.attributes.ht')) }}</th>
                            <th>{{ strtoupper(__('validation.attributes.tva')) }}</th>
                            <th class="text-center">{{ strtoupper(__('validation.attributes.ttc')) }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if($sale->dv)
                            @foreach($sale->dv->orders as $order)
                                <tr>
                                    <td>{{ $order->bc->purchased->product->name }}</td>
                                    <td>{{ $order->bc->qt }}</td>
                                    <td>{{ $order->ht }}</td>
                                    <td>{{ $order->tva }}</td>
                                    <td class="text-center">{{ $order->ttc }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="2"
                                    class="bg-primary">{{ strtoupper(__('validation.attributes.total')) }}</td>
                                <td class="bg-warning">{{ $sale->ht }}</td>
                                <td class="bg-warning">{{ $sale->tva }}</td>
                                <td class="bg-danger text-center">{{ $sale->ttc }}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="delete_sale" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $sale->slug}}</h4>
                </div>
                <div class="modal-body card-box">
                    <p>{{ __('pages.diver.sure') }}</p>
                    {!! __('pages.trade.sale.delete.modal_delete') !!}
                    <div class="m-t-20"><a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                        <span onclick="event.preventDefault();document.getElementById('delete-sale').submit()"
                              class="btn btn-danger">{{ __('validation.attributes.delete') }}</span>
                        <form action="{{route('sale.destroy',compact('sale'))}}" method="POST" id="delete-sale">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
