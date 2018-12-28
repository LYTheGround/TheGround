<div class="row">
    <div class="col-md-12">
        <div class="card-box">
            <div class="card-block">
                <div class="table-responsive">
                    <table class="display datatable table table-stripped">
                        <thead>
                        <tr>
                            <th>{{ strtoupper(__('pages.product.index.title')) }}</th>
                            <th>{{ strtoupper(__('validation.attributes.ref')) }}</th>
                            <th class="hidden-xs hidden-sm">{{ strtoupper(__('validation.attributes.tva')) }}</th>
                            <th class="hidden-xs hidden-sm">{{ strtoupper(__('validation.attributes.created_at')) }}</th>
                            <th class="hidden-xs hidden-sm">{{ strtoupper(__('validation.attributes.status')) }}</th>
                            <th class="hidden-xs hidden-sm text-right">{{__('validation.attributes.action')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($products as $product)
                            <tr>
                                <td>
                                    <div class="product-det">
                                        <img src="{{ (isset($product->imgs[0])) ? asset('storage/' . $product->imgs[0]->img) : asset('img/product/product-thumb-04.jpg')}}" alt="{{ $product->name }}" title="{{ $product->name }}">
                                        <div class="product-desc">
                                            <h2><a href="{{ route('product.show',compact('product')) }}">{{ $product->name }}</a>
                                                <span>{{ ($product->description) ? substr($product->description,0,10) . ' ...' : '' }}</span>
                                            </h2>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $product->ref }}</td>
                                <td class="hidden-xs hidden-sm">{{$product->tva . ' %'}}</td>
                                <td class="hidden-xs hidden-sm">{{ Carbon\Carbon::parse($product->created_at)->format('d-m-Y') }}</td>
                                <td class="hidden-xs hidden-sm">
                                    @if((int) $product->qt > (int) $product->qt_min)
                                        <span class="label label-success-border">{{ strtoupper(__('validation.attributes.in_stock')) }}</span>
                                    @elseif((int) $product->qt == (int) $product->qt_min)
                                        <span class="label label-warning-border text-primary">{{ strtoupper(__('validation.attributes.just_stock')) }}</span>
                                    @elseif((int)$product->qt < (int) $product->qt_min and (int) $product->qt > 0)
                                        <span class="label label-warning-border">{{ strtoupper(__('validation.attributes.low_stock')) }}</span>
                                    @else
                                        <span class="label label-danger-border">{{ strtoupper(__('validation.attributes.out_stock')) }}</span>
                                    @endif
                                </td>
                                <td class="hidden-xs hidden-sm text-right">
                                    <div class="dropdown">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
                                        <ul class="dropdown-menu pull-right">
                                            <li><a  href="{{ route('product.edit',compact('product')) }}" ><i class="fa fa-pencil m-r-5"></i> {{__('validation.attributes.edit')}}</a></li>
                                            <li>
                                                <a href="#"  data-toggle="modal" data-target="{{ '#delete_product' . $product->id }}" >
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
