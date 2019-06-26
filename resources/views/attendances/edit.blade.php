@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'user')

@section('head')
	<link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
	<link rel="stylesheet" href="{{ asset('/plugins/timepicker/bootstrap-timepicker.min.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Attendances
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-success">
					<div class="box-header">	
						<h3 class="box-title">Edit Attendance</h3>
					</div>
					<div class="box-body">
						{!! Form::model($attendance, ['method' => 'PATCH', 'url' => 'attendances/'.$attendance->id]) !!}
						{!! Form::hidden('id', $attendance->id) !!}
						@include('attendances.form')
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
@endsection

@section('foot')
	<script src="{{ asset('/plugins/select2/select2.min.js') }}"></script>
	<script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}"></script>
	<script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
	<script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
	<script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
	<script src="{{ asset('/plugins/timepicker/bootstrap-timepicker.min.js') }}"></script>
	<script type="text/javascript">
		$(function () {
			$('.datepicker').datepicker({
				autoclose: true
			});
			$("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
			$("[data-mask]").inputmask();
			$("select").select2({
				placeholder: "Select",
				allowClear: true
			});
			$(".timepicker").timepicker({
				showInputs: false
			});
		});
    </script>
@endsection