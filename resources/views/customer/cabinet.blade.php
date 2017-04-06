@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Booking <a href="{{ url('/booking/create') }}" class="btn btn-primary btn-xs" title="Add New Booking"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Date </th><th> Time </th><th> Hours </th><th> Cleaner </th><th>City</th>
                </tr>
            </thead>
            <tbody>
            @foreach($booking as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->date }}</td>
                    <td>{{ $item->time }}</td>
                    <td>{{ $item->hours }}</td>
                    <td>{{ $item->getCleaner() }}</td>
                    <td>{{ $item->getCity() }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $booking->render() !!} </div>
    </div>

</div>
@endsection
