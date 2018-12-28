@extends('layouts.app')
@section('page-title')
    {{ ucfirst($member->name) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-12 text-right m-b-30">
                @can('range',$member)
                    <a href="{{ route('member.range',compact('member')) }}" class="btn btn-primary"><i
                            class="fa fa-plus"></i> {{ ucfirst(__('pages.rh.user.range.range_title')) }}</a>

                @endcan
                @if($member->premium->category->category != 'pdg' && $member->premium->update_status < gmdate('Y-m-d'))
                    <a href="{{ route('member.status',compact('member')) }}" class="btn btn-success"><i
                            class="fa fa-edit"></i> {{ __('validation.attributes.status') }}</a>
                @endif
                @cannot('range',$member)
                    @if($member->premium->update_status >= gmdate('Y-m-d'))
                        <div>
                        <span>{{ ucfirst(__('pages.rh.user.status.danger_bloques')) }}<span
                                class="label label-danger-border">{{ Carbon\Carbon::parse($member->premium->update_status)->format('d-m-Y')  }}</span></span>
                        </div>
                    @endif
                @endcannot
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                <a href="#">
                                    <img class="avatar"
                                         src="{{ ($member->info->face) ? asset('storage/' . $member->info->face) : asset('img/user.jpg') }}"
                                         alt="{{ $member->name }}" title="{{ $member->name }}">
                                </a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0 m-b-0">{{ $member->info->last_name . ' ' . $member->info->first_name }}</h3>
                                        <small
                                            class="text-muted">{{ ucfirst($member->premium->category->category) }}</small>
                                        <div class="staff-id">Employee ID : {{ $member->slug }}</div>
                                        <div class="staff-id">{{ ucfirst(__('validation.attributes.status')) }} :
                                            @if($member->premium->status->status === 'inactive')
                                                <span class="label label-warning-border">{{ ucfirst(__($member->premium->status->status)) }}</span>
                                            @elseif($member->premium->status->status === 'active')
                                                <span class="label label-success-border">{{ ucfirst(__($member->premium->status->status)) }}</span>
                                            @else
                                                <span class="label label-danger-border">{{ ucfirst(__($member->premium->status->status)) }}</span>
                                            @endif
                                        </div>
                                        <div class="staff-msg"></div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.phone') }} :</span>
                                            <span class="text"><a href="#">{{ $member->info->tels[0]->tel }}</a></span>
                                        </li>
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.email') }} :</span>
                                            <span class="text">
                                                <a href="#"
                                                   title="{{ $member->info->emails[0]->email }}">{{ $member->info->emails[0]->email }}</a>
                                            </span>
                                        </li>
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.birth') }} :</span>
                                            <span
                                                class="text">{{ ($member->info->birth) ? Carbon\Carbon::parse($member->info->birth)->format('d-m') : 'inconnu' }}</span>
                                        </li>
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.address') }} :</span>
                                            <span class="text">
                                                {{ $member->info->address . ', ' . ucfirst($member->info->city->city) }}
                                            </span>
                                        </li>
                                        <li class="row text-left">
                                            <span class="title">{{ __('validation.attributes.sex') }} :</span>
                                            <span class="text">{{ ($member->info->sex) ?: 'inconnu' }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @isset($member->products[0])
                <div class="col-sm-6">
                    <div class="panel panel-table">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ strtoupper(__('validation.attributes.store')) . ' : ' }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table m-b-0">
                                    <thead>
                                    <tr>
                                        <th style="min-width:200px;">{{ strtoupper(__('validation.attributes.store')) }}</th>
                                        <th>{{ strtoupper(__('validation.attributes.qt')) }}</th>
                                        <th>{{ strtoupper(__('validation.attributes.status')) }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($member->products as $product)
                                        <tr>
                                            <td style="min-width:200px;">
                                                <a href="#" class="avatar">{{ substr($product->name,0,1) }}</a>
                                                <h2>
                                                    <a href="{{ route('product.show',compact('product')) }}">{{ $product->name }}
                                                        <span>{{ $product->ref }}</span></a></h2>
                                            </td>
                                            <td>{{ $product->qt }}</td>
                                            <td>
                                                @if((int) $product->qt > (int) $product->qt_min)
                                                    <span class="label label-success-border">In Stock</span>
                                                @elseif((int) $product->qt == (int) $product->qt_min)
                                                    <span
                                                        class="label label-warning-border text-primary">Just min Stock</span>
                                                @elseif((int)$product->qt < (int) $product->qt_min and (int) $product->qt > 0)
                                                    <span class="label label-warning-border">Low of Stock</span>
                                                @else
                                                    <span class="label label-danger-border">Out of Stock</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="{{ route('product.index') }}" class="text-primary">View all Products</a>
                        </div>
                    </div>
                </div>
            @endisset
            @isset($member->positions[0])
                <div class="col-sm-6">
                    <div class="panel member-panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ strtoupper(__('validation.attributes.position')) }}</h3>
                        </div>
                        <div class="panel-body">
                            <ul class="contact-list">
                                @foreach($member->positions as $position)
                                    <li>
                                        <div class="contact-cont">
                                            <div class="pull-left user-img m-r-10">
                                                <a href="#" title="John Doe"><img
                                                        src="{{ ($position->info->face) ? asset('storage/' . $position->info->face) : asset('img/user.jpg') }}"
                                                        alt=""
                                                        class="w-40 img-circle"><span
                                                        class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                            <span
                                                class="contact-name text-ellipsis">{{ $position->info->last_name . ' '. $position->info->first_name }}</span>
                                                <span class="contact-date">{{ $position->position }}</span>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="panel-footer text-center bg-white">
                            <a href="{{ route('position.index') }}" class="text-primary">View all Positions</a>
                        </div>
                    </div>
                </div>
            @endisset
            @isset(auth()->user()->clients[0])
                <div class="col-sm-6">
                    <div class="panel panel-table">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ strtoupper(__('pages.deal.client.index.title')) }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table m-b-0">
                                    <thead>
                                    <tr>
                                        <th style="min-width:200px;">{{ __('validation.attributes.name') }}</th>
                                        <th>{{ __('validation.attributes.email') }}</th>
                                        <th>{{ __('validation.attributes.phone') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(auth()->user()->clients as $client)
                                        <tr>
                                            <td style="min-width:200px;">
                                                <a href="#" class="avatar">{{ substr($client->info_box->name,0,1) }}</a>
                                                <h2><a href="#">{{ $client->info_box->name }}
                                                        <span>{{ $client->info_box->city->city }}</span></a></h2>
                                            </td>
                                            <td>{{ $client->info_box->emails[0]->email }}</td>
                                            <td>
                                                <div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm rounded dropdown-toggle" href="#"
                                                       data-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-dot-circle-o text-success"></i> {{ ucfirst($client->info_box->speaker) }}
                                                        <i
                                                            class="caret"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><a href="#"><i
                                                                    class="fa fa-dot-circle-o text-success"></i> {{ ucfirst($client->info_box->speaker) }}
                                                            </a>
                                                        </li>
                                                        <li><a href="#"><i
                                                                    class="fa fa-dot-circle-o text-primary"></i> {{ $client->info_box->tels[0]->tel }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="{{ route('client.index') }}" class="text-primary">View all clients</a>
                        </div>
                    </div>
                </div>
            @endisset
            @isset(auth()->user()->providers[0])
                <div class="col-sm-6">
                    <div class="panel panel-table">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ strtoupper(__('pages.deal.provider.index.title')) }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table m-b-0">
                                    <thead>
                                    <tr>
                                        <th style="min-width:200px;">{{ __('validation.attributes.name') }}</th>
                                        <th>{{ __('validation.attributes.email') }}</th>
                                        <th>{{ __('validation.attributes.phone') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach(auth()->user()->providers as $provider)
                                        <tr>
                                            <td style="min-width:200px;">
                                                <a href="#"
                                                   class="avatar">{{ substr($provider->info_box->name,0,1) }}</a>
                                                <h2><a href="#">{{ $provider->info_box->name }}
                                                        <span>{{ $provider->info_box->city->city }}</span></a></h2>
                                            </td>
                                            <td>{{ $provider->info_box->emails[0]->email }}</td>
                                            <td>
                                                <div class="dropdown action-label">
                                                    <a class="btn btn-white btn-sm rounded dropdown-toggle" href="#"
                                                       data-toggle="dropdown" aria-expanded="false"><i
                                                            class="fa fa-dot-circle-o text-success"></i> {{ ucfirst($provider->info_box->speaker) }}
                                                        <i
                                                            class="caret"></i>
                                                    </a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><a href="#"><i
                                                                    class="fa fa-dot-circle-o text-success"></i> {{ ucfirst($provider->info_box->speaker) }}
                                                            </a>
                                                        </li>
                                                        <li><a href="#"><i
                                                                    class="fa fa-dot-circle-o text-primary"></i> {{ $provider->info_box->tels[0]->tel }}
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="{{ route('provider.index') }}" class="text-primary">View all providers</a>
                        </div>
                    </div>
                </div>
            @endisset
            @isset($$buys[0])
                <div class="col-sm-6">
                    <div class="panel panel-table">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ strtoupper(__('pages.trade.buy.index.title')) }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table m-b-0">
                                    <thead>
                                    <tr>
                                        <th class="col-md-3">{{ __('validation.attributes.name') }}</th>
                                        <th class="col-md-3">{{ __('validation.attributes.progress') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($buys as $buy)
                                        <?php $tasks = json_decode($buy->tasks); ?>
                                        <tr>
                                            <td>
                                                <h2><a href="#">{{ $buy->slug }}</a></h2>
                                            </td>
                                            <td>
                                                <div class="progress progress-xs progress-striped">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         data-toggle="tooltip" title="{{$tasks->progress}}%"
                                                         style="width: {{$tasks->progress}}%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="{{ route('buy.index') }}" class="text-primary">View all buy</a>
                        </div>
                    </div>
                </div>
            @endisset
            @isset($sales[0])
                <div class="col-sm-6">
                    <div class="panel panel-table">
                        <div class="panel-heading">
                            <h3 class="panel-title">{{ strtoupper(__('pages.trade.sale.index.title')) }}</h3>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped custom-table m-b-0">
                                    <thead>
                                    <tr>
                                        <th class="col-md-3">{{ __('validation.attributes.name') }}</th>
                                        <th class="col-md-3">{{ __('validation.attributes.progress') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sales as $sale)
                                        <?php $tasks = json_decode($sale->tasks); ?>
                                        <tr>
                                            <td>
                                                <h2><a href="#">{{ $sale->slug }}</a></h2>
                                            </td>
                                            <td>
                                                <div class="progress progress-xs progress-striped">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                         data-toggle="tooltip" title="{{$tasks->progress}}%"
                                                         style="width: {{$tasks->progress}}%"></div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <a href="{{ route('sale.index') }}" class="text-primary">View all buy</a>
                        </div>
                    </div>
                </div>
            @endisset
        </div>
    </div>
@stop
