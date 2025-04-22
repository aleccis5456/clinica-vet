<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registro</title>
    @vite('resources/css/app.css')
</head>

<body
    class="backdrop-blur-xs flex items-center justify-center min-h-screen bg-white bg-hero bg-no-repeat bg-cover bg-center bg-fixed"
    style="background-image: url('{{ asset('bg/bg1.png') }}')">
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2">
        <!-- Imagen -->
        <div class="hidden md:block">
            <img src="{{ asset('images/tests/bg.jpg') }}" alt="Imagen de login" class="w-full h-full object-cover">
        </div>

        <!-- Formulario -->
        <div class="p-8 flex flex-col justify-center">
            <h2 class="text-2xl font-semibold text-gray-700 text-center">Registro</h2>

            <form action="{{ route('auth.register') }}" method="POST" class="mt-6">
                @csrf
                <input type="hidden" name="admin_user" value="{{ true }}">
                <div>
                    <label for="nombre" class="block text-gray-600">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required
                        class="w-full px-4 py-2 mt-2 border rounded-lg focus:ring focus:ring-blue-200">
                    @error('nombre')
                        <div class="mt-2 flex items-center text-sm text-red-600 bg-red-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>


                <div>
                    <label for="email" class="block mt-2 text-gray-600">Correo electrónico</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-2 mt-2 border rounded-lg focus:ring focus:ring-blue-200">
                        @error('email')
                        <div class="mt-2 flex items-center text-sm text-red-600 bg-red-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-gray-600">Contraseña</label>
                    <input type="password" id="password" name="password" required
                        class="w-full px-4 py-2 mt-2 border rounded-lg focus:ring focus:ring-blue-200">
                        @error('password')
                        <div class="mt-2 flex items-center text-sm text-red-600 bg-red-100 p-2 rounded-lg">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            <span>{{ $message }}</span>
                        </div>
                    @enderror
                </div>

                <button type="submit"
                    class="w-full mt-6 px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Registrar
                </button>
            </form>

            <p class="mt-4 text-center text-gray-600">
                Volver <a wire:navigate href="{{ route('index') }}" class="text-blue-600 hover:underline">Iniciar
                    Sesion</a>
            </p>
        </div>
    </div>
</body>

</html>
