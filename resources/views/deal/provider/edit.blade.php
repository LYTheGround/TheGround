@extends("layouts.app")
@section('page-title')
    {{ ucfirst(__('pages.deal.provider.edit.title'))}}
@stop
@section('content')

    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{ ucfirst(__('pages.deal.provider.edit.title'))}}</h4>
            </div>
        </div>
        <div class="row">
            <div class="card-box">
                @include('deal.provider._form',['submit' => __('validation.attributes.edit'), 'provider' => $provider,'info' => $provider->info_box])
            </div>
        </div>
    </div>

@stop
