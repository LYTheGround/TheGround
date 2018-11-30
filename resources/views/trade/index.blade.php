@extends('layouts.app')
@section('page-title')
    Trade
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row m-b-30">
            <div class="col-xs-7">
                <h3>Trade</h3>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('buy.index') }}" class="btn btn-primary">Achats uniquement</a>
                <a href="#" class="btn btn-success">Ventes uniquement</a>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-6 card-box">
                <!-- Un Tableau des achats en cours qui present
                    -   le slug de l'achat.
                    -   la barre de progression.
                    -->
                <div class="card-title">
                    <h5>Buys</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped custom-table">
                        <thead>
                        <tr>
                            <th>buy</th>
                            <th class="text-center">progress</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($buys) == 0)
                            <tr>
                                <td colspan="2" class="text-center text-primary">pas d'achats en cours</td>
                            </tr>
                        @else
                        @foreach($buys as $buy)
                            <?php $tasks = json_decode($buy->trade_action->tasks); ?>
                            <tr>
                                <td>
                                    <h2><a href="#">{{ $buy->slug }}</a></h2>
                                </td>
                                <td>
                                    <p class="m-b-5">
                                        Progress <span class="text-success pull-right">{{ $tasks->progress }}%</span>
                                    </p>
                                    <div class="progress progress-xs m-b-0">
                                        <div class="progress-bar progress-bar-success"
                                             role="progressbar" data-toggle="tooltip"
                                             title="{{ $tasks->progress }}%" style="width: {{ $tasks->progress }}%"></div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-xs-6 card-box">
                <!-- Un Tableau des ventes en cours qui present
                     -   le slug de la vente.
                     -   la barre de progression.
                     -->
                <div class="card-title">
                    <h5>Sales</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped custom-table">
                        <thead>
                        <tr>
                            <th>Sale</th>
                            <th class="text-center">progress</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($sales) == 0)
                            <tr>
                                <td colspan="2" class="text-center text-primary">pas de ventes en cours</td>
                            </tr>
                        @else
                        @foreach($sales as $sale)
                            <?php $tasks = json_decode($sale->trade_action->tasks); ?>
                            <tr>
                                <td><h2><a href="#">{{ $sale->slug }}</a></h2></td>
                                <td><p class="m-b-5">Progress <span class="text-success pull-right">{{ $tasks->progress }}
                                            %</span></p>
                                    <div class="progress progress-xs m-b-0">
                                        <div class="progress-bar progress-bar-success" role="progressbar" data-toggle="tooltip"
                                             title="{{ $tasks->progress }}%" style="width: {{ $tasks->progress }}%"></div>
                                    </div></td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
