@php
$iage = $age;
$irace = $race;
$isex = $sex;
$iaddress = $address;

@endphp
@if(!Session::has('userid'))
      <script>window.location = "login";</script>
@else
@extends('layouts.app')
@php


@endphp

@section('content')

<!-- 
//Chris King
//2/15/2020
//profile blade file
 -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action='doProfile'>
                        {{ csrf_field() }}

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address"   class="form-control" name="address" required autocomplete="username" value={{$iaddress}}>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="race" class="col-md-4 col-form-label text-md-right">{{ __('Race') }}</label>

                            <div class="col-md-6">
                                <input id="race"   class="form-control" name="race" required autocomplete="username" value={{$irace}}>
                            </div>
                        </div>
                        
                           <div class="form-group row">
                            <label for="sex" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <input id="sex"   class="form-control" name="sex" required autocomplete="username" value={{$isex}}>

                                @error('sex')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                            <div class="form-group row">
                            <label for="age" class="col-md-4 col-form-label text-md-right">{{ __('Age') }}</label>

                            <div class="col-md-6">
                                <input id="age"  class="form-control @error('age') is-invalid @enderror" name="age" required autocomplete="username" value={{$iage}}>

                                @error('age')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                         

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Profile') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endif
