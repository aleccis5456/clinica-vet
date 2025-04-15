<div class="p-3 flex">
    <form wire:submit.prevent='busqueda'
        class=" relative h-12 flex items-center gap-2 bg-gray-100 p-2 rounded-l-md w-full md:w-1/3 border border-gray-300">
        <!-- Input de búsqueda -->
        <input wire:model='search' type="text"
            class="w-full bg-transparent text-sm px-3 py-2 outline-none focus:ring-2 focus:ring-gray-400 rounded-sm"
            placeholder="Buscar por nombre">

        <!-- Botón para limpiar el input -->
        @if ($search)
            <button type="button" wire:click="flagC"
                class="px-1.5 py-0.5 rounded-md text-gray-500 hover:text-gray-700 hover:bg-gray-200  transition">
                ✕
            </button>
        @endif

        <!-- Botón de búsqueda -->

        <button type="submit" class="bg-gray-200 hover:bg-gray-300 transition p-2 rounded-lg">
            <svg class="w-5 h-5 text-gray-700" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 -3 21 21">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </button>
    </form>
    <div>
        <select wire:model='estadofiltrado' wire:click='filtarPorEstados'
            class="bg-gray-800 h-12 rounded-r-md text-white text-center font-semibold">
            <option selected value="1">Todos</option>
            @foreach ($estadosf as $tipo)
                <option value="{{ $tipo }}">{{ $tipo }}</option>
            @endforeach
        </select>
    </div>
</div>