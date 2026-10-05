@component('mail::message')
# Overtime Status {{ ucfirst($overtime->status) }}

Hello **{{ $overtime->technician->name }}**,

We regret to inform you that your overtime request for the task **{{ $overtime->status }}**:

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

