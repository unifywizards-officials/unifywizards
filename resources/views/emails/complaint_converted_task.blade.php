@component('mail::message')
# Complaint Converted To Task


A new task has been raised. Here are the details:

@component('mail::panel')
**Task Title:** {{ $task->title }}
**Start Date:** {{ \Carbon\Carbon::parse($task->start_date)->format('M d, Y') }} 
**Unit:** { $task->unit_id ? $task->unit->name  : 'N/A' }}
**Building:** {{ $task->building->name }}
**Description:** {!! $task->description !!} 
@endcomponent

@component('mail::button', ['url' => url('/tasks/' . $task->id)])
View Task Details
@endcomponent

Thank you,  
{{ config('app.name') }} Team

@endcomponent 





