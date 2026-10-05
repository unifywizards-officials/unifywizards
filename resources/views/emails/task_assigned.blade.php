@component('mail::message')
# New Task Assigned

You have been assigned a new task. Here are the details:

## Task Details
**Task Title:** {{ $title }}  
**Description:** {!! $description !!}

@component('mail::button', ['url' => url('/tasks/' . $taskId)])
View Task
@endcomponent

Thank you,  
**{{ config('app.name') }} Team**
@endcomponent
