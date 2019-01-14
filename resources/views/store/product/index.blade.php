@extends("layouts.app")
@section('page-title')
    {{ ucfirst(__('pages.product.index.title'))}}
@stop
@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-xs-7">
                <h4 class="page-title">{{ ucfirst(__('pages.product.index.title'))}}</h4>
            </div>
            <div class="col-xs-5 text-right">
                <a href="{{ route('product.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> {{__('validation.attributes.create')}}</a>
            </div>
        </div>
        @include('store.product._list', compact('products'))
        @foreach($products as $product)
            @include('store.product._destroy',compact('product'))
        @endforeach
    </div>
@stop
