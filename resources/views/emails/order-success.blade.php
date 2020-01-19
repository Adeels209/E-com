<link rel="stylesheet" href="{{ URL::to('user_ui/css/bootstrap.min.css') }}">
@component('mail::message')
Hello {{ $order->fname }},

This is your Order's Description, In any case do not forget to contact us.
<table class="table table-striped">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Product Image</th>
        <th scope="col">Product Name</th>
        <th scope="col">Order Number</th>
        <th scope="col">Quantity</th>
        <th scope="col">Unit Price</th>
        <th scope="col">Total Paid Amount</th>
        <th scope="col">Status</th>
    </tr>
    </thead>
    <tbody>
        @foreach($order->orderItems as $item)
    <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td><img style="object-fit: cover; object-position: center"  src="{{ URL::to($item->image)}}" alt=""></td>
        <td class="text-center" style="text-align: center">{{ $item->product_name }}</td>
        <td class="text-center" style="text-align: center">{{ $order->order_no }}</td>
        <td class="text-center" style="text-align: center">{{ $item->quantity }}</td>
        <td class="text-center" style="text-align: center">{{ $item->selling_price }}</td>
        <td class="text-center" style="text-align: center">{{ $order->paid_price }}</td>
        <td class="text-center" style="text-align: center">{{ $order->status }}</td>
    </tr>
    </tbody>
    @endforeach
</table>


Thanks,<br>
{{ config('app.name') }}
@endcomponent
