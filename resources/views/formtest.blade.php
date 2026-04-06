<x-layout>
    <h2>Email List</h2>

    {{-- Task 5: Flash messages --}}
    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    @if(session('warning'))
        <p style="color: orange">{{ session('warning') }}</p>
    @endif

    @if($errors->any())
        <p style="color: red">{{ $errors->first() }}</p>
    @endif

    {{-- Form --}}
    <form method="POST" action="/formtest">
        @csrf
        <input type="email" name="email" placeholder="Enter email">
        <button type="submit">Add</button>
    </form>

    {{-- Email list with delete buttons (Task 4) --}}
    <ul>
        @foreach($emails as $email)
            <li>
                {{ $email }}
                <form method="POST" action="/delete-email" style="display:inline">
                    @csrf
                    <input type="hidden" name="email" value="{{ $email }}">
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    {{-- Delete all --}}
    @if(count($emails) > 0)
        <a href="/delete-emails">Delete All</a>
    @endif
</x-layout>