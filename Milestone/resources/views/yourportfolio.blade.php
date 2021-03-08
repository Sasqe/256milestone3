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
$id = Session::get('userid'); 
$service = new AdminService();

$history = $service->retrieveHistory($id);
$skills = $service->retrieveSkills($id);
$education = $service->retrieveEducation($id);
function inc($matches) {
    return ++$matches[1];
}

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
<form method="GET" action='doPortfolio'>

<!--     - - - - - - - - - -HISTORY -- - -  - - - - -             -->

<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">

<div class="card">

<div class="card-header">{{ __('History') }}</div>

<div class="card-body">

<!-- ----------- repeat this card ----------- -->
@if ($history == null) 
@php
$hI = preg_replace_callback("|(\d+)|", "inc", $hI);
$hL = preg_replace_callback("|(\d+)|", "inc", $hL);
@endphp
<div class="form-group row">

<label for="{{ $hL }}" class="col-md-4 col-form-label text-md-right">{{ $hL }}</label>

<div class="col-md-6">
<input id="{{ $hI }}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{ $hL }}" value="{{ old('username') }}" required autocomplete="username" autofocus readonly placeholder="Add some history...">

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
<div class="flex" style="margin-right:5px">
<div>
       <input type = 'hidden' name = '_token' value = '" . csrf_token() . "'>
       <button type='submit' id = 'delete' name='action' value="dH" class="btn btn-primary">-</button>
       <input type='hidden' name='historyid' id='historyid' value = "{{ $history[$x]->getId() }} "></input>
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

<div class="card">
<div class="card-header">{{ __('Skills') }}</div>

<div class="card-body">

<!-- ----------- repeat this card ----------- -->
@if ($skills == null) 
@php
$sI = preg_replace_callback("|(\d+)|", "inc", $sI);
$sL = preg_replace_callback("|(\d+)|", "inc", $sL);
@endphp
<div class="form-group row">

<label for="{{ $sL }}" class="col-md-4 col-form-label text-md-right">{{ $sL }}</label>

<div class="col-md-6">
<input id="{{ $sI }}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{ $sI }}" value="{{ old('username') }}" required autocomplete="username" autofocus readonly placeholder="Add some skills...">

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
<div class="flex" style="margin-right:5px">
<div>
       <input type = 'hidden' name = '_token' value = '" . csrf_token() . "'>
       <button type='submit' id = 'delete' name='action' value="dS" class="btn btn-primary">-</button>
       <input type='hidden' name='skillid' id='skillid' value = "{{ $skills[$x]->getId() }} "></input>
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

<div class="card">
<div class="card-header">{{ __('Education') }}</div>

<div class="card-body">

<!-- ----------- repeat this card ----------- -->
@if ($education == null) 
@php
$eI = preg_replace_callback("|(\d+)|", "inc", $eI);
$eL = preg_replace_callback("|(\d+)|", "inc", $eL);
@endphp
<div class="form-group row">

<label for="{{ $eL }}" class="col-md-4 col-form-label text-md-right">{{ $eL }}</label>

<div class="col-md-6">
<input id="{{ $eI }}" type="text" class="form-control @error('username') is-invalid @enderror" name="{{ $eI }}" value="{{ old('username') }}" required autocomplete="username" autofocus readonly placeholder="Add some education...">

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
<div class="flex" style="margin-right:5px">
<div>
       <input type = 'hidden' name = '_token' value = '" . csrf_token() . "'>
       <button type='submit' id = 'delete' name='action' value="dE" class="btn btn-primary">-</button>
       <input type='hidden' name='educationid' id='educationid' value = " {{ $education[$x]->getId() }} "></input>
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
        <button type="submit" name="action" value = 'post' style="margin-top:10px" class="btn btn-primary">
        {{ __('Update your portfolio?') }}
        </button>
        </div>
        </div>
        </div>
        </div>
        </div>
        
        
        
        
        
        
    </form>
      </div>
    @endif 