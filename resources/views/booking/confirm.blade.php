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

                <div class="panel panel-warning">
                    <div class="panel-heading">付款注意事項</div>

                    <div class="panel-body">
                        <p>本系統使用智付寶第三方支付金流平台的<strong class="text-danger">測試環境</strong>，所以您可以放心使用任何交易方式，並不會真的付款唷。</p>
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
