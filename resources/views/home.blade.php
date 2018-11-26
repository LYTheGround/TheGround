@extends('layouts.app')

@section('content')
<div class="content container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-box">
                <div class="card-title"><h3>Dashboard</h3></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
