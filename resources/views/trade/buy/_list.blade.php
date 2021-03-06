<div class="card-box">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#inProgress" data-toggle="tab">{{ ucfirst(__('pages.trade.in progress')) }}</a></li>
        <li><a href="#finish" data-toggle="tab">{{ ucfirst(__('pages.trade.finish')) }}</a></li>
        @can('archivedList',\App\Buy::class)
        <li><a href="#archived" data-toggle="tab">{{ ucfirst(__('pages.trade.archived')) }}</a></li>
        @endcan
    </ul>
    <div class="tab-content">
        @include('trade.buy._list_progress',compact('buys'))
        @include('trade.buy._list_finish',compact('buys'))
        @can('archivedList',\App\Buy::class)
        @include('trade.buy._list_archived',compact('buys'))
        @endcan
    </div>
</div>
