<x-user-layout>
    {{--------------------- 
        $slot 
    --------------------}}
    <h3>Your Address</h3>
        @if ($address = auth()->user()->addresses()->first())
            <div class="details_card">
                <strong>Address line : </strong><span>{{$address->address_line}}</span><br>
                <strong>City : </strong><span>{{$address->city}}</span><br>
                <strong>Postal code : </strong><span>{{$address->postal_code}}</span><br>
                <strong>Country : </strong><span>{{$address->country}}</span><br>
            </div><br><br>
        @else
            <form action="{{ route('fake_addr') }}" method="post">
                @csrf
                <input type="submit" value="generate fake address">
            </form>
        @endif
    <hr>    
    <h3>Your payments deatails</h3>
        @if ($payment = auth()->user()->payments()->first())
        <div class="details_card">
            <strong>Card type : </strong><span>{{$payment->card_type}}</span><br>
            <strong>Card number : </strong><span>************{{ substr($payment->card_number, -4) }}</span><br>
        </div>
        @else
            <form action="{{ route('fake_pay') }}" method="post">
                @csrf
                <input type="submit" value="generate fake payment details">
            </form>
        @endif
    {{--------------------- 
        $slot 
    --------------------}}
</x-user-layout>