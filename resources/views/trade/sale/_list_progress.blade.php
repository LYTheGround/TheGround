<div class="tab-pane active" id="inProgress">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table datatable">
                    <thead>
                    <tr>
                        <th>{{ strtoupper(__('pages.trade.buy.index.title')) }}</th>
                        <th class="text-center">{{ strtoupper(__('validation.attributes.progress')) }}</th>
                        <th class="text-right">{{ strtoupper(__('validation.attributes.ht')) }}</th>
                        <th class="text-right">{{ strtoupper(__('validation.attributes.tva')) }}</th>
                        <th class="text-right">{{ strtoupper(__('validation.attributes.ttc')) }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sales as $sale)
                        @if($sale->trade_action->status != 'finish')
                            <?php $tasks = json_decode($sale->trade_action->tasks); ?>
                            <tr>
                                <td><a href="{{ route('sale.show',compact('sale')) }}">{{ $sale->slug }}</a></td>
                                <td>
                                    <div class="progress progress-xs progress-striped" style="background: #000000;">
                                        <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip" title="{{ $tasks->progress . '%'}}" style="width: {{$tasks->progress}}%"></div>
                                    </div>
                                </td>
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
