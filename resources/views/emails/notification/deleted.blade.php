<x-mail::message>
    Hello {{ $user->name }} ,

    Info: Notifications from 30 days ago have been deleted.

<x-mail::button :url="$url" color="success">
    View
</x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
