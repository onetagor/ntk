<x-mail::message>
# Thank You for Contacting Us!

Dear {{ $contact->name }},

Thank you for reaching out to us. We have successfully received your message and wanted to confirm that it's in our inbox.

## Your Message Details:

**Name:** {{ $contact->name }}  
**Email:** {{ $contact->email }}  
@if($contact->phone)
**Phone:** {{ $contact->phone }}  
@endif
**Message:**  
{{ $contact->message }}

---

### What's Next?

Our support team will review your message and get back to you as soon as possible, typically within 24-48 hours.

If you have any urgent concerns, please don't hesitate to call us directly.

<x-mail::button :url="config('app.url')">
Visit Our Website
</x-mail::button>

Thank you for choosing {{ config('app.name') }}!

Best regards,<br>
{{ config('app.name') }} Team
</x-mail::message>
