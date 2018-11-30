@extends('layouts.app')
@section('page-title')
    Buy
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h3>Buy Show</h3>
            </div>
            <div class="col-xs-5 text-right">
                <a href="#" class="btn btn-danger"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 panel activity-panel">
                <div class="panel-heading">
                    <div class="col-xs-12">
                        <div class="col-xs-7">
                            <h4 class="text-center">Activities</h4>
                            <p class="m-b-5">Progress <span class="text-success pull-right">{{ $tasks->progress }}
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
                                        <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                            <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $buy->trade_action->bc_member->name }}</a> a
                                            fait le bon de commande
                                            <span class="time">4 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($buy->trade_action->dv)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                            <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $buy->trade_action->dv_member->name }}</a> a
                                            selectionner le devi
                                            <span class="time">4 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($buy->trade_action->done)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                            <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $buy->trade_action->done_member->name }}</a> a
                                            marquer l'achat
                                            <span class="time">4 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($buy->trade_action->delivery)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                            <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $buy->trade_action->done_member->name }}</a> a
                                            liverer
                                            <span class="time">4 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($buy->trade_action->store)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                            <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $buy->trade_action->done_member->name }}</a> a
                                            indiquer que les produits est dans le magazin
                                            <span class="time">4 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($buy->trade_action->bl)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                            <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $buy->trade_action->bl_member->name }}</a> a
                                            uploader le bon de livraison
                                            <span class="time">4 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                            @endif
                            @if($buy->trade_action->fc)
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="{{ $buy->trade_action->bl_member->name }}"
                                           data-toggle="tooltip" class="avatar">
                                            <img alt="{{ $buy->trade_action->bl_member->name }}"
                                                 src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">{{ $buy->trade_action->bl_member->name }}</a> a
                                            uploader la facture
                                            <span class="time">4 mins ago</span>
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
            @if($buy->trade_action->store && ($buy->trade_action->status != 'finish' ||$buy->trade_action->status != 'archived'))
            <div class="col-md-6">
                @if($buy->trade_action->bl)
                    <div class="card-box col-xs-6 text-center">
                        <a href="{{ asset('uploads/' . $buy->trade_action->bl) }}" target="_blank" class="btn btn-primary">Bl Show</a>
                    </div>
                    @else
                    <div class="card-box col-xs-6">
                        <label for="bl_">bl</label>
                        <input type="file" name="bl_" class="form-control">
                    </div>
                @endif
                @if($buy->trade_action->fc)
                        <div class="card-box col-xs-6 text-center">
                            <a href="{{ asset('uploads/' . $buy->trade_action->bl) }}" target="_blank" class="btn btn-primary">fc Show</a>
                        </div>
                    @else
                        <div class="card-box col-xs-6">
                            <label for="fc_">fc</label>
                            <input type="file" name="fc_" class="form-control">
                        </div>
                @endif
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-6 card-box">
                <div class="row">
                    <div class="col-xs-7">
                        <h4>BCs</h4>
                    </div>
                    @if(!$buy->trade_action->bc)
                        <div class="col-xs-5 text-right">
                            <a href="{{ route('bc.create',compact('buy')) }}" class="btn btn-success">update</a>
                            @if(isset($buy->bcs[0]))
                                <a href="{{ route('buy.bc.confirm',compact('buy')) }}"
                                   class="btn btn-primary">confirm</a>
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
                        <h4>DVs</h4>
                    </div>
                    @if(($buy->trade_action->bc) && (!$buy->trade_action->dv))
                        <div class="col-xs-5 text-right">
                            <a href="{{ route('dv.create',compact('buy')) }}" class="btn btn-success">Add</a>
                            @if(isset($buy->dvs[0]))
                                <a href="{{ route('buy.dv.confirm',compact('buy')) }}"
                                   class="btn btn-primary">Confirm</a>
                            @endif
                        </div>
                    @endif
                </div>
                <div class="row">
                    <table class="table table-striped custom-table">
                        <thead>
                        <tr>
                            <th>provider</th>
                            <th>ttc</th>
                            <th>selected</th>
                            @if(!$buy->trade_action->dv)
                                <th class="text-right">Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($buy->dvs as $dv)
                            <tr>
                                <td><a href="#">{{ $dv->provider->info_box->name }}</a></td>
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
                                                            class="fa fa-trash-o m-r-5"></i> Select</a>
                                                </li>
                                                <li>
                                                    <a href="#" onclick="event.preventDefault();
                                                        document.getElementById('{{ 'delete-dv-' . $dv->id }}').submit();"><i
                                                            class="fa fa-trash-o m-r-5"></i> delete</a>
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
    </div>
@stop
