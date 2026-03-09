<x-mail::message>
# New Contact Message Received!

You have received a new contact message from your website.

## Contact Details:

**Name:** {{ $contact->name }}  
**Email:** {{ $contact->email }}  
@if($contact->phone)
**Phone:** {{ $contact->phone }}  
@endif
**Date:** {{ $contact->created_at->format('F j, Y g:i A') }}

## Message:

{{ $contact->message }}

---

<x-mail::button :url="route('admin.contacts.show', $contact->id)">
View in Admin Panel
</x-mail::button>

Please respond to this customer as soon as possible.

Best regards,<br>
{{ config('app.name') }} System
</x-mail::message>
