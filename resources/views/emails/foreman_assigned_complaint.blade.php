@component('mail::message')
# Complaint Assigned

Hello **{{ $foreman->name }}**,

You have been assigned a new complaint.Here are the details:

@component('mail::panel')
**Title:** {{ $complaint->title }}
**Description:** {!! $complaint->description !!} 
@endcomponent

@component('mail::button', ['url' => url('/complaints/' . $complaint->id)])
View Complaint Details
@endcomponent

Thank you,  
{{ config('app.name') }} Team

@endcomponent 
