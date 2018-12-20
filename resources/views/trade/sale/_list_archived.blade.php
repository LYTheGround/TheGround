<div class="tab-pane" id="archived">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table table_desc datatable">
                    <thead>
                    <tr>
                        <th>{{ ucfirst(__('pages.deal.provider.index.title')) }}</th>
                        <th>{{ ucfirst(__('pages.trade.buy.index.title')) }}</th>
                        <th class="text-right">{{ strtoupper(__('validation.attributes.ht')) }}</th>
                        <th class="text-right">{{ strtoupper(__('validation.attributes.tva')) }}</th>
                        <th class="text-right">{{ strtoupper(__('validation.attributes.ttc')) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $sale)
                        @if($sale->trade_action->status == 'finish' and \Carbon\Carbon::parse($sale->trade_action->done_time)->format('m-Y') < gmdate('m-Y'))
                            <tr>
                                <td>
                                    <span class="avatar">{{ substr($sale->dv->client->info_box->name,0,1) }}</span>
                                    <a href="{{ route('client.show',['client' => $sale->dv->client]) }}">{{ $sale->dv->client->info_box->name }}</a>
                                </td>
                                <td><a href="{{ route('sale.show',compact('sale')) }}">{{ $sale->slug }}</a></td>

                                <td class="text-right">{{ $sale->ht }}</td>
                                <td class="text-right">{{ $sale->tva }}</td>
                                <td class="text-right">{{ $sale->ttc }}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
