<x-layouts.app title="Missing Clockify API Key">

    <p class="pb-3 font-medium text-gray-900 text-sm/6">
        The Clockify API Key is missing.
    </p>

    <form class="flex flex-col gap-3" method="POST">

        @csrf

        <div>
            <label for="api_key" class="block font-medium text-gray-900 text-sm/6">API Key</label>
            <div class="mt-2">
                <input
                    type="text"
                    name="api_key"
                    id="api_key"
                    value="{{ old('api_key') }}"
                    autocomplete="off"
                    class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                >
            </div>
            
            @error ('api_key')
                <p class="mt-2 text-sm text-red-600" id="api_key-error">
                    {{ $message }}
                </p>
            @enderror
        </div>
    
        <div class="place-self-end">
            <button
                type="submit"
                class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
                Submit
            </button>
        </div>
    </form>
</x-layouts.app>