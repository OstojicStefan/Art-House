<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/opste.css') }}" >
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Exhibition.css') }}" >

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>

    <script src="{{asset('js/stefan/Exhibition.js')}}"></script>

</head>
<body onload="inicijalizujIzlozbu()">
    <div class="row">
        <div class="col-sm-12">
            <h1>Arrange your exhibition</h1>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">

        </div>
        <div class="col-sm-6">
            <form action="{{route('createExhibitionSubmit')}}" method="post" name="create_exhibition">
                @csrf
            <table id="tabela_uredjivanje">
                <tr>

                </tr>
            </table>
            <hr>
            
            <table id="tabela_finalno" class="table table-striped table-dark">
                <tr>
                    <td>
                        Exhibition name
                    </td>
                    <td>
                        <input type="text" name="exhibitionName">
                    </td>
                </tr>
                <tr>
                    <td>Allow donations for the duration of the exhibition </td>
                    <td><input type="checkbox" name="allowDonations"></td>
                </tr>
                <tr>
                    <td>Accompanying music</td>
                    <td><select value="" name="songChoice">
                        <option value="">no song</option>
                        <option value="">song 1</option>
                        <option value="">song 2</option>
                    </select></td>
                </tr>
                <tr>
                    <td>Time of the exhibition</td>
                    <td><input id="vreme_izlozbe" type="datetime-local" name="exhibitionTime"></td>
                </tr>
                <tr class="centriraj">
                    <td colspan="2"><button class="btn btn-secondary" onclick="kreirajIzlozbu()">Done</button></td>
                </tr>
            </table>
            </form>
        </div>
        <div class="col-sm-3">
            
        </div>
    </div>
</body>
</html>