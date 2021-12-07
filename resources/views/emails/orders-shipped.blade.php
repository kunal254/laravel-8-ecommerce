@component('mail::message')
# Your order is on its way.
# ![delivery van]({{ asset('img/van.jpg') }})

## Hello {{ ucfirst($order->first_name) }},
We thought you'd like to know that your order is place successfully. Your Order is on its way.
[click here]({{ route('user.orders.index') }}) to track your orders.

@component('mail::panel')
    ## your package will send to:
    {{ $order->address_line }}
    {{ $order->postal_code.", ".$order->city }}
    {{ $order->country }}
@endcomponent

Your Item(s) being send by Beyond Transportaion Services. Please note that a signature may be required for the delivery of the package.
<br><br>

## **Order summary**
___
```
Item Subtotal:       ${{ $order->grand_total }}
Shipping & Handling: ${{ $extra =  $order->grand_total < 10 ? 5 : 0 }}
POD Convenience Fee: $0
```
**Shipping Total:** &nbsp; &nbsp; &nbsp; &nbsp; **${{ $order->grand_total + $extra }}**
___
Track your order with the [Beyond App]({{ route('home') }}).
or click the button below.

@component('mail::button', ['url' => 'http://127.0.0.1:8000/user/orders' ])
Track Your Order
@endcomponent


Thanks,<br>
**{{ config('app.name') }}.in**
@endcomponent
