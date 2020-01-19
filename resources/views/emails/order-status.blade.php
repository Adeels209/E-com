@component('mail::message')
Hello {{ $order->fname }}

Your order status for order number {{ $order->order_no }} has been changed to {{ $order->status }}.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
