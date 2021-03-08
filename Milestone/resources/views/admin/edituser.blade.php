@php 
use App\Services\Business\AdminService;
$id = $editid; 
$service = new AdminService();
$user = $service->findById($id);

@endphp
@extends('layouts.app')

@section('content')
<!--  //Chris King
//2/15/2020
//editUser blade file -->
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="csrf-token" content="{{ csrf_token() }}">
</html>
@if(!Session::has('userid'))
      <script>window.location = "login";</script>
@else
@php
$service = new AdminService();
$history = $service->retrieveHistory($id);
$skills = $service->retrieveSkills($id);
$education = $service->retrieveEducation($id);
function inc($matches) {
    return ++$matches[1];
}

$i = 0;

$uI = "user0";
$uL = "Property 0";

$hI = "history0";
$hL = "History 0";

$sI = "skills0";
$sL = "Skill 0";

$eI = "education0";
$eL = "Education 0";

$hIdentity = "historyid0";
$eIdentity = "educationid0";
$sIdentity = "skillid0";

@endphp
<!-- loop through history, assign new form group col -->
<!-- increment history, assign placeholder as history[x]->getHistory -->
<h1> Admin Interface </h1>
<style>
.flex {
display: flex;
   flex-direction: row;
}
.responsive {
  max-width: 100%;
  height: auto;
}
</style>
<div class= "responsive">
<form method="POST" action='doEdit'>
 @csrf
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<!--      ------------------ USER ----------------------------- -->

<div class="card" style="margin-top:10px">
<div class="card-header">{{ __('User') }}</div>

<div class="card-body">

<!-- ----------- repeat this card ----------- -->
@if ($user == null) 
@php
$uL = preg_replace_callback("|(\d+)|", "inc", $uL);
$uI = preg_replace_callback("|(\d+)|", "inc", $uI);
@endphp
<div class="form-group row">

<label for="userid" class="col-md-4 col-form-label text-md-right">ID</label>

<div class="col-md-6">
<input id="userid" type="text" class="form-control @error('username') is-invalid @enderror" name="userid" value="{{ old('username') }}" required autocomplete="username" autofocus readonly placeholder="No Data Filed...">

</div>
</div>
<!-- ----------- load data ----------- -->
@else
@foreach ($user as $key => $value)
@php

$uL = preg_replace_callback("|(\d+)|", "inc", $uL);
$uI = preg_replace_callback("|(\d+)|", "inc", $uI);
@endphp
<input type='hidden' name='userid' id='userid' value ={{$user->getId()}}>
<div class="form-group row">

<label for="{{$uI}}" class="col-md-4 col-form-label text-md-right"> {{ ucfirst($key) }} </label>

<div class="col-md-6">
<input id="{{$uI}}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{$uI}}" value="{{$value}}" required autocomplete="username" autofocus value="{{$value}}">

@error('username')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>

</div>

@endforeach
@endif
<!-- ----------- end card ----------- --> 
        </div>
        </div>
        
<!--     - - - - - - - - - -HISTORY -- - -  - - - - -             -->
<div class="card" style="margin-top:10px">

<div class="card-header">{{ __('History') }}</div>

<div class="card-body">

<!-- ----------- repeat this card ----------- -->
@if ($history == null) 
@php
$hI = preg_replace_callback("|(\d+)|", "inc", $hI);
$hL = preg_replace_callback("|(\d+)|", "inc", $hL);
$hIdentity = preg_replace_callback("|(\d+)|", "inc", $hIdentity);
@endphp
<div class="form-group row">

<label for="{{$hL}}" class="col-md-4 col-form-label text-md-right">{{ $hL }}</label>

<div class="col-md-6">
<input id="{{$hI}}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{$hL}}" value="{{ old('username') }}" required autocomplete="username" autofocus readonly placeholder="No history registered...">

</div>
</div>
<!-- ----------- load data ----------- -->
@else
@for ($x = 0; $x < count($history); $x++)
@php
$hI = preg_replace_callback("|(\d+)|", "inc", $hI);
$hL = preg_replace_callback("|(\d+)|", "inc", $hL);
$hIdentity = preg_replace_callback("|(\d+)|", "inc", $hIdentity);
@endphp

<div class="form-group row">

<label for="{{$hI}}" class="col-md-4 col-form-label text-md-right">{{ $hL }}</label>

<div class="col-md-6">
<input id="{{$hI}}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{$hI}}" value="{{$history[$x]->getHistory()}}" required autocomplete="username" autofocus value="{{$history[$x]->getHistory()}}">

@error('username')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
<div class="flex" style="margin-right:5px">
<div>
       <input type = 'hidden' name = '_token' value = '" . csrf_token() . "'>
       <button type='submit' id = 'delete' name='action' value="dH" class="btn btn-primary">-</button>
       <input type='hidden' name={{$hIdentity}} id={{$hIdentity}} value="{{$history[$x]->getId()}}"></input>
</div>
  
</div>
</div>

@endfor
@endif
<!-- ----------- end card ----------- --> 
        </div>
        </div>
      
		
<!--  -->



<!--      ------------------ SKILLS ----------------------------- -->

<div class="card" style="margin-top:10px">
<div class="card-header">{{ __('Skills') }}</div>

<div class="card-body">

<!-- ----------- repeat this card ----------- -->
@if ($skills == null) 
@php
$sI = preg_replace_callback("|(\d+)|", "inc", $sI);
$sL = preg_replace_callback("|(\d+)|", "inc", $sL);
@endphp
<div class="form-group row">

<label for="{{$sL}}" class="col-md-4 col-form-label text-md-right">{{ $sL }}</label>

<div class="col-md-6">
<input id="{{$sI}}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{ $sI }}" value="{{ old('username') }}" required autocomplete="username" autofocus readonly placeholder="No skills registered...">

</div>
</div>
<!-- ----------- load data ----------- -->
@else
@for ($x = 0; $x < count($skills); $x++)
@php
$sI = preg_replace_callback("|(\d+)|", "inc", $sI);
$sL = preg_replace_callback("|(\d+)|", "inc", $sL);
$sIdentity = preg_replace_callback("|(\d+)|", "inc", $sIdentity);
@endphp

<div class="form-group row">

<label for="{{$sL}}" class="col-md-4 col-form-label text-md-right">{{ $sL }}</label>

<div class="col-md-6">
<input id="{{$sI}}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{ $sI }}" value="{{$skills[$x]->getSkill()}}" required autocomplete="username" autofocus  placeholder="{{$skills[$x]->getSkill()}}">

@error('username')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
<div class="flex" style="margin-right:5px">
<div>
       <input type = 'hidden' name = '_token' value = '" . csrf_token() . "'>
       <button type='submit' id = 'delete' name='action' value="dS" class="btn btn-primary">-</button>
       <input type='hidden' name={{$sIdentity}} id={{$sIdentity}} value="{{$skills[$x]->getId()}}"></input>
</div>
  
</div>
</div>

@endfor
@endif
<!-- ----------- end card ----------- --> 
        </div>
        </div>
        

<!--  -->




<!--      ------------------ EDUCATION ----------------------------- -->

<div class="card" style="margin-top:10px">
<div class="card-header">{{ __('Education') }}</div>

<div class="card-body">

<!-- ----------- repeat this card ----------- -->
@if ($education == null) 
@php
$eI = preg_replace_callback("|(\d+)|", "inc", $eI);
$eL = preg_replace_callback("|(\d+)|", "inc", $eL);
@endphp
<div class="form-group row">

<label for="{{$eI}}" class="col-md-4 col-form-label text-md-right">{{ $eL }}</label>

<div class="col-md-6">
<input id="{{$eI}}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{ $eI }}" value="{{ old('username') }}" required autocomplete="username" autofocus readonly placeholder="No education registered...">

</div>
</div>
<!-- ----------- load data ----------- -->
@else
@for ($x = 0; $x < count($education); $x++)
@php
$eI = preg_replace_callback("|(\d+)|", "inc", $eI);
$eL = preg_replace_callback("|(\d+)|", "inc", $eL);
$eIdentity = preg_replace_callback("|(\d+)|", "inc", $eIdentity);
@endphp

<div class="form-group row">

<label for="{{$eI}}" class="col-md-4 col-form-label text-md-right">{{ $eL }}</label>

<div class="col-md-6">
<input id="{{$eI}}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{ $eI }}" value="{{$education[$x]->getEducation()}}" required autocomplete="username" autofocus value="{{$education[$x]->getEducation()}}">

@error('username')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
</div>
<div class="flex" style="margin-right:5px">
<div>
       <input type = 'hidden' name = '_token' value = '" . csrf_token() . "'>
       <button type='submit' id = 'delete' name='action' value="dE" class="btn btn-primary">-</button>
       <input type='hidden' name={{$eIdentity}} id={{$eIdentity}} value ="{{$education[$x]->getId()}}"></input>
</div>
  
</div>
</div>

@endfor
@endif
<!-- ----------- end card ----------- --> 
        </div>
        </div>
        

<!--  -->
        
          <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
         @csrf
        <button type="submit" name="action" value='post' style="margin-top:10px" class="btn btn-primary">
        {{ __('Edit User') }}
        </button>
        </div>
        </div>
        </div>
        </div>
        </div>
        
        
        
        
        
        
    </form>
      </div>
    @endif 
    @endsection