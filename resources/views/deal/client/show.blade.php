@extends("layouts.app")
@section('page-title')
    {{ ucfirst($client->info_box->name) }}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{ ucfirst($client->info_box->name) }}</h4>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('client.edit', compact('client')) }}" class="btn btn-primary m-b-5">
                    <i class="fa fa-edit"></i> {{__('validation.attributes.edit')}}
                </a>
                <a href="#" data-toggle="modal" data-target="#delete_client" class="btn btn-danger  m-b-5">
                    <i class="fa fa-trash"></i>  {{__('validation.attributes.delete')}}
                </a>
            </div>
        </div>
        <div class="card-box m-b-0">
            <div class="row">
                <div class="col-md-12">
                    <div class="profile-view">
                        <div class="profile-img-wrap">
                            <div class="profile-img">
                                <a href="#"><span class="avatar">{{ substr($client->info_box->name,0,1) }}</span></a>
                            </div>
                        </div>
                        <div class="profile-basic">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="profile-info-left">
                                        <h3 class="user-name m-t-0">{{$client->info_box->name}}</h3>
                                        <div class="staff-id"><b>{{__('validation.attributes.email')}}</b> : <a href="#">{{$client->info_box->emails[0]->email}}</a></div>
                                        <div class="staff-id"><b>{{__('validation.attributes.fax')}}</b> : {{ ($client->info_box->fax) ?: __('validation.attributes.inconnu')}}</div>
                                        <div class="staff-id"><b>{{__('validation.attributes.phone')}}</b> : <a href="#">{{ $client->info_box->tels[0]->tel}}</a></div>
                                        <div class="staff-id"><b>{{__('validation.attributes.speaker')}}</b> : {{$client->info_box->speaker}}</div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <ul class="personal-info">
                                        <li class="row">
                                            <span class="title">{{__('validation.attributes.address')}} :</span>
                                            <span class="text">{{$client->info_box->address }}</span>
                                        </li>
                                        <li class="row">
                                            <span class="title">{{__('validation.attributes.build')}} :</span>
                                            <span class="text">{{$client->info_box->build }}</span>
                                        </li>
                                        @if($client->info_box->floor)
                                            <li class="row">
                                                <span class="title">{{__('validation.attributes.floor')}} :</span>
                                                <span class="text">{{$client->info_box->floor }}</span>
                                            </li>
                                        @endif
                                        @if($client->info_box->apt_nbr)
                                            <li class="row">
                                                <span class="title">{{__('validation.attributes.apt_nbr')}} :</span>
                                                <span class="text">{{$client->info_box->apt_nbr }}</span>
                                            </li>
                                        @endif
                                        <li class="row">
                                            <span class="title">{{__('validation.attributes.city')}} :</span>
                                            <span class="text">{{$client->info_box->city->city }}</span>
                                        </li>
                                        @if($client->info_box->apt_nbr)
                                            <li class="row">
                                                <span class="title">{{__('validation.attributes.zip')}} :</span>
                                                <span class="text">{{$client->info_box->zip }}</span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-box tab-box m-b-0">
            <div class="row user-tabs">
                <div class="col-lg-12 col-md-12 col-sm-12 line-tabs">
                    <ul class="nav nav-tabs tabs nav-tabs-bottom">
                        <li class="col-sm-3 active"><a data-toggle="tab" href="#myprojects" aria-expanded="true">{{ __('validation.attributes.description') }}</a></li>
                        <li class="col-sm-3"><a data-toggle="tab" href="#dvs" aria-expanded="true">{{ __('validation.attributes.dvs') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="tab-content  profile-tab-content">
                    <div id="myprojects" class="tab-pane fade active in">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="col-xs-12 card-box">
                                    <p class="text-muted">{{ ($client->description) ?: __('validation.attributes.inconnu') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dvs" class="tab-pane fade">
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-striped custom-table">
                                    <thead>
                                    <tr>
                                        <th class="text-center">{{ strtoupper(__('validation.attributes.dv')) }}</th>
                                        <th class="text-center">{{ strtoupper(__('validation.attributes.ht')) }}</th>
                                        <th class="text-center">{{ strtoupper(__('validation.attributes.tva')) }}</th>
                                        <th class="text-right">{{ strtoupper(__('validation.attributes.ttc')) }}</th>
                                        <th class="text-right">{{ strtoupper(__('validation.attributes.create')) }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dvs as $dv)
                                        <tr>
                                            <td class="text-center"><a href="{{ route('sale.show',['sale' => $dv->sale]) }}">{{ '#'.$dv->slug }}</a></td>
                                            <td class="text-center">{{ $dv->sale->ht }}<b data-target="tooltip" title="Maroc Dirham"> ~M</b></td>
                                            <td class="text-center">{{ $dv->sale->tva }}<b data-target="tooltip" title="Maroc Dirham"> ~M</b></td>
                                            <td class="text-right">{{ $dv->sale->ttc }}<b data-target="tooltip" title="Maroc Dirham"> ~M</b></td>
                                            <td class="text-right">{{ Carbon\Carbon::parse($dv->ttc)->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="delete_client" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content modal-md">
                <div class="modal-header">
                    <h4 class="modal-title">{{ $client->name}}</h4>
                </div>
                <div class="modal-body card-box">
                    <p>{{ __('pages.diver.sure') }}</p>
                    {!! __('pages.deal.client.delete.modal_delete') !!}
                    <div class="m-t-20"> <a href="#" class="btn btn-default" data-dismiss="modal">{{ ucfirst(__('validation.attributes.close')) }}</a>
                        <span onclick="event.preventDefault();document.getElementById('{{ 'delete-client-' . $client->id }}').submit()" class="btn btn-danger">{{ ucfirst(__('validation.attributes.delete')) }}</span>
                        <form action="{{route('client.destroy',compact('client'))}}" method="POST" id="{{ 'delete-client-' . $client->id }}">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
