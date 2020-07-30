@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ $message }}
</div>
@endif

@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
	{{ $message }}
</div>
@endif

@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('info'))
<div class="alert alert-info alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<strong>{{ $message }}</strong>
</div>
@endif
@if ($message = Session::get('password_input_fail'))
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{{ $message }}</strong>
	</div>
@endif
@if ($message = Session::get('diff_phone'))
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{{ $message }}</strong>
	</div>
@endif
@if ($message = Session::get('diff_email'))
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{{ $message }}</strong>
	</div>
@endif
@if ($message = Session::get('id_device_diff'))
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{{ $message }}</strong>
	</div>
@endif
@if ($message = Session::get('err'))
	<div class="alert alert-danger alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{{ $message }}</strong>
	</div>
@endif
@if ($flash=session('edit'))
	<div class="alert alert-success fade in">
		<a href="#" class="close" data-dismiss="alert"
		   aria-label="close">&times;</a>
		<strong>{{ trans('backend/donvi.success_edit') }} !</strong>
		<br>
		<br>
	</div>
@endif
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show">
	<button type="button" class="close" data-dismiss="alert">×</button>	
	<!-- <strong>{{ $message }}</strong> -->
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>	

</div>
@endif