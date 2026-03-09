<x-mail::message>
# Order Confirmation - Thank You!

Dear {{ $order->customer_name }},

Thank you for choosing {{ config('app.name') }}! We're excited to confirm your order.

## Order Details:

**Order Number:** #{{ $order->order_number }}  
**Package:** {{ $order->service_details }}  
**Price:** €{{ number_format($order->package_price, 2) }}  
**Status:** {{ ucfirst($order->status) }}

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
⏳ **UNPAID** - Payment will be collected upon service completion
@endif

---

@if($order->preferred_date)
**Preferred Date:** {{ $order->preferred_date->format('d M Y') }}  
@endif
@if($order->preferred_time)
**Preferred Time:** {{ $order->preferred_time }}  
@endif

---

## Contact Information:

**Name:** {{ $order->customer_name }}  
**Email:** {{ $order->customer_email }}  
**Phone:** {{ $order->customer_phone }}  
**Address:** {{ $order->customer_address }}
@if($order->city)
, {{ $order->city }}
@endif
@if($order->postal_code)
 {{ $order->postal_code }}
@endif

@if($order->special_instructions)
---

## Special Instructions:
{{ $order->special_instructions }}
@endif

---

### What's Next?

Our team will review your order and contact you shortly to confirm the service details and schedule.

You can track your order status anytime using the button below:

<x-mail::button :url="$successUrl">
View Order Details
</x-mail::button>

### Need Help?

If you have any questions or need to make changes to your order, please contact us:

- **Phone:** {{ siteSetting('phone', '0452503052') }}  
- **Email:** {{ siteSetting('email', 'info@ntkpro.fi') }}

Thank you for choosing our services!

Best regards,<br>
{{ config('app.name') }} Team
</x-mail::message>
