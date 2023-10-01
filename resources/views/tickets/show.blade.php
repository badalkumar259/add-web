@extends('layouts.app')

  

@section('content')
<div class="container">
    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Show Ticket</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('tickets.index') }}"> Back</a>

            </div>

        </div>

    </div>

   

    <div class="row">

    <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Assigned User:</strong>

                {{ $ticket->user->name }}

            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Title:</strong>

                {{ $ticket->title }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Description:</strong>

                {{ $ticket->description }}

            </div>

        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Status:</strong>

                {{ $ticket->status }}

            </div>

        </div>

    </div>
</div>
@endsection