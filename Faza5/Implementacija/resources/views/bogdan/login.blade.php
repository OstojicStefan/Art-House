<!-- Bogdan Arsic-->
@extends('template_defined')

@section('content')
<div class="row">
    <div class="col-sm-12 center">
        <form>
            <label for="username">Username: </label><br>
                <input type="text" maxlength="40" id="username" name="username"><br><br>
            
                <label for="password" >Password:</label><br>
                <input type="password" maxlength="40" id="password" name="password"><br><br>
            
                <a href="../myAccount.html" class="button">Log in</a><br>
                        
                <a href = "registracija.html" > Register </label><br>
                <a href = "../index.html" > Continue as guest </label>
        </form>
    </div>
</div>
@endsection
