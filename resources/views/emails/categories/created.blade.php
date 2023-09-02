<x-mail::message>
    Hello,


    Category Created: {{$category}} created by: {{$user}}

<x-mail::button :url="$url" color="success">
View Category
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
