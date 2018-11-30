@extends("layouts.app")
@section('title')
    {{__('pages.product.title_index')}}
@stop
@section('content')

    <div class="content container-fluid">
        <div class="row">
            <div class="col-sm-4 col-xs-3">
                <div class="view-icons pull-left">
                    <i class="fa fa-bars"></i>
                </div>
                <h4 class="page-title">{{__('pages.product.title_index')}}</h4>
            </div>
            <div class="col-sm-8 col-xs-9 text-right m-b-20">
                <a href="{{ route('product.create')}}" class="btn btn-primary rounded pull-right"><i class="fa fa-plus"></i> {{__('validation.attributes.create')}}</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-box">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="display datatable table table-stripped">
                                <thead>
                                <tr>
                                    <th>Produit</th>
                                    <th>REF</th>
                                    <th>Date De création</th>
                                    <th>Quantité</th>
                                    <th>TVA</th>
                                    <th>Status</th>
                                    <th class="text-right">{{__('validation.attributes.action')}}</th>
                                </tr>
                                </thead>
                                <tbody>

                                    @foreach($products as $product)
                                        <tr>
                                            <td>
                                                <div class="product-det">
                                                    <img src="{{asset('img/product/product-thumb-01.jpg')}}" alt="">
                                                    <div class="product-desc">
                                                        <h2><a href="{{ route('product.show',compact('product')) }}">{{ $product->name }}</a>
                                                            <span>{{ ($product->description) ? substr($product->description,0,10) . ' ...' : '' }}</span>
                                                        </h2>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{ $product->ref }}</td>
                                            <td>{{$product->created_at}}</td>
                                            <td>{{$product->qt}}</td>
                                            <td>{{$product->tva}}</td>
                                            <td>
                                                @if($product->qt > 10)
                                                    <span class="label label-success-border">In Stock</span>
                                                    @elseif($product->qt < 10 and $product->qt > 0)
                                                    <span class="label label-warning-border">Low of Stock</span>
                                                @else
                                                    <span class="label label-danger-border">Out of Stock</span>
                                                @endif
                                            </td>
                                            <td class="text-right">
                                                <div class="dropdown">
                                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li><a  href="{{ route('product.edit', compact('product')) }}"><i class="fa fa-pencil m-r-5"></i> {{__('validation.attributes.edit')}}</a></li>
                                                        <li>
                                                            <a href="#"
                                                               onclick="if(confirm('Do you remove it ??')){
                                                                       document.getElementById('delete-product{{$product->id}}').submit();
                                                                       event.preventDefault();}
                                                                       else event.preventDefault(); ">
                                                                <i class="fa fa-trash-o m-r-5"></i> {{__('validation.attributes.delete')}}
                                                            </a>
                                                            <form id="delete-product{{$product->id}}" method="post" action="{{ route('product.destroy', compact('product')) }}">
                                                                {!! method_field('delete') !!}
                                                                {!! csrf_field() !!}
                                                            </form>
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
    </div>
@stop
