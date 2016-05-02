@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('errors')

            <form action="{{ url('booking/data') }}" method="GET">
                <div class="panel panel-default">
                    <div class="panel-heading">請選擇想要的房型</div>

                    <div class="panel-body">
                        @foreach ($rooms as $room)
                            <div class="radio">
                                <label>
                                    <input class="room-radio" type="radio" name="room" value="{{ $room->id }}" required {{ $room->canBooking ? '' : 'disabled' }}>
                                    @if ($room->canBooking)
                                        {{ $room->name }}，{{ $room->price }} 元
                                    @else
                                        <del>{{ $room->name }}，已被訂走</del>
                                    @endif
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <input type="hidden" name="date" value="{{ $date }}">
                <button class="btn btn-primary next-step hide" type="submit">下一步</button>
            </form>
        </div>
    </div>
</div>
@endsection
