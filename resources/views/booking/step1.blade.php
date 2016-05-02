@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            @include('errors')

            <div class="panel panel-default">
                <div class="panel-heading">請選擇訂房日期</div>

                <table class="table table-bordered calendar">
                    <thead>
                        <tr>
                            <th class="text-center">日</th>
                            <th class="text-center">一</th>
                            <th class="text-center">二</th>
                            <th class="text-center">三</th>
                            <th class="text-center">四</th>
                            <th class="text-center">五</th>
                            <th class="text-center">六</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($calendar as $week)
                            <tr>
                                @for ($i = 0; $i < 7; $i++)
                                    @if (isset($week[$i]))
                                        <td class="progress-bar-{{ $week[$i]->canBooking ? 'success' : 'danger' }}" data-date="{{ $week[$i]->date->format('Y-m-d') }}">
                                            {{ $week[$i]->date->format('n/j') }}
                                        </td>
                                    @else
                                        <td>&nbsp;</td>
                                    @endif
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="legends">
                <div class="legend">
                    <span class="progress-bar-danger">&nbsp;</span> 已無空房
                </div>
                <div class="legend">
                    <span class="progress-bar-success">&nbsp;</span> 尚有空房
                </div>
            </div>

            <form action="{{ url('booking/room') }}" method="GET">
                <input class="selected-date" type="hidden" name="date">
                <button class="btn btn-primary next-step hide" type="submit">下一步</button>
            </form>
        </div>
    </div>
</div>
@endsection
