@extends('layouts.app')
@section('page-title')
    {{ ucfirst(__('validation.attributes.echeancesList')) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h3>{{ ucfirst(__('validation.attributes.echeancesList')) }}</h3>
            </div>
        </div>
        <div class="row">
            <div class="card-box">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped custom-table datatable">
                                <thead>
                                <tr>
                                    <th>{{ __('validation.attributes.order') }}</th>
                                    <th>{{ __('validation.attributes.prince') }}</th>
                                    <th>{{ __('validation.attributes.echeanceDate') }}</th>
                                    <th>{{ __('validation.attributes.status') }}</th>
                                    <th class="text-right">{{ __('validation.attributes.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($echeances as $echeance)
                                    <tr>

                                        <td>
                                            @if($echeance->buy_id)
                                                <a href="{{ route('buy.show',['buy' => $echeance->buy])}}"
                                                   style="color: blue;">
                                                    {{ '#'.$echeance->buy->slug }}
                                                </a>
                                            @else
                                                <a href="{{ route('sale.show',['sale' => $echeance->sale])}}"
                                                   style="color: blue;">
                                                    {{ '#'.$echeance->sale->slug }}
                                                </a>
                                            @endif
                                        </td>
                                        <td class="{{ ($echeance->buy_id) ? 'text-danger' : 'text-success'  }}">{{ $echeance->prince . ' ~M' }}</td>
                                        <td>{{ Carbon\Carbon::parse($echeance->date)->format('d/m/y') }}</td>
                                        <td>
                                            @if( ($echeance->payed))
                                                <span class='label label-success-border'>Payer</span>
                                            @else
                                                <span class="label label-danger-border">Non Payer</span>
                                            @endif
                                        </td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <ul class="dropdown-menu pull-right">
                                                    @if(!$echeance->payed)
                                                    <li>
                                                        <a href="#" data-target="#payed_echeance_{{$echeance->id}}"
                                                           data-toggle="modal">
                                                            <i class="fa fa-dollar m-r-5"></i> {{ __('validation.attributes.payed') }}
                                                        </a>
                                                    </li>
                                                        <li>
                                                            <a href="{{ route('echeance.edit',compact('echeance')) }}"><i
                                                                    class="fa fa-edit m-r-5"></i> {{ __('validation.attributes.edit') }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a href="#" data-target="#delete_echeance_{{$echeance->id}}"
                                                           data-toggle="modal">
                                                            <i class="fa fa-trash-o m-r-5"></i> {{ __('validation.attributes.delete') }}
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
                </div>

            </div>
        </div>
        @foreach($echeances as $echeance)
            <div id="delete_echeance_{{$echeance->id}}" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content modal-md">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ __('validation.attributes.delete')}}</h4>
                        </div>
                        <div class="modal-body card-box">
                            <p>{{ __('pages.diver.sure') }}</p>
                            {!! __('validation.attributes.modal_delete') !!}
                            <div class="m-t-20"><a href="#" class="btn btn-default" data-dismiss="modal">{{ ucfirst(__('validation.attributes.close')) }}</a>
                                <span
                                    onclick="event.preventDefault();document.getElementById('delete-echeance-{{$echeance->id}}').submit()"
                                    class="btn btn-danger">{{ ucfirst(__('validation.attributes.delete')) }}</span>
                                <form action="{{ route('echeance.destroy',compact('echeance')) }}" method="POST"
                                      id="delete-echeance-{{$echeance->id}}">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @if(!$echeance->payed)
            <div id="payed_echeance_{{$echeance->id}}" class="modal custom-modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content modal-md">
                        <div class="modal-header">
                            <h4 class="modal-title">{{ __('validation.attributes.payed')}}</h4>
                        </div>
                        <div class="modal-body card-box">
                            <p>{{ __('pages.diver.sure') }}</p>
                            {!! __('validation.attributes.modal_delete') !!}
                            <div class="m-t-20"><a href="#" class="btn btn-default" data-dismiss="modal">{{ ucfirst(__('validation.attributes.close')) }}</a>
                                <span
                                    onclick="event.preventDefault();document.getElementById('payed-echeance-{{$echeance->id}}').submit()"
                                    class="btn btn-danger">{{ __('validation.attributes.payed') }}</span>
                                <form action="{{ route('echeance.payed',compact('echeance')) }}" method="POST"
                                      id="payed-echeance-{{$echeance->id}}">
                                    @csrf
                                    @method('PATCH')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endforeach
    </div>
@stop
