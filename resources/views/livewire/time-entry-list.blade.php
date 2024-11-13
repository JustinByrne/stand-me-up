<div>
    <div>
        <label for="date" class="block font-medium text-gray-900 text-sm/6">Date</label>
        <div class="mt-2">
            <input
                type="date"
                name="date"
                id="date"
                class="block w-full rounded-md border-0 px-2 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm/6"
                wire:model.live="date"
            >
        </div>
    </div>

    <div class="pt-4">
        <ul class="pl-4 list-disc" wire:loading.remove>
            @foreach ($timeEntries as $entry)
                <li class="text-sm/6">
                    {!! $entry->formatted_description !!}
                </li>
            @endforeach
        </ul>

        <ul class="w-full pl-4 list-disc" wire:loading>
            @for ($i = 0; $i < 5; $i++)
                <li class="w-full text-sm/6">
                    <div class="w-full h-5 rounded bg-zinc-300 animate-pulse"></div>
                </li>
            @endfor
        </ul>

        @if (!count($timeEntries))
            <div class="text-sm/6">
                No entries for this date
            </div>
        @endif
    </div>
</div>
