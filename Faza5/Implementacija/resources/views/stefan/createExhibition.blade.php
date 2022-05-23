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
<body>
    
    <div class="row">
        <div class="col-sm-12">
            <table id="moja_tabela" class="table centerEx">
                <tr>
                    <th colspan="3">My pictures</th>
                </tr>
                    
                @foreach ($images->chunk(3) as $row )
                <tr>
                    @foreach ($row as $image)
                    <td>
                        <img src="data:image/jpg;base64,{{ chunk_split($image->Imagee) }}" class="img-thumbnail img-fluid">
                    </td> 
                    @endforeach
                </tr>
                @endforeach
                    
                <tr>
                    <td colspan="3">
                        <button onclick="dodajSlike()" class="btn btn-warning">Next</button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
   
</body>
</html>