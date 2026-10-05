<!-- resources/views/emails/license/notification.blade.php -->
@component('mail::message')
# License Notification

Hello,

The license for building **{{ $license->building->name }}** is {{ $subject }}.


@component('mail::panel')
**License Type:** {{ $license->license_type }}  
**Start Date:** {{ $license->start_date }}  
**End Date:** {{ $license->end_date }}
@endcomponent

@if(str_contains($subject, 'expired'))
    Please take action to renew or update it as soon as possible.
@endif

Thanks,  
{{ config('app.name') }}
@endcomponent
