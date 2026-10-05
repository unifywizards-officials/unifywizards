@component('mail::message')
# Overtime Assignment Notification

Hello Manager,

The following overtime task has been assigned to {{ $overtime->technician->name }}. Here are the details:

@component('mail::panel')
**Task Title:** {{ $overtime->task->title }}  
**Date:** {{ \Carbon\Carbon::parse($overtime->date)->format('d M Y') }}  
**Start Time:** {{ \Carbon\Carbon::parse($overtime->start_time)->format('h:i A') }}  
**End Time:** {{ \Carbon\Carbon::parse($overtime->end_time)->format('h:i A') }}  
**Reason for Overtime:** {{ $overtime->reason_for_overtime }}
@endcomponent

@component('mail::button', ['url' => url('/overtimes/' . $overtime->id)])
View Overtime Details
@endcomponent

Thank you,  
{{ config('app.name') }} Team

@endcomponent 

