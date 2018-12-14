@extends('layouts.app')
@section('page-title')
    {{ __('pages.trade.buy.dv.create.title') }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4>{{ __('pages.trade.buy.dv.create.title') }}</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="card-box">
                    {{ Form::open(['method' => 'POST','url' => route('dv.store',compact('buy')),'class' => 'form-horizontal']) }}
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <select name="provider" title="provider" id="provider" class="form-control">
                                    <option  disabled selected value>{{ ucfirst(__('pages.deal.provider.index.title')) }}</option>
                                    @foreach($providers as $provider)
                                        <option value="{{ $provider->id }}">{{ $provider->info_box->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('provider'))
                                    <span class="text-danger">{{ $errors->first('provider') }}</span>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table">
                                <thead>
                                <tr>
                                    <th>{{ ucfirst(__('validation.attributes.products')) }}</th>
                                    <th>{{ ucfirst(__('validation.attributes.qt')) }}</th>
                                    <th class="text-center">{{ ucfirst(__('validation.attributes.pu')) }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($bcs as $bc)
                                    <tr>
                                        <td><a href="{{ route('product.show',['product' => $bc->product]) }}">{{ $bc->product->name }}</a></td>
                                        <td><a href="#">{{ $bc->qt }}</a></td>
                                        <td><a href="#">
                                                {{ Form::number('pu['. $bc->id. ']',null,['class' => 'form-control', 'placeholder' => ucfirst(__('validation.attributes.pu')), 'step' => '0.01', 'required']) }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-right">
                                        {{ Form::submit(ucfirst(__('validation.attributes.add')),['class' => 'btn btn-primary']) }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>

    </div>
@stop
