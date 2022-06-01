@extends('template_defined')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/chat.css') }}" >
<script src="{{asset('js/stefan/Exhibition.js')}}"></script>

<div class="exhibition_header">
    <div class="ex_tittle">
        <h1>{{ $exhibition->Name }}</h1> 
    </div>
    <div class="ex_organizer">
        <h2>Organizer: {{ $organizer->Username }}</h2>
    </div>
</div>
@if($exhibition->IsActive == '1')
    <div class="exhibition_content">

    
    
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @php
            $index=1;
            @endphp
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            @foreach ( $images as $image)
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $index }}"   aria-label="Slide {{ $index + 1}}"></button>
            @php
                $index = $index + 1;
            @endphp
            @endforeach
          </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{url('slike/doniraj.png')}}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Author: {{ $authors[0]->Username }}</h5>
                <p>Description:{{ $descriptions[0] }}</p>
            </div>
          </div>
          @php
          $index=0;
          @endphp
          @foreach ( $images as $image)
          <div class="carousel-item">
            <img src="data:image/jpg;base64,{{ chunk_split($images[$index]->Imagee) }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
                <h5>Author: {{ $authors[$index]->Username }}</h5>
                <p>Description:{{ $descriptions[$index] }}</p>
            </div>
          </div>
          @php
              $index = $index + 1;
          @endphp
          @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
        <div class="exhibition_menu">
            <iframe width="180" height="100" src="{{ $exhibition->Song }}" title="YouTube video player" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" class="video_player"></iframe>

            <div class="chatbox">
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
            </div>
            <div class="ratebox">
                <div class="rate">
                    <input type="radio" id="star5" name="rate" value="5" />
                    <label for="star5" title="text">5 stars</label>
                    <input type="radio" id="star4" name="rate" value="4" />
                    <label for="star4" title="text">4 stars</label>
                    <input type="radio" id="star3" name="rate" value="3" />
                    <label for="star3" title="text">3 stars</label>
                    <input type="radio" id="star2" name="rate" value="2" />
                    <label for="star2" title="text">2 stars</label>
                    <input type="radio" id="star1" name="rate" value="1" />
                    <label for="star1" title="text">1 star</label>
                  </div>
            </div>

            @if($exhibition->FlagDonations == '1')
            <div class="donatebox">
                <div class="bid_menu_item">
                    <a href="">
                        <img src="{{url('slike/doniraj.png')}}" alt="donation">
                        <p>Donate</p>
                    </a>
                </div> 
            </div>
           @endif
            <div class="exitbox">
                <div class="bid_menu_item">
                    <a href="{{ route('exhibitions') }}">
                        <img src="{{url('slike/izadji.png')}}" alt="exit">
                        <p>Exit</p>
                    </a>
                </div>
            </div>
            @if($has_privileges == true)
            <div class="delete_exh_box">
                <div class="bid_menu_item">
                    <a href="">
                        <img src="{{url('slike/doniraj.png')}}" alt="donation">
                        <p>Delete</p>
                    </a>
                </div> 
            </div>   
           @endif
        </div>
    @else
    <div class="scheduled_date">
        This exhibition is scheduled for: {{ $exhibition->Date }}
    </div>
    @endif
</div>
@endsection