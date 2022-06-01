@extends('template_defined')

@section('content')  

<link rel="stylesheet" type="text/css" href="{{ asset('css/opste.css') }}" >
<link rel="stylesheet" type="text/css" href="{{ asset('css/Exhibition.css') }}" >
<script src="{{asset('js/stefan/Exhibition.js')}}"></script>

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
@endsection