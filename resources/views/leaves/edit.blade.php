@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')

@section('head')
	<link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet" />
	<link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
	<section class="content-header">
		<h1>
		Leaves
		</h1>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="box box-success">
					<div class="box-header">	
						<h3 class="box-title">Edit Leave</h3>
					</div>
					<div class="box-body">
						{!! Form::model($leave, ['method' => 'PATCH', 'url' => 'leaves/'.$leave->id, 'id' => 'editForm']) !!}
						{!! Form::hidden('id', $leave->id) !!}
						@include('leaves.form')
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
	<script type="text/javascript">
		$(function () {
			$('#editForm').on('submit', function (event) {
				$(this).find('.form-control').removeAttr('disabled');
			});

			$('.datepicker').datepicker({
				autoclose: true
			});
			$("#datemask").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
			$("[data-mask]").inputmask();
			
			$("select").select2({
				placeholder: "Select",
				allowClear: true
			});
			
			{{--$( "#leave_type" ).autocomplete({--}}
				{{--source: "{{ asset('autocomplete/leave_types')}}",--}}
				{{--minLength: 1,--}}

				{{--select: function(event, ui) {--}}
					{{--$('#leave_type').val(ui.item.value);--}}
					{{--$('#leave_type_id').val(ui.item.id);--}}
				{{--}--}}
			{{--});--}}
		});
    </script>
@endsection
