@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Edit Cleaner {{ $cleaner->id }}</h1>

    {!! Form::model($cleaner, [
        'method' => 'PATCH',
        'url' => ['/cleaner', $cleaner->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

            <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
                {!! Form::label('first_name', 'First Name', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
                {!! Form::label('last_name', 'Last Name', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('quality_score') ? 'has-error' : ''}}">
                {!! Form::label('quality_score', 'Quality Score', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('quality_score', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('quality_score', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Email', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('cities') ? 'has-error' : ''}}">
                {!! Form::label('cities', 'Cities', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    <table>
                        <tbody>
                            @foreach($cities as $city)
                                <tr>
                                    <td>
                                        {!! Form::checkbox('city'. $city->id, null, (array_search($city->id, $cc)!==false)?true:false) !!}
                                    </td>
                                    <td>
                                        {!! Form::label('city'. $city->id, $city->name, ['class' => 'col-sm-3 control-label']) !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $errors->first('cities', '<p class="help-block">:message</p>') !!}
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