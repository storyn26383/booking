@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('errors')

            <form class="form-horizontal" action="{{ url('booking/confirm') }}" method="POST">
                <div class="panel panel-default">
                    <div class="panel-heading">請輸入訂房資料</div>

                    <div class="panel-body">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">姓名</label>

                            <div class="col-md-6">
                                <input type="name" class="form-control" name="name" value="{{ old('name') }}" required>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">電話</label>

                            <div class="col-md-6">
                                <input type="phone" class="form-control" name="phone" value="{{ old('phone') }}" required>
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">住址</label>

                            <div class="col-md-6">
                                <input type="address" class="form-control" name="address" value="{{ old('address') }}" required>
                            </div>
                        </div>
                    </div>
                </div>

                {!! csrf_field() !!}
                <input type="hidden" name="room" value="{{ $room }}">
                <input type="hidden" name="date" value="{{ $date }}">
                <button class="btn btn-primary next-step" type="submit">下一步</button>
            </form>
        </div>
    </div>
</div>
@endsection
