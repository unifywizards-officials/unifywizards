@component('mail::message')
# Maintenance Visit Notification

Hello Manager,

A scheduled maintenance visit for the contract **"{{ $visit->maintenanceContract->title }}"** is approaching.

@component('mail::panel')
**Visit Date:** {{ \Carbon\Carbon::parse($visit->visit_date)->format('F j, Y') }}  
**Status:** {{ $message }}
@endcomponent

@if($message == 'Visit is still pending')
Please address this pending visit as soon as possible to avoid any disruptions.
@endif

@component('mail::button', ['url' => url('/maintenace_contracts/' . $visit->maintenanceContract->id)])
View Contract Details
@endcomponent

Thank you,  
{{ config('app.name') }} Team

@endcomponent
