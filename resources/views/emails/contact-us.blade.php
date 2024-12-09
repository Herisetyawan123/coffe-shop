<x-mail::message>
# Pesan Baru

Ada pesan baru yang dikirim melalui formulir kontak:

## Detail Pesan:
- **Subject:** {{ $msg->subject }}
- **Dari:** {{ $msg->email }}
- **Pesan:** {{ $msg->message }}
- **Nama:** {{ $msg->name }}

<x-mail::button :url="url('/')">
    Back to site
</x-mail::button>

Terima kasih,<br>
{{ config('app.name') }}
</x-mail::message>
