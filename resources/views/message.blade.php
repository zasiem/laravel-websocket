@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-md-offset-2">
            <div class="card card-default">
                <div class="card-header">{{$user->name}}</div>
                <Message 
                v-bind:receiver={{ request()->segment(count(request()->segments())) }}
                v-bind:sender={{ Auth::user()->id }}    
                >
                </Message>
            </div>
        </div>
    </div>
</div>
@endsection
