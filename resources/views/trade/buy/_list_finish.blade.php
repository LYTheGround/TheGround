<div class="tab-pane" id="finish">
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
                    @foreach($buys as $buy)
                        @if($buy->trade_action->status == 'finish' and \Carbon\Carbon::parse($buy->trade_action->done_time)->format('m-Y') == gmdate('m-Y'))
                            <tr>
                                <td>
                                    <span class="avatar">{{ substr($buy->dvs->where('selected',true)->first()->provider->info_box->name,0,1) }}</span>
                                    <a href="{{ route('provider.show',['provider' => $buy->dvs->where('selected',true)->first()->provider]) }}">{{ $buy->dvs->where('selected',true)->first()->provider->info_box->name }}</a>
                                </td>
                                <td><a href="{{ route('buy.show',compact('buy')) }}">{{ $buy->slug }}</a></td>

                                <td class="text-right">{{ $buy->ht }}</td>
                                <td class="text-right">{{ $buy->tva }}</td>
                                <td class="text-right">{{ $buy->ttc }}</td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
