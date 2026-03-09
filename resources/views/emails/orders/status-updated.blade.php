<x-mail::message>
# Order Status Update

Dear {{ $order->customer_name }},

We wanted to update you on the status of your order.

## Order Information:

**Order Number:** #{{ $order->order_number }}  
**Package:** {{ $order->service_details }}  
**Price:** €{{ number_format($order->package_price, 2) }}

### Payment Information:
**Payment Status:** 
@if($order->payment_status == 'paid')
✅ **PAID**
@if($order->payment_method)
  
**Payment Method:** {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
@endif
@elseif($order->payment_status == 'refunded')
🔄 **REFUNDED**
@else
⏳ **UNPAID** - Payment pending
@endif

---

@if($oldStatus)
## Status Changed:

<x-mail::panel>
**Previous Status:** {{ ucfirst(str_replace('_', ' ', $oldStatus)) }}  
**Current Status:** {{ ucfirst(str_replace('_', ' ', $order->status)) }}
</x-mail::panel>
@else
## Current Status:

<x-mail::panel>
**{{ ucfirst(str_replace('_', ' ', $order->status)) }}**
</x-mail::panel>
@endif

---

@if($order->status == 'confirmed')
### Your Order Has Been Confirmed! ✅

Great news! We have confirmed your order and our team is preparing to provide the service.

@if($order->preferred_date)
**Scheduled Date:** {{ $order->preferred_date->format('d M Y') }}  
@endif
@if($order->preferred_time)
**Scheduled Time:** {{ $order->preferred_time }}  
@endif

We will contact you shortly with final details.

@elseif($order->status == 'in_progress')
### Service in Progress 🔄

Our team is currently working on your service. We'll keep you updated on the progress.

@elseif($order->status == 'completed')
### Service Completed! 🎉

Your service has been completed successfully. We hope you're satisfied with our work!

@if($order->payment_status == 'paid')
**Payment Received:** Thank you for your payment of €{{ number_format($order->package_price, 2) }}
@if($order->payment_method)
 via {{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}
@endif
.
@endif

We would love to hear your feedback. Please take a moment to share your experience with us.

@elseif($order->status == 'cancelled')
### Order Cancelled ❌

Your order has been cancelled.

@if($order->admin_notes)
**Reason:** {{ $order->admin_notes }}
@endif

If you have any questions or concerns, please don't hesitate to contact us.

@endif

@if($order->admin_notes && $order->status != 'cancelled')
---

## Admin Notes:
{{ $order->admin_notes }}
@endif

---

### Need Assistance?

If you have any questions about your order, feel free to reach out:

- **Phone:** {{ siteSetting('phone', '0452503052') }}  
- **Email:** {{ siteSetting('email', 'info@ntkpro.fi') }}

<x-mail::button :url="config('app.url')">
Visit Our Website
</x-mail::button>

Thank you for choosing {{ config('app.name') }}!

Best regards,<br>
{{ config('app.name') }} Team
</x-mail::message>
