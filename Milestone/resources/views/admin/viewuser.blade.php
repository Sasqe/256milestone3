@php 
use App\Services\Business\AdminService;
@endphp
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</html>
@if(!Session::has('userid'))
      <script>window.location = "login";</script>
@else
@php
$user = Session::get('user');
$history = Session::get('history');
$skills = Session::get('skills');
$education = Session::get('education');
function inc($matches) {
    return ++$matches[1];
}

$labels = Array();
array_push($labels, "First Name", "Last Name", "Username", "Email", "Password", "Role", "Age", "Race", "Address");
$i = 0;

$uI = "user0";
$uL = "Property 0";
$hI = "history0";
$hL = "History 0";

$sI = "skills0";
$sL = "Skill 0";

$eI = "education0";
$eL = "Education 0";

@endphp
<!-- loop through history, assign new form group col -->
<!-- increment history, assign placeholder as history[x]->getHistory -->
@include('layouts.app')
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
<form method="GET" action='displayadmin'>



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
$hI = preg_replace_callback("|(\d+)|", "inc", $hI);
$hL = preg_replace_callback("|(\d+)|", "inc", $hL);
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

<div class="form-group row">

<label for=" {{ $uI }} " class="col-md-4 col-form-label text-md-right"> {{ ucfirst($key) }} </label>

<div class="col-md-6">
<input id=" {{ $uI }} " type="text" class="form-control @error('username') is-invalid @enderror" name=" {{ $uI }} " required autocomplete="username" autofocus readonly placeholder=" {{ $value }} ">

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
@endphp
<div class="form-group row">

<label for="{{ $hL }}" class="col-md-4 col-form-label text-md-right">History</label>

<div class="col-md-6">
<input id="{{ $hI }}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{ $hL }}" value="{{ old('username') }}" required autocomplete="username" autofocus readonly placeholder="No job experience filed...">

</div>
</div>
<!-- ----------- load data ----------- -->
@else
@for ($x = 0; $x < count($history); $x++)
@php
$hI = preg_replace_callback("|(\d+)|", "inc", $hI);
$hL = preg_replace_callback("|(\d+)|", "inc", $hL);
@endphp

<div class="form-group row">

<label for="{{ $hL }}" class="col-md-4 col-form-label text-md-right">{{ $hL }}</label>

<div class="col-md-6">
<input id="{{ $hI }}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{ $hL }}" value="{{ old('username') }}" required autocomplete="username" autofocus readonly placeholder="{{ $history[$x]->getHistory() }}">

@error('username')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
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

<label for="{{ $sL }}" class="col-md-4 col-form-label text-md-right">Skills</label>

<div class="col-md-6">
<input id="{{ $sI }}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{ $sI }}" value="{{ old('username') }}" required autocomplete="username" autofocus readonly placeholder="No skills filed...">

</div>
</div>
<!-- ----------- load data ----------- -->
@else
@for ($x = 0; $x < count($skills); $x++)
@php
$sI = preg_replace_callback("|(\d+)|", "inc", $sI);
$sL = preg_replace_callback("|(\d+)|", "inc", $sL);
@endphp

<div class="form-group row">

<label for="{{ $sL }}" class="col-md-4 col-form-label text-md-right">{{ $sL }}</label>

<div class="col-md-6">
<input id="{{ $sI }}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{ $sI }}" value="{{ old('username') }}" required autocomplete="username" autofocus readonly placeholder=" {{ $skills[$x]->getSkill() }} ">

@error('username')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
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

<label for="{{ $eL }}" class="col-md-4 col-form-label text-md-right">Education</label>

<div class="col-md-6">
<input id="{{ $eI }}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{ $eI }}" value="{{ old('username') }}" required autocomplete="username" autofocus readonly placeholder="No education filed...">

</div>
</div>
<!-- ----------- load data ----------- -->
@else
@for ($x = 0; $x < count($education); $x++)
@php
$eI = preg_replace_callback("|(\d+)|", "inc", $eI);
$eL = preg_replace_callback("|(\d+)|", "inc", $eL);
@endphp

<div class="form-group row">

<label for="{{ $eL }}" class="col-md-4 col-form-label text-md-right">{{ $eL }}</label>

<div class="col-md-6">
<input id="{{ $eI }}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{ $eI }}" value="{{ old('username') }}" required autocomplete="username" autofocus readonly placeholder=" {{ $education[$x]->getEducation() }} ">

@error('username')
<span class="invalid-feedback" role="alert">
<strong>{{ $message }}</strong>
</span>
@enderror
  
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
        <button type="submit" name="action" value = 'return' style="margin-top:10px" class="btn btn-primary">
        {{ __('Return To Users') }}
        </button>
        </div>
        </div>
        </div>
        </div>
        </div>
        
        
        
        
        
        
    </form>
      </div>
    @endif 