@extends('layouts.app')
@section('page-title')
    dashboard
@stop
@section('content')
    <div class="content container-fluid">
        <div class="card-box">
            <canvas id="myChart" style="max-width: 400px !important;"></canvas>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.bundle.js"></script>
            <script>
                var ctx = document.getElementById("myChart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
                        datasets: [{
                            label: '# of Votes',
                            data: [12, 19, 3, 5, 2, 3],
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                });
            </script>
        </div>
        <div class="row">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="dash-widget dash-widget5">
                        <span class="dash-widget-icon bg-success"><i class="fa fa-money" aria-hidden="true"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ $countProfit }}</h3>
                            <span>Profit</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="dash-widget dash-widget5">
                        <span class="dash-widget-icon bg-warning"><i class="fa fa-money"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ $countTaxes }}</h3>
                            <span>Taxes</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="dash-widget dash-widget5">
                        <span class="dash-widget-icon bg-danger"><i class="fa fa-money" aria-hidden="true"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ $countTva }}</h3>
                            <span>Tva</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-lg-3">
                    <div class="dash-widget dash-widget5">
                        <span class="dash-widget-icon bg-info"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ $countUsers }}</h3>
                            <span>Users</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="panel member-panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Users</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="contact-list">
                            <li>
                                <div class="contact-cont">
                                    <div class="pull-left user-img m-r-10">
                                        <a href="#" title="John Doe"><img src="{{ asset('img/user.jpg') }}" alt="" class="w-40 img-circle"><span class="status online"></span></a>
                                    </div>
                                    <div class="contact-info">
                                        <span class="contact-name text-ellipsis">John Doe</span>
                                        <span class="contact-date">Web Developer</span>
                                    </div>
                                    <ul class="contact-action">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle action-icon" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#"><i class="fa fa-edit"></i> Edit</a></li>
                                                <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="panel-footer text-center bg-white">
                        <a href="{{ route('position.index') }}" class="text-primary">View all Positions</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel member-panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Positions</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="contact-list">
                            <li>
                                <div class="contact-cont">
                                    <div class="pull-left user-img m-r-10">
                                        <a href="#" title="John Doe"><img src="{{ asset('img/user.jpg') }}" alt="" class="w-40 img-circle"><span class="status online"></span></a>
                                    </div>
                                    <div class="contact-info">
                                        <span class="contact-name text-ellipsis">John Doe</span>
                                        <span class="contact-date">Positions</span>
                                    </div>
                                    <ul class="contact-action">
                                        <li class="dropdown">
                                            <a href="#" class="dropdown-toggle action-icon" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <ul class="dropdown-menu">
                                                <li><a href="#"><i class="fa fa-edit"></i> Edit</a></li>
                                                <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                            </li>
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
                                            <img alt="Lesley Grauer" src="{{ asset('img/user.jpg') }}" class="img-responsive img-circle">
                                        </a>
                                    </div>
                                    <div class="activity-content">
                                        <div class="timeline-content">
                                            <a href="#" class="name">Lesley Grauer</a> added new task <a href="#">Hospital Administration</a>
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
                                    <th style="min-width:200px;">Name</th>
                                    <th>QT</th>
                                    <th>status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td style="min-width:200px;">
                                        <a href="#" class="avatar">B</a>
                                        <h2><a href="#">Product <span>REF</span></a></h2>
                                    </td>
                                    <td>0</td>
                                    <td><span class="label label-danger-border">Out of Store</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="{{ route('client.index') }}" class="text-primary">View all clients</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-table">
                    <div class="panel-heading">
                        <h3 class="panel-title">Clients</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table m-b-0">
                                <thead>
                                <tr>
                                    <th style="min-width:200px;">Name</th>
                                    <th>Email</th>
                                    <th>Tel</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td style="min-width:200px;">
                                        <a href="#" class="avatar">B</a>
                                        <h2><a href="#">Client Name <span>City Name</span></a></h2>
                                    </td>
                                    <td>barrycuda@example.com</td>
                                    <td>
                                        <div class="dropdown action-label">
                                            <a class="btn btn-white btn-sm rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-success"></i> Speaker <i class="caret"></i>
                                            </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#"><i class="fa fa-dot-circle-o text-success"></i> Speaker</a></li>
                                                <li><a href="#"><i class="fa fa-dot-circle-o text-primary"></i> Tel</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                                <li><a href="#" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
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
                        <h3 class="panel-title">Providers</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table m-b-0">
                                <thead>
                                <tr>
                                    <th style="min-width:200px;">Name</th>
                                    <th>Email</th>
                                    <th>Tel</th>
                                    <th class="text-right">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td style="min-width:200px;">
                                        <a href="#" class="avatar">B</a>
                                        <h2><a href="#">Client Name <span>City Name</span></a></h2>
                                    </td>
                                    <td>barrycuda@example.com</td>
                                    <td>
                                        <div class="dropdown action-label">
                                            <a class="btn btn-white btn-sm rounded dropdown-toggle" href="#" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-dot-circle-o text-success"></i> Speaker <i class="caret"></i>
                                            </a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#"><i class="fa fa-dot-circle-o text-success"></i> Speaker</a></li>
                                                <li><a href="#"><i class="fa fa-dot-circle-o text-primary"></i> Tel</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                                <li><a href="#" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
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
                        <h3 class="panel-title">Recent Buys</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table m-b-0">
                                <thead>
                                <tr>
                                    <th class="col-md-3">Buy Name </th>
                                    <th class="col-md-3">Progress</th>
                                    <th class="text-right col-md-1">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <h2><a href="#">Slug buy</a></h2>
                                        <small class="block text-ellipsis">
                                            <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                                            <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
                                        </small>
                                    </td>
                                    <td>
                                        <div class="progress progress-xs progress-striped">
                                            <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="65%" style="width: 65%"></div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                                <li><a href="#" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
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
                        <h3 class="panel-title">Recent Sales</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table m-b-0">
                                <thead>
                                <tr>
                                    <th class="col-md-3">sale Name </th>
                                    <th class="col-md-3">Progress</th>
                                    <th class="text-right col-md-1">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <h2><a href="#">Slug sale</a></h2>
                                        <small class="block text-ellipsis">
                                            <span class="text-xs">1</span> <span class="text-muted">open tasks, </span>
                                            <span class="text-xs">9</span> <span class="text-muted">tasks completed</span>
                                        </small>
                                    </td>
                                    <td>
                                        <div class="progress progress-xs progress-striped">
                                            <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="65%" style="width: 65%"></div>
                                        </div>
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                            <ul class="dropdown-menu pull-right">
                                                <li><a href="#" title="Edit"><i class="fa fa-pencil m-r-5"></i> Edit</a></li>
                                                <li><a href="#" title="Delete"><i class="fa fa-trash-o m-r-5"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="{{ route('sale.index') }}" class="text-primary">View all sales</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-table panel-table-top">
                    <div class="panel-heading">
                        <h3 class="panel-title">Invoices</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table m-b-0">
                                <thead>
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Client</th>
                                    <th>Due Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="invoice-view.html">#INV-0001</a></td>
                                    <td>
                                        <h2><a href="#">Hazel Nutt</a></h2>
                                    </td>
                                    <td>8 Aug 2017</td>
                                    <td>$380</td>
                                    <td>
                                        <span class="label label-warning-border">Partially Paid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="invoice-view.html">#INV-0002</a></td>
                                    <td>
                                        <h2><a href="#">Paige Turner</a></h2>
                                    </td>
                                    <td>17 Sep 2017</td>
                                    <td>$500</td>
                                    <td>
                                        <span class="label label-success-border">Paid</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><a href="invoice-view.html">#INV-0003</a></td>
                                    <td>
                                        <h2><a href="#">Ben Dover</a></h2>
                                    </td>
                                    <td>30 Nov 2017</td>
                                    <td>$60</td>
                                    <td>
                                        <span class="label label-danger-border">Unpaid</span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="invoices.html" class="text-primary">View all invoices</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-table panel-table-top">
                    <div class="panel-heading">
                        <h3 class="panel-title">Payments</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table m-b-0">
                                <thead>
                                <tr>
                                    <th>Invoice ID</th>
                                    <th>Client</th>
                                    <th>Payment Type</th>
                                    <th>Paid Date</th>
                                    <th>Paid Amount</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><a href="invoice-view.html">#INV-0004</a></td>
                                    <td>
                                        <h2><a href="#">Barry Cuda</a></h2>
                                    </td>
                                    <td>Paypal</td>
                                    <td>11 Jun 2017</td>
                                    <td>$380</td>
                                </tr>
                                <tr>
                                    <td><a href="invoice-view.html">#INV-0005</a></td>
                                    <td>
                                        <h2><a href="#">Tressa Wexler</a></h2>
                                    </td>
                                    <td>Paypal</td>
                                    <td>21 Jul 2017</td>
                                    <td>$500</td>
                                </tr>
                                <tr>
                                    <td><a href="invoice-view.html">#INV-0006</a></td>
                                    <td>
                                        <h2><a href="#">Ruby Bartlett</a></h2>
                                    </td>
                                    <td>Paypal</td>
                                    <td>28 Aug 2017</td>
                                    <td>$60</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="payments.html" class="text-primary">View all payments</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-table">
                    <div class="panel-heading">
                        <h3 class="panel-title">Accounting</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table m-b-0">
                                <thead>
                                <tr>
                                    <th class="col-md-3">Month </th>
                                    <th class="col-md-3">Tva</th>
                                    <th class="text-right col-md-1">Taxes</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <h2><a href="#">December</a></h2>
                                    </td>
                                    <td>1200</td>
                                    <td class="text-right">1300</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="{{ route('accounting.index') }}" class="text-primary">View all Accounting</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="panel panel-table">
                    <div class="panel-heading">
                        <h3 class="panel-title">Unload</h3>
                    </div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table m-b-0">
                                <thead>
                                <tr>
                                    <th class="col-md-3">Month </th>
                                    <th class="col-md-3">Tva</th>
                                    <th class="text-right col-md-1">Taxes</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        <h2><a href="#">December</a></h2>
                                    </td>
                                    <td>1200</td>
                                    <td class="text-right">1300</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <a href="{{ route('unload.index') }}" class="text-primary">View all unload</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
