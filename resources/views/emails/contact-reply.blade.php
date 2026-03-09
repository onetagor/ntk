<x-mail::message>
# Response to Your Message

Dear {{ $contact->name }},

Thank you for contacting us. We have reviewed your message and here is our response:

---

## Your Original Message:
{{ $contact->message }}

---

## Our Response:

{{ $contact->admin_reply }}

---

If you have any further questions or need additional assistance, please don't hesitate to reach out to us again.

<x-mail::button :url="config('app.url')">
Visit Our Website
</x-mail::button>

Thank you for choosing {{ config('app.name') }}!

Best regards,<br>
{{ config('app.name') }} Team
</x-mail::message>
