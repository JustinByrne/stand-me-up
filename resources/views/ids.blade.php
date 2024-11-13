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
    </div>
</x-layouts.app>