<!-- resources/views/auth/verify-email.blade.php -->

<x-auth.auth-layout>
    <h1>E-posta Doğrulaması Gerekiyor</h1>
    <p>
        Devam edebilmek için lütfen e-posta adresini doğrula. Doğrulama e-postası gönderildi mi?
    </p>

    @if (session('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif

    {{-- <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit">Tekrar Gönder</button>
    </form> --}}
</x-auth.auth-layout>
