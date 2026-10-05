@component('mail::message')
# Quote Status Update

We wanted to inform you that the status of the following quote has been **{{ ucfirst($quote->status) }}**.

## Quote Details
@component('mail::table')
| Quote Title       | Description     | Amount         | Status       |
| ----------------- | --------------- | -------------- | ------------ |
| {{ $quote->title }} | {!! $quote->description !!} | {{ env('CURRENCY_SIGN') }}{{ number_format($quote->amount, 2) }} | {{ ucfirst($quote->status) }} |
@endcomponent

If you have any questions, please don’t hesitate to contact us.

@component('mail::button', ['url' => url('/quotes/' . $quote->id)])
View Quote
@endcomponent

Best regards,  
**{{ config('app.name') }} Team**
@endcomponent
