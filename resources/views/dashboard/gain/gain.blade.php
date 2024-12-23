@extends('dashboard.app')

@section('content')


<div class="content-wrapper">
<div class="box container" style="width:500px">
    <div class="box-body">
    <h1 id="total-price" class="text-center"  > مكسب اليوم  : {{$amount}}</h1>
    <!-- <input id="total-price" type="number" value="0"> -->
    <a href="{{url('zerogain')}}" class="mx-5"> تصفير المكسب</a>
    </div>
    </div>
</div>

@endsection