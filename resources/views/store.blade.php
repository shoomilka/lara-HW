@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    Hello, {{ $customer->first_name }} {{ $customer->last_name }}!
                    @if(empty($cleaner))
                        <p>Sorry, we can't find an available cleaner, we could not fulfill your request. Try to choose different time interval</p>
                    @else
                        <p>Your cleaner is {{ $cleaner->first_name }} {{ $cleaner->last_name }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection