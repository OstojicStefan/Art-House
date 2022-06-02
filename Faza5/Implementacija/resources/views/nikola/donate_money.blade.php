@extends('template_defined')

@section('content')
<br>
<br>
<br>
<div style="text-align: center">
<form name='depositform' action="{{route('donate_money_submit',['idexh' => $idexh ])}}" method="GET">
    Enter the desired amount of money <br> <input type="text" name="amount"><br>
    @error('amount')
        <font color='red'>{{ $message }}</font><br>
    @enderror
    <input type="submit" value="Donate" style="margin-top: 30px">
</form>
</div>
@endsection