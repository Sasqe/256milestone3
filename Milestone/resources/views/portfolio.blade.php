

@extends('layouts.app')

@section('content')
<!-- 
//Chris King
//2/15/2020
//profile blade file
 -->
 <style>
  pbutton {
                display: inline-block;
                text-align: right;
                
            }
 </style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Portfolio') }}</div>

                <div class="card-body">
                    <form method="POST" action='doHistory'>
                         <!-- CSRF Token -->
    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="history" class="col-md-4 col-form-label text-md-right">{{ __('History') }}</label>

                            <div class="col-md-6">
                                <input id="history" type="text" class="form-control @error('history') is-invalid @enderror" name="history" value="{{ old('history') }}" placeholder="Wendy's..." required autocomplete="history" autofocus>

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                  
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Work Experience') }}
                                </button>
                          
                            </div>
                        </div>
				</form>
					  <form method="POST" action='doSkill'>
					   <!-- CSRF Token -->
    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="skill" class="col-md-4 col-form-label text-md-right">{{ __('Skill') }}</label>

                            <div class="col-md-6">
                                <input id="skill" type="text" class="form-control @error('skill') is-invalid @enderror" name="skill" value="{{ old('lastname') }}" placeholder="Haste..."  required autocomplete="skill">

                                @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                  
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Skill') }}
                                </button>
                           
                            </div>
                        </div>
		</form> 
		  <form method="POST" action='doEducation'>
 <!-- CSRF Token -->
    {{ csrf_field() }}
                        <div class="form-group row">
                            <label for="education" class="col-md-4 col-form-label text-md-right">{{ __('Education') }}</label>

                            <div class="col-md-6">
                                <input id="education" type="text" class="form-control @error('education') is-invalid @enderror" name="education" placeholder="Bachelor's..."  required autocomplete="new-education">

                                @error('education')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                   
                            
                          <div class="pbutton">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Education') }}
                                </button>  
                        
                        
                        </div>
                            </div>
                        </div>

           
                    </form>
                </div>
            </div>
            <form method= "GET" action="portfolio">
            <div class="pbutton">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('View Profile') }}
                                </button>
                                </div>
                                </form>
        </div>
    </div>
</div>
@endsection

