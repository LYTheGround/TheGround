@extends("layouts.app")
@section('page-title')
    {{ ucfirst(__('pages.deal.provider.index.title'))}}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{ ucfirst(__('pages.deal.provider.index.title'))}}</h4>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('provider.create')}}" class="btn btn-primary"><i
                        class="fa fa-plus"></i> {{__('validation.attributes.create')}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <div class="card-box">
                        <div class="card-block">
                            <table class="display datatable table_desc table table-stripped">
                                <thead>
                                <tr>

                                    <th>{{__('validation.attributes.name')}}</th>
                                    <th>{{__('validation.attributes.city')}}</th>
                                    <th>{{__('validation.attributes.phone')}}</th>
                                    <th>{{__('validation.attributes.email')}}</th>
                                    <th>{{__('validation.attributes.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($providers as $provider)
                                    <tr>
                                        <td>
                                            <span class="avatar">{{ substr($provider->info_box->name,0,1) }}</span>
                                            <a href="{{ route('provider.show',compact('provider'))}}"
                                               title="{{ $provider->info_box->name }}">{{$provider->info_box->name}}</a>
                                        </td>
                                        <td>{{ ($provider->info_box->city->city) ?: __('validation.attributes.inconnu') }}</td>
                                        <td>{{ ($provider->info_box->tels[0]->tel) ?: __('validation.attributes.inconnu') }}</td>
                                        <td>{{ ($provider->info_box->emails[0]->email) ?: __('validation.attributes.inconnu') }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                                   aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                <ul class="dropdown-menu pull-right">
                                                    <li><a href="{{ route('provider.edit', compact('provider')) }}"><i
                                                                class="fa fa-pencil m-r-5"></i> {{__('validation.attributes.edit')}}
                                                        </a></li>
                                                    <li>
                                                        <a href="#" data-toggle="modal"
                                                           data-target="#delete_provider{{$provider->id}}">
                                                            <i class="fa fa-trash-o m-r-5"></i> {{__('validation.attributes.delete')}}
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
        @foreach($providers as $provider)
            @include('deal.provider._delete',compact('provider'))
        @endforeach
    </div>
@stop
