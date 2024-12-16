@extends('dashboard.app')

@section('content')


<div class="content-wrapper">
<div class="box container" style="width:500px">
    <div class="box-body">
    <h1 id="total-price" class="text-center"  >المال الحالي: {{$amount}}</h1>
    <!-- <input id="total-price" type="number" value="0"> -->
    <a href="{{url('withdraw')}}" class="mx-5">سحب النقود</a>
    </div>
    </div>
</div>

@endsection