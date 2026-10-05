@component('mail::message')
# Task Comments

## Task Title
{{ $taskTitle }}

@if(isset($taskStatus))
**Status Update:** The status of the task "**{{ $taskTitle }}**" has been updated to: **{{ $taskStatus }}**.
@endif

## Comment
{!! $TaskCommentDescription !!}

@component('mail::button', ['url' => route('tasks_comment.create', $taskId)])
View Task
@endcomponent

Thank you,  
**{{ config('app.name') }} Team**
@endcomponent
