@component('mail::message')
# {{ $quote->title }}

Dear {{ $quote->tenant->name }},

We are pleased to provide you with the following invoice for the quote titled "{{ $quote->title }}".

## Invoice Details
@component('mail::table')
| Item           | Quantity       | Amount       |
| -------------- |:--------------:| ------------:|
@foreach ($quote->items as $item)
| {{ $item->name }} | {{ $item->quantity }} | ${{ number_format($item->amount, 2) }} |
@endforeach
@endcomponent

**Total Amount:** ${{ number_format($quote->amount, 2) }}

@component('mail::button', ['url' => url('/quotes/' . $quote->id)])
View Quote
@endcomponent

Thank you for your approval!

Best regards,  
**FMD Team**
@endcomponent
