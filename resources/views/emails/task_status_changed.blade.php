@component('mail::message')
# Task Status Updated

The status of the task "**{{ $taskTitle }}**" has been updated to: **{{ $taskStatus }}**.

@component('mail::button', ['url' => url('/tasks/' . $taskId)])
View Task
@endcomponent

Thank you,  
**{{ config('app.name') }} Team**
@endcomponent
