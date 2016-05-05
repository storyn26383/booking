@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">查詢訂房紀錄</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ url('/search') }}">
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email', $email) }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-search"></i>搜尋
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <ul class="list-group">
                    @if ($bookings)
                        @forelse ($bookings as $booking)
                            <li class="list-group-item">
                                <strong>{{ $booking->date }}</strong>
                                &nbsp;-&nbsp;
                                {{ $booking->room->name }}
                                &nbsp;-&nbsp;
                                @if (App\Booking::LOCKED === $booking->status)
                                    <span class="text-danger">未完成付款</span>
                                @else
                                    <span class="text-success">已付款</span>
                                @endif
                            </li>
                        @empty
                            <li class="list-group-item">
                                查無任何訂房紀錄
                            </li>
                        @endforelse
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
