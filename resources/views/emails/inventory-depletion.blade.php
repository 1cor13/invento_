@component('mail::message')
# Inventory is running out
Dear Manager {{ $manager->name }}
{{ $item->name}} is running out.
{{ $item->quantity }} items only remain.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
