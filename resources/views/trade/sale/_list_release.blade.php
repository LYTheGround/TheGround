<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped custom-table table_desc datatable">
                <thead>
                <tr>
                    <th>{{ strtoupper(__('pages.trade.buy.index.title')) }}</th>
                    <th class="text-center">{{ strtoupper(__('validation.attributes.date')) }}</th>
                    <th class="text-center">{{ strtoupper(__('validation.attributes.progress')) }}</th>
                    <th class="text-right">{{ strtoupper(__('validation.attributes.ht')) }}</th>
                    <th class="text-right">{{ strtoupper(__('validation.attributes.tva')) }}</th>
                    <th class="text-right">{{ strtoupper(__('validation.attributes.ttc')) }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bcs as $bc)
                        <?php $tasks = json_decode($bc->sale->trade_action->tasks); ?>
                        <tr>
                            <td><a href="{{ route('sale.show',['sale' => $bc->sale]) }}">{{ $bc->sale->slug }}</a></td>
                            <td class="text-center">{{ Carbon\Carbon::parse($bc->sale->created_at)->format('d-m-Y') }}</td>
                            <td>
                                <div class="progress progress-xs progress-striped" style="background: #000000;">
                                    <div class="progress-bar bg-success" role="progressbar" data-toggle="tooltip"
                                         title="{{ $tasks->progress . '%'}}" style="width: {{$tasks->progress}}%"></div>
                                </div>
                            </td>
                            <td class="text-right">{{ $bc->sale->ht }}</td>
                            <td class="text-right">{{ $bc->sale->tva }}</td>
                            <td class="text-right">{{ $bc->sale->ttc }}</td>
                        </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
