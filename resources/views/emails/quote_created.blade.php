@component('mail::message')
# New Quote Created

Here are the details of the quote:

## Quote Information
- **Quote Title:** {{ $quote->title }}
- **Description:** {!! $quote->description !!}
- **Total Amount:** {{ number_format($quote->amount, 2) }}

## Quote Items
@component('mail::table')
| Item Name      | Quantity       | Amount        |
| -------------- | -------------- | ------------- |
@php $subtotal = 0; @endphp
@foreach($quoteItems as $item)
| {{ $item->item_name }} | {{ $item->quantity }} | {{ number_format($item->amount, 2) }} |
@php $subtotal += $item->quantity * $item->amount; @endphp
@endforeach
@endcomponent

### Subtotal: {{ number_format($subtotal, 2) }}
### Total Amount (Including additional charges, if any): {{ number_format($quote->amount, 2) }}

To approve or reject this quote, please click one of the buttons below:

@component('mail::button', ['url' => route('quotes.approve', ['id' => $quote->id, 'token' => $quote->token]), 'color' => 'success'])
Approve
@endcomponent

@component('mail::button', ['url' => route('quotes.reject', ['id' => $quote->id, 'token' => $quote->token]), 'color' => 'error'])
Reject
@endcomponent

Thank you,  
{{ config('app.name') }} Team
@endcomponent