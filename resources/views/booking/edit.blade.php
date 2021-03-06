@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit Booking {{ $booking->id }}</h1>

    {!! Form::model($booking, [
        'method' => 'PATCH',
        'url' => ['/booking', $booking->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

            <div class="form-group {{ $errors->has('customer_id') ? 'has-error' : ''}}">
                {!! Form::label('customer_id', 'Customer Id', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('customer_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('customer_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('cleaner_id') ? 'has-error' : ''}}">
                {!! Form::label('cleaner_id', 'Cleaner Id', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('cleaner_id', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('cleaner_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>



            <div class="form-group {{ $errors->has('date') ? 'has-error' : ''}}">
                {!! Form::label('date', 'Date', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('date', null, ['class' => 'form-control', 'id' => 'datepicker1']) !!}
                    {!! $errors->first('date', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('time') ? 'has-error' : ''}}">
                {!! Form::label('time', 'Time', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('time', null, ['class' => 'form-control', 'id' => 'timepicker1']) !!}
                    {!! $errors->first('time', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('hours') ? 'has-error' : ''}}">
                {!! Form::label('hours', 'Hours', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('hours', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('hours', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('city_id') ? 'has-error' : ''}}">
                {!! Form::label('city_id', 'City', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('city_id', $cities, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('city_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

</div>
@endsection