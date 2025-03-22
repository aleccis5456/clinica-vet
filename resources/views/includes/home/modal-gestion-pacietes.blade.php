<div>
    @if ($modal)
        {{-- backdrop-blur-xs --}}
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-[9999]">
            <div class="bg-gray-100 rounded-2xl p-8 space-y-6 max-w-md w-full relative">
                <!-- Botón de cierre -->
                <button wire:click="cerrarModal"
                    class=" cursor-pointer absolute top-3 right-3 text-gray-800 hover:text-gray-900">
                    <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18 17.94 6M18 18 6.06 6" />
                    </svg>
                </button>

                <h3 class="text-2xl font-bold text-center text-gray-800">¿Qué deseas gestionar?</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Opción Dueño -->
                    <a wire:navigate href="{{ route('add.dueno') }}"
                        class="font-semibold bg-gray-800 hover:bg-gray-900 text-white p-4 rounded-lg transition flex items-center space-x-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>Dueño</span>
                    </a>

                    <!-- Opción Mascota -->
                    <a wire:navigate href="{{ route('add.mascota') }}"
                        class="font-semibold border border-gray-300 bg-gray-100 hover:bg-gray-200 text-gray-800 hover:border-gray-400 p-4 rounded-lg transition flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="lucide lucide-cat">
                            <path
                                d="M12 5c.67 0 1.35.09 2 .26 1.78-2 5.03-2.84 6.42-2.26 1.4.58-.42 7-.42 7 .57 1.07 1 2.24 1 3.44C21 17.9 16.97 21 12 21s-9-3-9-7.56c0-1.25.5-2.4 1-3.44 0 0-1.89-6.42-.5-7 1.39-.58 4.72.23 6.5 2.23A9.04 9.04 0 0 1 12 5Z" />
                            <path d="M8 14v.5" />
                            <path d="M16 14v.5" />
                            <path d="M11.25 16.25h1.5L12 17l-.75-.75Z" />
                        </svg>
                        <span>Mascota</span>
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>