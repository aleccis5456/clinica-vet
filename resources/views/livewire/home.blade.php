<div class="p-2"> 
    <nav class="p-4 text-black border border-gray-100 rounded-lg bg-gray-100 shadow-sm relative">
        <div class="container mx-auto flex justify-center items-center relative">
            <h1 class="text-2xl font-bold">
                <a wire:navigate href="{{ route('index') }}">Clínica Veterinaria</a>                
            </h1>            
            <button wire:confirm='estas seguro?' wire:click='logout' class="absolute right-0 cursor-pointer">
                <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2"/>
                  </svg>  
            </button>
        </div>
    </nav>
    
    
   <!-- Contenedor principal -->
    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

            <!-- Gestión de pacientes -->
            
            <div id="gestion-pacientes" class="bg-cover bg-center rounded-2xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105 relative"
                style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/gestion-pacientes.jpg') }}');">

                <!-- Overlay con efecto de degradado -->
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-900/50 to-gray-900/80"></div>

                <div class="relative z-10 p-4 md:p-6">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Gestión de Pacientes</h2>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center text-white/80">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Registro de mascotas y dueños</span>                            
                        </div>
                    </div>
                    <button wire:click='abrirModal'
                        class="cursor-pointer inline-flex items-center px-6 py-3 bg-gray-300 hover:bg-gray-800 text-black hover:text-gray-100 font-medium rounded-lg transition duration-300 group">
                        Acceder
                        <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>


            <!-- Historia clínica -->
            <div id="consultas" class="bg-cover bg-center rounded-2xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105 relative"
                style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/historial.jpeg') }}');">

                <!-- Overlay con efecto de degradado -->
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-900/50 to-gray-900/80"></div>

                <div class="relative z-10 p-4 md:p-6">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Consultas</h2>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center text-white/80">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Registro e historial de consultas</span>
                        </div>

                    </div>

                    <a wire:navigate href="{{ route('consultas') }}"
                    class="cursor-pointer inline-flex items-center px-6 py-3 bg-gray-300 hover:bg-gray-800 text-black hover:text-gray-100 font-medium rounded-lg transition duration-300 group">
                        Acceder
                        <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Agenda de citas -->
            {{-- <div class="bg-cover bg-center rounded-2xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105 relative"
                style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/agenda.webp') }}');">

                <!-- Overlay con efecto de degradado -->
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-900/50 to-gray-900/80"></div>

                <div class="relative z-10 p-4 md:p-6">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Agenda</h2>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center text-white/80">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <span>Programación y recordatorio de consultas y cirugías</span>
                        </div>

                    </div>

                    <a href="{{ route('agenda') }}"
                        class="cursor-pointer inline-flex items-center px-6 py-3 bg-gray-300 hover:bg-gray-800 text-black hover:text-gray-100 font-medium rounded-lg transition duration-300 group">
                        Acceder
                        <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div> --}}

            <!-- Caja -->
            <div class="bg-cover bg-center rounded-2xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105 relative"
                style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/pago.jpg') }}');">

                <!-- Overlay con efecto de degradado -->
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-900/50 to-gray-900/80"></div>
                
                <div class="relative z-10 p-4 md:p-6">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">
                        Caja
                        @if (session('caja'))                        
                            <span class="text-[25px] bg-gradient-to-r gap-2 from-red-400 to-red-500 px-3 py-1 rounded-full">{{ count(session('caja')) }}</span>
                        @endif                        
                    </h2>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center text-white/80">
                            <svg class="w-3.5 h-3.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <span>Cobros y gestión de pagos</span>
                        </div>

                    </div>

                    <a href="{{ route('caja') }}"
                        class="cursor-pointer inline-flex items-center px-6 py-3 bg-gray-300 hover:bg-gray-800 text-black hover:text-gray-100 font-medium rounded-lg transition duration-300 group">
                        Acceder
                        <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>



            <!-- Inventario -->
            <div class="bg-cover bg-center rounded-2xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105 relative"
                style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/inventario.jpg') }}');">

                <!-- Overlay con efecto de degradado -->
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-900/50 to-gray-900/80"></div>

                <div class="relative z-10 p-4 md:p-6">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Inventario</h2>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center text-white/80">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                            <span>Control de medicamentos, insumos y equipos</span>
                        </div>

                    </div>

                    <a wire:navigate href="{{ route('inventario') }}"
                        class="cursor-pointer inline-flex items-center px-6 py-3 bg-gray-300 hover:bg-gray-800 text-black hover:text-gray-100 font-medium rounded-lg transition duration-300 group">
                        Acceder
                        <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>



            <!-- Gestión de usuarios -->
            <div class="bg-cover bg-center rounded-2xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105 relative"
                style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/gestion.png') }}');">

                <!-- Overlay con efecto de degradado -->
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-900/50 to-gray-900/80"></div>

                <div class="relative z-10 p-4 md:p-6">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Gestión de usuarios</h2>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center text-white/80">
                            <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <span>Roles y permisos para el personal</span>
                        </div>
                    </div>

                    <a wire:navigate href="{{ route('gestion.roles') }}"
                        class="cursor-pointer inline-flex items-center px-6 py-3 bg-gray-300 hover:bg-gray-800 text-black hover:text-gray-100 font-medium rounded-lg transition duration-300 group">
                        Acceder
                        <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>




            <!-- Reportes -->
            <div class="bg-cover bg-center rounded-2xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105 relative"
                style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/datos.jpg') }}');">

                <!-- Overlay con efecto de degradado -->
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-900/50 to-gray-900/80"></div>

                <div class="relative z-10 p-4 md:p-6">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Reportes</h2>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center text-white/80">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 3v18h18M7 16v-4m4 4V9m4 7v-2m4 2V5">
                                </path>
                            </svg>

                            <span>Estadísticas de consultas, ingresos y otros indicadores</span>
                        </div>
                    </div>

                    <a href="#"
                        class="cursor-pointer inline-flex items-center px-6 py-3 bg-gray-300 hover:bg-gray-800 text-black hover:text-gray-100 font-medium rounded-lg transition duration-300 group">
                        Acceder
                        <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <!-- Alertas y notificaciones -->

            <div class="bg-cover bg-center rounded-2xl overflow-hidden shadow-lg transition-transform duration-300 hover:scale-105 relative"
                style="background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('{{ asset('images/tests/alerta.jpg') }}');">

                <!-- Overlay con efecto de degradado -->
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-900/50 to-gray-900/80"></div>

                <div class="relative z-10 p-4 md:p-6">
                    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Alertas y notificaciones</h2>

                    <div class="space-y-4 mb-8">
                        <div class="flex items-center text-white/80">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405C18.79 15.21 18 13.702 18 12V8c0-3.314-2.686-6-6-6S6 4.686 6 8v4c0 1.702-.79 3.21-2.595 3.595L2 17h5m8 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>


                            <span>Vacunaciones, revisiones y seguimiento de tratamientos</span>
                        </div>
                    </div>

                    <a href="#"
                        class="cursor-pointer inline-flex items-center px-6 py-3 bg-gray-300 hover:bg-gray-800 text-black hover:text-gray-100 font-medium rounded-lg transition duration-300 group">
                        Acceder
                        <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div>

        @if($modal)
        {{-- backdrop-blur-xs --}}
        <div class="fixed inset-0 bg-black/50 flex items-center justify-center p-4 z-[9999]">
            <div class="bg-gray-100 rounded-2xl p-8 space-y-6 max-w-md w-full relative">
                <!-- Botón de cierre -->
                <button wire:click="cerrarModal" class=" cursor-pointer absolute top-3 right-3 text-gray-800 hover:text-gray-900">
                    <svg class="w-6 h-6 text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6"/>
                      </svg>                      
                </button>
        
                <h3 class="text-2xl font-bold text-center text-gray-800">¿Qué deseas gestionar?</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Opción Dueño -->
                    <a wire:navigate href="{{ route('add.dueno') }}" class="font-semibold bg-gray-800 hover:bg-gray-900 text-white p-4 rounded-lg transition flex items-center space-x-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span>Dueño</span>
                    </a>
              
                    <!-- Opción Mascota -->
                    <a wire:navigate href="{{ route('add.mascota') }}" class="font-semibold border border-gray-300 bg-gray-100 hover:bg-gray-200 text-gray-800 hover:border-gray-400 p-4 rounded-lg transition flex items-center space-x-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-cat"><path d="M12 5c.67 0 1.35.09 2 .26 1.78-2 5.03-2.84 6.42-2.26 1.4.58-.42 7-.42 7 .57 1.07 1 2.24 1 3.44C21 17.9 16.97 21 12 21s-9-3-9-7.56c0-1.25.5-2.4 1-3.44 0 0-1.89-6.42-.5-7 1.39-.58 4.72.23 6.5 2.23A9.04 9.04 0 0 1 12 5Z"/><path d="M8 14v.5"/><path d="M16 14v.5"/><path d="M11.25 16.25h1.5L12 17l-.75-.75Z"/></svg>
                        <span>Mascota</span>
                    </a>
                </div>
            </div>
        </div>    
        @endif
    </div>

    
    @livewireScripts
</div>