@extends("layouts.app")
@section('page-title')
    {{__('pages.deal.client.index.title')}}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{__('pages.deal.client.index.title')}}</h4>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('client.create')}}" class="btn btn-primary"><i
                        class="fa fa-plus"></i> {{__('validation.attributes.create')}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                @include('deal.client._list',compact('clients'))
            </div>
        </div>
        @foreach($clients as $client)
            @include('deal.client._delete',compact('client'))
        @endforeach
    </div>
@stop
