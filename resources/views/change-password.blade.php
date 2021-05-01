@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Change Password</h1>
@stop

@section('content')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Change Password') }}</div>
                <div class="card-body">
                    @foreach($data as $i)
                    <form method="POST" action="{{route('update.password')}}">
                        @csrf
                        @method('POST')
                        <input type="text" class="form-control" aria-describedby="emailHelp" hidden value="{{$i->id}}"
                            name="id" required>
                        <div class="form-group">
                            <label for="Password">Password</label>
                            <input type="password" class="form-control" aria-describedby="emailHelp" placeholder="*****"
                                name="password" required>
                        </div>
                        <div class="form-group">
                            <label for="ConfirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" required minglength="5"  placeholder="*****" name="password_confirmation"  minglength="5">
                        </div>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </form>
                    @endforeach
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