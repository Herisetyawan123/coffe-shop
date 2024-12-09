@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative']) }}>
        {{-- @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach --}}
        E-mail or password are invalid
    </ul>
@endif
