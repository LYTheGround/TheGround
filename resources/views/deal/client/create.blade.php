@extends("layouts.app")
@section('page-title')
    {{ ucfirst(__('pages.deal.client.create.title'))}}
@stop
@section('content')

    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{ ucfirst(__('pages.deal.client.create.title'))}}</h4>
            </div>
        </div>
        <div class="row">
            <div class="card-box">
                @include('deal.client._form',['submit' => __('validation.attributes.create')])
            </div>
        </div>
    </div>

@stop
