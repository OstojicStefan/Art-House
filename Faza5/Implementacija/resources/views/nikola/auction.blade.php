@extends('template_defined')

@section('content')
<div class="auction_content">

    <div class="image_info">
        <div class="info_head">
            <div class="auction_name">
                <h1>{{ $auction->Name }}</h1>
            </div>  
            <div class="image_author">
                <h2>{{ $auction->Author }}</h2>
            </div>
        </div>
        <div class="info_body">
            <div class="image_on_auction">
                @if($isPhysical)
                    <img src="data:image/jpg;base64,{{ chunk_split($image->Imagee) }}">
                @else
                <div class="watermark">
                    <img src="data:image/jpg;base64,{{ chunk_split($image->Imagee) }}">
                </div>
                @endif
            </div>
            <div class="image_description">
                <p> Image description: {{ $auction->Description }}</p>
                <p>Image tag: {{ $tag }}</p>
                <p>Year: {{ $auction->Year }}</p>
                @if($isPhysical)
                    <p>Location: {{ $isPhysical->Location }}</p>
                @endif
            </div>
        </div>
    </div>
    {{-- sa desne strane --}}
    <div class="auction_info">
        <div class="current_price">
            @if( $auction->IsActive =='1')
                Current price: {{ $auction->Price }}
            @else
                Sold for: {{ $auction->Price }}
            @endif
        </div>
        <div class="highest_bidder">
            Highest bidder: {{ $highest_bidder? $highest_bidder->Username:" "}}
        </div>
        <div class="time_left">
            @if($auction->IsActive == '1')
                @if($auction->Duration == 0)
                    Ends Today!!!
                @else
                    Days left: {{ $auction->Duration }}
                @endif
            @endif
        </div>
        <div class="status">
            @if($auction->IsActive == '1')
                Status: Active
            @else
                Status: Expired
            @endif
        </div>
        <div class="owner">
            Owner: {{ $owner->Username }}
        </div>
        <div class="view_count">
            View count: {{ $auction->ViewCount }}
        </div>
    </div>
</div>
<div class='auction_menu'>
        @if( $auction->IsActive =='1')
            <div class="bid_menu_item">
                <a href="{{ $auction->IDAuc }}/bidding">
                    <img src="{{url('slike/licitiraj3.png')}}" alt="bid">
                    <p>Bid</p>
                </a>
            </div> 
            <div class="bid_menu_item">
                <a href="{{ $auction->IDAuc }}/biddingBot">
                    <img src="{{url('slike/bot.png')}}" alt="bot">
                    <p>Bot</p>
                </a>
            </div> 
        @endif    
    <div class="bid_menu_item">
        <a href="{{ route('auctions') }}">
            <img src="{{url('slike/izadji.png')}}" alt="exit">
            <p>Exit</p>
        </a>
    </div> 
    @if($has_privileges == true)
                <div class="bid_menu_item">
                    <a href="{{ route('cancelAuction', ['id' => $auction->IDAuc ]) }}">
                        <img src="{{url('slike/doniraj.png')}}" alt="donation">
                        <p>Delete</p>
                    </a>
                </div> 
           @endif
</div>
@endsection