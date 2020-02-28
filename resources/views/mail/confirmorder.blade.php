@component('mail::message')
# Your order has been confirmed!
<hr>
Dear {{ucwords($array['forename'])}},

Please find your order details below. Please allow some time for despatch.


<h1>Billing Address</h1>
<p>{{$array['billing']['billing_first_name']}}</p>
<p>{{$array['billing']['billing_last_name']}}</p>
<p>{{$array['billing']['billing_company']}}</p>
<p>{{$array['billing']['billing_address_1']}}</p>
<p>{{$array['billing']['billing_address_2']}}</p>
<p>{{$array['billing']['billing_city']}}</p>
<p>{{$array['billing']['billing_postcode']}}</p>
<p>{{$array['billing']['billing_country']}}</p>
<p>{{$array['billing']['billing_state']}}</p>

<h1>Delivery Address</h1>
<p>{{$array['delivery']['delivery_first_name']}}</p>
<p>{{$array['delivery']['delivery_last_name']}}</p>
<p>{{$array['delivery']['delivery_company']}}</p>
<p>{{$array['delivery']['delivery_address_1']}}</p>
<p>{{$array['delivery']['delivery_address_2']}}</p>
<p>{{$array['delivery']['delivery_city']}}</p>
<p>{{$array['delivery']['delivery_postcode']}}</p>
<p>{{$array['delivery']['delivery_country']}}</p>
<p>{{$array['delivery']['delivery_state']}}</p>





<table class="table">
    <thead>
        <th>Product Code</th>
        <th>Product Name</th>
        <th>Quantity</th>
        <th>Price</th>

    </thead>

    <tbody>
        @foreach($array['cart'] as $item)
        <tr>
            <td>{{$item->product_code}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->qty}}</td>
            <td>{{$item->price}}</td>
        </tr>

        @endforeach
    </tbody>
</table>


Thanks,<br>

{{ config('app.name') }}

@component('mail::subcopy')
If you have any issues, or questions please contact us- <a href="mailto:{{env("SUPPORT_MAIL")}}">{{env("SUPPORT_MAIL")}}</a>, <br><h5 style="color:Red">DO NOT REPLY TO THIS EMAIL. THIS EMAIL ADDRESS IS UNMONITORED.</h5>
@endcomponent


@endcomponent

