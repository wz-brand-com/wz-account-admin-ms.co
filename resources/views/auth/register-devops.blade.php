@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8  col-md-offset-2">
            <div class="card  mt-2">
                <div class="card-header bg-dark text-white">
                    Student Registration
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('create.firm.user') }}" id="create-hospital-user"
                        class="col-lg-10 col-sm-12">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" id="add_h_name" placeholder="Name"
                                required>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <input id="add_h_email" type="email" class="form-control" name="email"
                                value="{{ old('email') }}" placeholder="Enter email" required>
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <p class="text-danger"><strong>{{ $errors->first('email') }}</strong></p>
                            </span>
                            @endif
                        </div>
                        <!-- <div class="form-group" style="display: none">
                            <label class="mhn-switch">
                                <input type="checkbox" id="admin_approved" name="admin_approved" checked>
                                <span class="slider round"></span>
                            </label>
                            <span class="" id="admin_approved_txt">Approved</span>
                        </div> -->
                        
                        <!-- <div class="form-group">
                            <p>
                                Currency: <strong><span id="add_h_currency_span"></span>&nbsp;<span
                                        id="add_h_currency_code_span"></span>&nbsp;(<span
                                        id="add_h_currency_symbol_span"></span>)</strong>
                            </p>
                        </div> -->
                        <div class="form-group">
                                <!-- <div class="col-4">
                                    <input class="form-control" type="text" name="dialCode" id="add_h_dial_code"
                                        placeholder="Dial code" value="" disabled>
                                </div> -->
                                    <!-- <input class="form-control" type="text" name="phone" id="add_h_phone"
                                        placeholder="Phone" required> -->
                        </div>
                        <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                           
                                {!! app('captcha')->display() !!}

                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                               @endif
                       </div>
                        <button type="button" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/blade-components/add_student_user.js') }}"></script>
<script type="text/javascript">
$.sidebar.initSideBar();
$.sp_globals.toggleSPLoadingSpinner(false);
</script>
@endsection