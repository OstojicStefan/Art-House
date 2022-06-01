@extends('template_defined')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/chat.css') }}" >
<script src="{{asset('js/stefan/Exhibition.js')}}"></script>

<br>
<br>
<br>
<h1>{{ $exhibition->Name }}</h1>
@if( $exhibition->IsActive  == 't')
<p>Active</p>
dd{{ $exhibition }}
@else
<p>Expired</p>
dd{{ $exhibition }}
@endif
<br>
@foreach($images as $image)
    dd{{ $image }}
@endforeach


<div class="row">
    <div col-sm-12>
      <div class="chatWrapper">
        <div id="chat_box" class="chatDiv">
        @foreach ($chatbox as $chatmsg )
          @if ($chatmsg->IDUser==Session::get('IDUser'))
            <div class="container darker">
              <img src="/slike/profile_picture.jpg" alt="{{$chatmsg->IDUser}}" class="right">
              <p>{{$chatmsg->Text}}</p>
              <span class="time-left"></span>
            </div>
          @else
          <div class="container">
            <img src="/slike/profile_picture.jpg" alt="{{$chatmsg->IDUser}}"><b>{{$chatmsg->findUsername($chatmsg->IDUser)}}</b>
            <p>{{$chatmsg->Text}}</p>
            <span class="time-right"></span>
          </div>
          @endif
          @endforeach
        </div>
      </div>
          <form id="send_message" action="{{route('sendMessageSubmit')}}" method="post" name="send_message">
            @csrf
            <div>
                <input id="msg_input" type="text" size="45" name="textMsg"><button onclick="" id="send-button" class="btn btn-warning btn-sm">Send</button>
                <input type="hidden" value="{{Session::get('IDUser')}}" name="userID">
                <input type="hidden" value="{{$exhibition->IDExh}}" name="exhID">
            </div>
          </form>
    </div>
</div>






@endsection