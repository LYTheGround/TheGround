<div class="card-box">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#inProgress" data-toggle="tab">{{ ucfirst(__('pages.trade.in progress')) }}</a></li>
        <li><a href="#finish" data-toggle="tab">{{ ucfirst(__('pages.trade.finish')) }}</a></li>
        <li><a href="#archived" data-toggle="tab">{{ ucfirst(__('pages.trade.archived')) }}</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="inProgress">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                            <tr>
                                <th>slug</th>
                                <th>progress</th>
                                <th>ht</th>
                                <th>tva</th>
                                <th class="text-right">ttc</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($buys as $buy)
                                @if($buy->trade_action->status != 'finish' and $buy->trade_action->status != 'archived')
                                    <tr>
                                        <td><a href="{{ route('buy.show',compact('buy')) }}">{{ $buy->slug }}</a></td>
                                        <td>progress</td>
                                        <td>{{ $buy->ht }}</td>
                                        <td>{{ $buy->tva }}</td>
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
        <div class="tab-pane" id="finish">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                            <tr>
                                <th>slug</th>
                                <th>progress</th>
                                <th>ht</th>
                                <th>tva</th>
                                <th class="text-right">ttc</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($buys as $buy)
                                @if($buy->trade_action->status == 'finish')
                                    <tr>
                                        <td><a href="{{ route('buy.show',compact('buy')) }}">{{ $buy->slug }}</a></td>
                                        <td>progress</td>
                                        <td>{{ $buy->ht }}</td>
                                        <td>{{ $buy->tva }}</td>
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
        <div class="tab-pane" id="archived">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table table-striped custom-table datatable">
                            <thead>
                            <tr>
                                <th>slug</th>
                                <th>progress</th>
                                <th>ht</th>
                                <th>tva</th>
                                <th class="text-right">ttc</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($buys as $buy)
                                @if($buy->trade_action->status != 'archived')
                                    <tr>
                                        <td><a href="{{ route('buy.show',compact('buy')) }}">{{ $buy->slug }}</a></td>
                                        <td>progress</td>
                                        <td>{{ $buy->ht }}</td>
                                        <td>{{ $buy->tva }}</td>
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
    </div>
</div>
