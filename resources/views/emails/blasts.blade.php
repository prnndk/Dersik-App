<x-mail::message>
    ### Hello {{ $user->username }}
    
    {!! $content !!}

    Pesan ini dikirim secara langsung oleh sistem, jangan balas!
</x-mail::message>