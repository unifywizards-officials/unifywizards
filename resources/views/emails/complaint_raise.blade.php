@component('mail::message')
# Complaint Raised


A new complaint has been raised. Here are the details:

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



