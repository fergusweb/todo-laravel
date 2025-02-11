<x-app-layout>
    <x-slot:title>
        Contact Us
    </x-slot>

    <x-slot:header>
        Contact
    </x-slot:header>


    @if(session('success'))
        <div class="alert alert-success bg-green-100 text-green-800 border-green-400 border-solid border-2 rounded-md p-4 mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form method="POST" action="/contact">
        @csrf

        @if ($errors->any())
            <div class="mx-10">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-red-500 italic">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <div class="mb-4">
            <x-input-label for="name" value="Your name" />
            <x-text-input id="name" name="name" type="text" value="{{ old('name') }}" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="email" value="Email address" />
            <x-text-input id="email" name="email" type="email" value="{{ old('email') }}" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-input-label for="message" value="Your message" />
            <x-textarea-input id="taskDescription" name="message">{{ old('message') }}</x-textarea-input>
            <x-input-error :messages="$errors->get('message')" class="mt-2" />
        </div>

        <div class="mt-6 flex items-center justify-between gap-x-6">
            <div>
                <x-primary-button type="submit">Send message</x-primary-button>
            </div>
        </div>

    </form>
</x-app-layout>

