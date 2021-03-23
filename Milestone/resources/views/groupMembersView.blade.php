@if(!Session::has('userid'))
      <script>window.location = "login";</script>
@else
@extends('layouts.app')
@section('content')
<html>
@if ($members != null)
	<table style="width: 1300px; height:100px" cellpadding="15" border="1" align="center" id="admin">
		<thead>
			<tr align="center">
				<th>Group ID</th>
				<th>Member ID</th>
				<th>Member Name</th>
				@if(Session::get('role') == 'admin')
				<th>Remove</th>
				@endif
			</tr>
		</thead>
		<tbody align="center"> 
            @foreach($members as $member)
        		<tr>
                	<td>{{$member->getGroupID()}}</td>
                	<td>{{$member->getMemberID()}}</td>
                	<td>{{$member->getMemberName()}}</td>
            		@if(Session::get('role') == 'admin')
            		<td>
                    	<form action="leaveGroup" method="post">
                        	{{csrf_field()}}
                        	<input type="hidden" name='memberID' value='{{$member->getGroupID()}}'>
                			<input type="submit" value='Remove'>
            			</form>
            		</td>
            		@endif
                </tr>
            @endforeach
		</tbody>
	</table>
@else
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">

<div class="card">

<div class="card-header">{{ __('Data') }}</div>

<div class="card-body">

<!-- ----------- repeat this card ----------- -->

<div class="form-group row">

<label for="one" class="col-md-4 col-form-label text-md-right">Data</label>

<div class="col-md-6">
<input id="one" type="text" class="form-control @error('username') is-invalid @enderror" name="one" value="{{ old('username') }}" required autocomplete="username" autofocus readonly placeholder="No members on file...">

</div>
</div>
</div>
</div>
</div>
<!-- ----------- end card ----------- --> 
        </div>
        </div>
      @endif
 
</html>
@endsection
@endif