@extends("layouts.app")
@section('page-title')
    {{ ucfirst(__('pages.product.create.title'))}}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h4 class="page-title">{{ ucfirst(__('pages.product.create.title'))}}</h4>
            </div>
        </div>
        <div class="card-box">
            <div class="row">
                <div class="col-xs-12">
                    @include('store.product._form',['submit' => __('validation.attributes.create')])
                </div>
            </div>
        </div>

    </div>

@stop
