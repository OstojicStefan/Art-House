@extends('template_defined')

@section('content')
<br>
<br>
<br>
<form name='depositform' action="{{route('deposit_money_submit')}}" method="GET">
    Enter the desired amount of money: <input type="text" name="amount"><br>
    @error('amount')
        <font color='red'>{{ $message }}</font><br>
    @enderror
    <input type="submit" value="Deposit">
</form>
@endsection