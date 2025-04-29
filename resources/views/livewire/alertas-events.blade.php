<div>
    <div x-data="{ mostrar: false }" x-show="mostrar" x-transition
        x-on:especie-add.window="
            mostrar = true;
            setTimeout(() => mostrar = false, 3000);           
        "
        class="fixed top-0 right-0 left-0 z-[999] flex justify-center items-center w-full h-full bg-black/10 shadow-xl">
        <div class="relative p-4 w-full max-w-md">
            <div class="relative bg-white rounded-lg shadow">
                <!-- Botón para cerrar -->
                <button type="button"
                    class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                    @click="mostrar = false">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Cerrar</span>
                </button>
                <!-- Contenido -->
                <div class="p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-500 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12.75l3 3 6-6" />
                        <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="2" />
                    </svg>
                    <h3 class="mb-5 text-lg font-semibold text-gray-800">
                        ¡Agregado correctamente!
                    </h3>
                    <p class="mb-5 text-sm text-gray-600">
                        {{ session('agregado') }}
                    </p>
                    <button @click="mostrar = false"
                        class="text-white bg-gray-800 hover:bg-black focus:ring-4 focus:outline-none focus:ring-black font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        Aceptar
                    </button>
                </div>
            </div>
        </div>
    </div>


    <div>
        <div x-data="{ mostrar: false }" x-show="mostrar" x-transition
            x-on:dueno-add.window="
            mostrar = true;
            setTimeout(() => mostrar = false, 3000);           
            "
            class="fixed top-0 right-0 left-0 z-[999] flex justify-center items-center w-full h-full bg-black/10 shadow-xl">
            <div class="relative p-4 w-full max-w-md">
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Botón para cerrar -->
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                        @click="mostrar = false">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar</span>
                    </button>
                    <!-- Contenido -->
                    <div class="p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-500 w-12 h-12" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12.75l3 3 6-6" />
                            <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="2" />
                        </svg>
                        <h3 class="mb-5 text-lg font-semibold text-gray-800">
                            ¡Agregado correctamente!
                        </h3>
                        <p class="mb-5 text-sm text-gray-600">
                            Usuario Agregado correctamente
                        </p>
                        <button @click="mostrar = false"
                            class="text-white bg-gray-800 hover:bg-black focus:ring-4 focus:outline-none focus:ring-black font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Aceptar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div x-data="{ mostrar: false }" 
            x-show="mostrar" 
            x-transition
            x-on:tipoconsulta-add.window="
            mostrar = true;
            setTimeout(() => mostrar = false, 3000);           
            "
            class="fixed top-0 right-0 left-0 z-[999] flex justify-center items-center w-full h-full bg-black/10 shadow-xl">
            <div class="relative p-4 w-full max-w-md">
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Botón para cerrar -->
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                        @click="mostrar = false">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar</span>
                    </button>
                    <!-- Contenido -->
                    <div class="p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-500 w-12 h-12" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12.75l3 3 6-6" />
                            <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="2" />
                        </svg>
                        <h3 class="mb-5 text-lg font-semibold text-gray-800">
                            ¡Agregado correctamente!
                        </h3>
                        <p class="mb-5 text-sm text-gray-600">
                            Tipo consulta agregada correctamente
                        </p>
                        <button @click="mostrar = false"
                            class="text-white bg-gray-800 hover:bg-black focus:ring-4 focus:outline-none focus:ring-black font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Aceptar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div>
        <div x-data="{ mostrar: false }" 
            x-show="mostrar" 
            x-transition
            x-on:error-store.window="
            mostrar = true;
                   
            "
            class="fixed top-0 right-0 left-0 z-[999] flex justify-center items-center w-full h-full bg-black/10 shadow-xl">
            <div class="relative p-4 w-full max-w-md">
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Botón para cerrar -->
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                        @click="mostrar = false">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar</span>
                    </button>
                    <!-- Contenido -->
                    <div class="p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-500 w-12 h-12" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12.75l3 3 6-6" />
                            <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="2" />
                        </svg>
                        <h3 class="mb-5 text-lg font-semibold text-gray-800">
                            ¡Agregado correctamente!
                        </h3>
                        <p class="mb-5 text-sm text-gray-600">
                            Producto Agregado correctamente
                        </p>
                        <button @click="mostrar = false"
                            class="text-white bg-gray-800 hover:bg-black focus:ring-4 focus:outline-none focus:ring-black font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Aceptar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>



      <div>
        <div x-data="{ mostrar: false }" 
            x-show="mostrar" 
            x-transition
            x-on:success-store.window="
            mostrar = true;
                   
            "
            class="fixed top-0 right-0 left-0 z-[999] flex justify-center items-center w-full h-full bg-black/10 shadow-xl">
            <div class="relative p-4 w-full max-w-md">
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Botón para cerrar -->
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                        @click="mostrar = false">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar</span>
                    </button>
                    <!-- Contenido -->
                    <div class="p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-500 w-12 h-12" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12.75l3 3 6-6" />
                            <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="2" />
                        </svg>
                        <h3 class="mb-5 text-lg font-semibold text-gray-800">
                            ¡Agregado correctamente!
                        </h3>
                        <p class="mb-5 text-sm text-gray-600">
                            Producto Agregado correctamente
                        </p>
                        <button @click="mostrar = false"
                            class="text-white bg-gray-800 hover:bg-black focus:ring-4 focus:outline-none focus:ring-black font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Aceptar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div>
        <div x-data="{ mostrar: false }" 
            x-show="mostrar" 
            x-transition
            x-on:producto-borrado.window="
            mostrar = true;
                   
            "
            class="fixed top-0 right-0 left-0 z-[999] flex justify-center items-center w-full h-full bg-black/10 shadow-xl">
            <div class="relative p-4 w-full max-w-md">
                <div class="relative bg-white rounded-lg shadow">
                    <!-- Botón para cerrar -->
                    <button type="button"
                        class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
                        @click="mostrar = false">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Cerrar</span>
                    </button>
                    <!-- Contenido -->
                    <div class="p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-500 w-12 h-12" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12.75l3 3 6-6" />
                            <circle cx="12" cy="12" r="11" stroke="currentColor" stroke-width="2" />
                        </svg>
                        <h3 class="mb-5 text-lg font-semibold text-gray-800">
                            Borrado!
                        </h3>
                        <p class="mb-5 text-sm text-gray-600">
                            Producto borrado correctamente
                        </p>
                        <button @click="mostrar = false"
                            class="text-white bg-gray-800 hover:bg-black focus:ring-4 focus:outline-none focus:ring-black font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            Aceptar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
