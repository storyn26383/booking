@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form action="{{ url('booking') }}" method="POST">
                <div class="panel panel-default">
                    <div class="panel-heading">請確認訂房資訊</div>

                    <div class="panel-body">
                        <p>日期：{{ $date }}</p>
                        <p>房型：{{ $room->name }}</p>
                        <p>價格：{{ $room->price }}</p>
                        <p>E-Mail：{{ $email }}</p>
                        <p>姓名：{{ $name}}</p>
                        <p>電話：{{ $phone }}</p>
                        <p>住址：{{ $address }}</p>
                    </div>
                </div>

                {!! csrf_field() !!}
                <input type="hidden" name="date" value="{{ $date }}">
                <input type="hidden" name="room" value="{{ $room->id }}">
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="name" value="{{ $name }}">
                <input type="hidden" name="phone" value="{{ $phone }}">
                <input type="hidden" name="address" value="{{ $address }}">
                <button class="btn btn-primary next-step" type="submit">前往付款</button>
            </form>
        </div>
    </div>
</div>
@endsection
