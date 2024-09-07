<x-mail::message>
# Introduction

{{-- The body of your message. --}}
hellow {{ $user->name }} you registerd in our website successfully


<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
