<x-layouts.app title="IDs">
    <div class="flex flex-col gap-3">
        <div class="text-sm/6">
            <span class="font-medium text-gray-900">
                Workspace ID:
            </span>
            <span>
                {{ $workspaceId }}
            </span>
        </div>
        
        <div class="text-sm/6">
            <span class="font-medium text-gray-900">
                User ID:
            </span>
            <span>
                {{ $userId }}
            </span>
        </div>

        <form class="flex flex-col gap-3" action="/ids" method="POST">

            @csrf

            <button
                type="submit"
                class="rounded-md bg-indigo-600 px-2.5 py-1.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
                Save IDs
            </button>
        </form>
    </div>
</x-layouts.app>