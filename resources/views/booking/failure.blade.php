@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-danger" role="alert">
                <p><strong>訂房失敗</strong></p>
                <p>可能是因為您所訂的房間已經被其它使用者訂走了。</p>
            </div>
        </div>
    </div>
</div>
@endsection
