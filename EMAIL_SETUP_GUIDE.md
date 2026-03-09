# Email Configuration Guide

আপনার Contact Form এর জন্য Email System সম্পূর্ণভাবে setup করা হয়েছে! 🎉

## Features যা যোগ করা হয়েছে:

### ✅ Customer Email Notification
- যখন কেউ contact form submit করবে, তাদের email এ একটা confirmation message যাবে
- Email এ লেখা থাকবে: "আমরা আপনার message পেয়েছি এবং তাড়াতাড়ি response দেব"

### ✅ Admin Email Notification
- প্রতিটি new contact message এর জন্য admin এর email এ notification যাবে
- Admin panel থেকে directly contact view করতে পারবেন

### ✅ Admin Contact Management
- Admin panel থেকে সব contacts দেখতে পারবেন
- Reply দিতে পারবেন
- Status update করতে পারবেন (pending, replied, archived)
- Export করতে পারবেন

---

## Email Gateway Setup করুন:

আপনার `.env` file এ নিচের configuration যোগ করুন:

### Option 1: Gmail ব্যবহার করলে (Development এর জন্য)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
ADMIN_EMAIL=admin@example.com
```

**Important:** Gmail এর জন্য App Password তৈরি করতে হবে:
1. Google Account → Security → 2-Step Verification চালু করুন
2. App Passwords এ যান
3. "Mail" select করে password generate করুন
4. সেই password `.env` এ use করুন

### Option 2: Mailtrap ব্যবহার করলে (Testing এর জন্য)

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your-mailtrap-username
MAIL_PASSWORD=your-mailtrap-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=hello@example.com
MAIL_FROM_NAME="${APP_NAME}"
ADMIN_EMAIL=admin@example.com
```

Mailtrap: https://mailtrap.io (Free account তৈরি করুন)

### Option 3: SendGrid ব্যবহার করলে (Production এর জন্য)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.sendgrid.net
MAIL_PORT=587
MAIL_USERNAME=apikey
MAIL_PASSWORD=your-sendgrid-api-key
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="${APP_NAME}"
ADMIN_EMAIL=admin@yourdomain.com
```

### Option 4: Mailgun, AWS SES, বা অন্য কোনো service

Laravel documentation দেখুন: https://laravel.com/docs/mail

---

## Testing করুন:

### 1. Configuration Cache Clear করুন:
```bash
php artisan config:clear
php artisan cache:clear
```

### 2. Test Email পাঠান:
```bash
php artisan tinker
```

তারপর:
```php
Mail::raw('Test email', function($message) {
    $message->to('test@example.com')->subject('Test');
});
```

### 3. Frontend থেকে Test করুন:
- Website এ যান
- Contact Form fill করুন
- Submit করুন
- Check করুন:
  - ✅ Database এ contact save হয়েছে কিনা
  - ✅ Customer email এ confirmation গেছে কিনা
  - ✅ Admin email এ notification গেছে কিনা

---

## Admin Panel এ Contact Management:

### Access করুন:
```
/admin/contacts
```

### Features:
- সব contacts list দেখুন
- Filter করুন (pending, replied, archived)
- Search করুন (name, email, phone, message)
- Individual contact view করুন
- Reply দিন
- Status update করুন
- Delete করুন
- Export করুন CSV file এ

---

## Production এ Deploy করার সময়:

### 1. Queue System Setup করুন:
Email sending কে queue তে রাখলে performance ভালো হয়:

```bash
php artisan queue:table
php artisan migrate
```

`.env` এ:
```env
QUEUE_CONNECTION=database
```

Queue worker run করুন:
```bash
php artisan queue:work
```

### 2. Mail Class এ `ShouldQueue` implement করুন:

`app/Mail/ContactMessageReceived.php` এ:
```php
class ContactMessageReceived extends Mailable implements ShouldQueue
```

---

## Files যা তৈরি/Update করা হয়েছে:

### Created:
- `app/Mail/ContactMessageReceived.php` - Customer notification mail
- `app/Mail/NewContactNotification.php` - Admin notification mail
- `resources/views/emails/contact-received.blade.php` - Customer email template
- `resources/views/emails/admin/new-contact.blade.php` - Admin email template

### Updated:
- `app/Http/Controllers/HomeController.php` - Email sending logic যোগ করা হয়েছে
- `config/mail.php` - Admin email configuration যোগ করা হয়েছে

### Already Existed:
- `app/Models/Contact.php`
- `app/Http/Controllers/Admin/ContactController.php`
- `resources/views/admin/contacts/index.blade.php`
- `resources/views/admin/contacts/show.blade.php`

---

## Troubleshooting:

### Email যাচ্ছে না?
1. `.env` configuration check করুন
2. `php artisan config:clear` run করুন
3. Log file check করুন: `storage/logs/laravel.log`
4. Mail credentials verify করুন

### Gmail App Password তৈরি করতে পারছেন না?
- 2-Step Verification enable করুন first
- তারপর App Passwords option available হবে

### Mailtrap এ email দেখতে পারছেন না?
- Inbox tab check করুন
- Project select করেছেন কিনা verify করুন

---

## Support:

কোনো সমস্যা হলে Laravel Mail documentation দেখুন:
https://laravel.com/docs/10.x/mail

Happy Coding! 🚀
