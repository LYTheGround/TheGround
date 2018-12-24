@extends('layouts.app')
@section('page-title')
    dashboard
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="panel member-panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ strtoupper(__('pages.rh.user.members')) }}</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="contact-list">
                            @foreach($members as $member)
                                <li>
                                    <div class="contact-cont">
                                        <div class="pull-left user-img m-r-10">
                                            <a href="#" title="John Doe"><img
                                                    src="{{ ($member->info->face) ? asset('storage/' . $member->info->face) : asset('img/user.jpg') }}"
                                                    alt=""
                                                    class="w-40 img-circle"><span
                                                    class="status online"></span></a>
                                        </div>
                                        <div class="contact-info">
                                            <span
                                                class="contact-name text-ellipsis">{{ $member->info->last_name . ' '. $member->info->first_name }}</span>
                                            <span class="contact-date">{{ $member->premium->category->category }}</span>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer text-center bg-white">
                        <a href="{{ route('member.list') }}" class="text-primary">View all Members</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel member-panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ strtoupper(__('validation.attributes.position')) }}</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="contact-list">
                            @foreach($positions as $position)
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
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="panel activity-panel">
                    <div class="panel-heading">
                        <h6 class="panel-title">Activities</h6>
                    </div>
                    <div class="panel-body">
                        <div class="activity-box">
                            <ul class="activity-list">
                                <li>
                                    <div class="activity-user">
                                        <a href="#" title="Lesley Grauer" data-toggle="tooltip" class="avatar">
                                            <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}"
                                                 class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">Lesley Grauer</a> added new task <a href="#">Hospital
                                                Administration</a>
                                            <span class="time">4 mins ago</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="panel-footer text-center bg-white">
                        <a href="#" class="text-primary">View all activities</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-table">
                    <div class="panel-heading">
                        <h3 class="panel-title">Stores</h3>
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
                                @foreach($products as $product)
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
        </div>
        <div class="row">
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
                                @foreach($clients as $client)
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
                                @foreach($providers as $provider)
                                    <tr>
                                        <td style="min-width:200px;">
                                            <a href="#" class="avatar">{{ substr($provider->info_box->name,0,1) }}</a>
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
        </div>
        <div class="row">
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
                                    <?php $tasks = json_decode($buy->trade_action->tasks); ?>
                                    <tr>
                                        <td>
                                            <h2><a href="#">{{ $buy->slug }}</a></h2>
                                        </td>
                                        <td>
                                            <div class="progress progress-xs progress-striped">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                     data-toggle="tooltip" title="{{$tasks->progress}}%" style="width: {{$tasks->progress}}%"></div>
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
                                @foreach($sales as $sale)
                                    <?php $tasks = json_decode($sale->trade_action->tasks); ?>
                                    <tr>
                                        <td>
                                            <h2><a href="#">{{ $sale->slug }}</a></h2>
                                        </td>
                                        <td>
                                            <div class="progress progress-xs progress-striped">
                                                <div class="progress-bar bg-success" role="progressbar"
                                                     data-toggle="tooltip" title="{{$tasks->progress}}%" style="width: {{$tasks->progress}}%"></div>
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
        </div>
    </div>
    <script>
        var trade_bar = document.getElementById("trade_bar").getContext('2d');
        var myChart = new Chart(trade_bar, {
            type: 'line',
            data: {
                datasets: [{
                    label: "{{ ucfirst(__('pages.trade.buy.index.title')) }}",
                    data: [10, 20, 30, 40, 65, 10, 20, 30, 40, 65, 40, 65],
                    borderColor:
                        'rgb(54, 162, 235)'
                }],
                labels: ['janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'september', 'october', 'November', 'December']
            },
            options: {
                scales: {
                    yAxes: [{
                        stacked: true
                    }]
                }
            }
        });
    </script>
@stop
