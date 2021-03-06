@extends(Auth::check() && Auth::user()->role->layout == 1 ? 'layouts.admin' : 'layouts.employee')
<script src="{{asset('dist/js/jquery.js')}}"></script>

@section('head')
    <link href="{{ asset('/plugins/iCheck/square/green.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/jQuery/themes/smoothness/jquery-ui.min.css') }}">
    <link href="{{ asset('/plugins/select2/select2.min.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('/plugins/datepicker/datepicker3.css') }}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Renew Contract
            </h1>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="box box-success">
                        <div class="box-header">
                            <h3 class="box-title"> Renew Contract </h3>
                        </div>
                        <div class="box-body">
                            <form action="{{url('renew-update')}}" method="POST">
                                {{csrf_field()}}

                                <div class="form-group">
                                    <label for="gross_amount">Select Staff</label>
                                    <select name="user_id[]" id="user_id" class="form-control staff" multiple required>
                                        @foreach($users as $staff)
                                            <option value="{{$staff->id}}">{{$staff->first_name .' '.$staff->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="reason">New Renewal Date</label>
                                    <input type="text" class="form-control" id="r_date" name="renewal_date" required>

                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Renew Contract" class="btn btn-success" id="template">
                                    <a href="{{url('/contracts')}}" class="btn btn-default">Cancel</a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('foot')
    <script src="{{ asset('/plugins/select2/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <script src="{{ asset('/plugins/iCheck/icheck.js') }}"></script>
    <script src="{{ asset('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

    <script>
        $(document).ready(function () {


            $('input').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });
        });

        $(function () {

        });
        $("#r_date").datepicker();
        $('.staff').select2();
    </script>

@endsection

