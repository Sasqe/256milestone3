@php 
use App\Services\Business\AdminService;
@endphp
@if(!Session::has('userid'))
      <script>window.location = "login";</script>
@else
@php
$id = Session::get('userid'); 
$service = new AdminService();
$user = $service->findById($id);

@endphp

@include('layouts.app')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
<div class="card-header">{{ __('Profile') }}</div>

<div class="card-body">
<form method="GET" action='profile'>


<div class="form-group row">
<label for="username" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

<div class="col-md-6">
<input id="firstname" type="text" class="form-control @error('username') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="username" autofocus readonly placeholder={{$user->getFirstname()}}>

@error('username')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>

<div class="form-group row">
<label for="lastname" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

<div class="col-md-6">
<input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" readonly placeholder={{$user->getLastname()}}
>

@error('lastname')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
</div>
@if($user->getAddress())
    <div class="form-group row">
    <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
    
    <div class="col-md-6">
    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" required autocomplete="new-address" readonly value="{{$user->getAddress()}}" >
    
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
    <input id="race" type="race" class="form-control" name="race" required autocomplete="race" readonly value="{{$user->getRace()}}" >
    </div>
    </div>
    
    <div class="form-group row">
    <label for="sex" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>
    
    <div class="col-md-6">
    <input id="sex" type="sex" class="form-control @error('sex') is-invalid @enderror" name="sex" required autocomplete="sex" readonly value={{$user->getSex()}}>
    
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
    <input id="age" type="age" class="form-control @error('age') is-invalid @enderror" name="age" required autocomplete="age" readonly value={{$user->getAge()}}>
    
    @error('age')
    <span class="invalid-feedback" role="alert">
    <strong>{{ $message }}</strong>
    </span>
    @enderror
    </div>
    </div>
    
    @else
        <div class="form-group row">
        <label for="pleaseupdate" class="col-md-4 col-form-label text-md-right">::</label>
        
        <div class="col-md-6">
        <input id="age" type="age" class="form-control @error('age') is-invalid @enderror" name="age" required autocomplete="age" readonly placeholder="Update To File Demographics...">
        
        @error('age')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
        </div>
        </div>
        @endif
        
        <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
        {{ __('Update your profile?') }}
        </button>
        </div>
        </div>
        </form>
        </div>
        </div>
        </div>
        </div>
        </div>
    @endif
        