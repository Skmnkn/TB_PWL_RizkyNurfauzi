@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Profile Settings</h1>
@stop

@section('content')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Profile Settings') }}</div>
                <div class="card-body">
                @foreach($users as $i)
                    <form method="POST" action="{{route('profile.update',$i->id)}}">
                        @csrf        
                        @method('PUT')
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" class="form-control" id="name" aria-describedby="emailHelp"
                                placeholder="Name" name="name" value="{{$i->name}}">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="username"
                                name="username" value="{{$i->username}}">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="email" name="email"
                            value="{{$i->email}}">
                        </div>
                        @endforeach
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
console.log('Hi!');
</script>
@stop