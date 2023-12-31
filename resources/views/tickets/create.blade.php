@extends('layouts.app')

  

@section('content')
<div class="container">
<div class="row">

    <div class="col-lg-12 margin-tb">

        <div class="pull-left">

            <h2>Add New Ticket</h2>

        </div>

        <div class="pull-right">

            <a class="btn btn-primary" href="{{ route('tickets.index') }}"> Back</a>

        </div>

    </div>

</div>

   

@if ($errors->any())

    <div class="alert alert-danger">

        <strong>Whoops!</strong> There were some problems with your input.<br><br>

        <ul>

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif

   

<form action="{{ route('tickets.store') }}" method="POST">

    @csrf

  

     <div class="row">

     <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Assign User:</strong>

                <select class="form-control" name="user_id">
                    <option value="">--Select Any--</option>
                    @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                    @endforeach
                </select>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Title:</strong>

                <input type="text" name="title" class="form-control" placeholder="Title">

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Description:</strong>

                <textarea class="form-control" name="description" placeholder="Description"></textarea>

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 text-center">

                <button type="submit" class="btn btn-primary">Submit</button>

        </div>

    </div>

   

</form>
</div>
@endsection