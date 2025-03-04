<div class="backdrop-blur-xs fixed top-0 right-0 left-0 z-40 flex justify-center items-center w-full h-full bg-black/10">
    <div class="">

        <div class=" w-full max-w-4xl bg-white rounded-lg shadow-lg overflow-hidden grid grid-cols-1 md:grid-cols-2">
            <!-- Imagen -->
            <div class="hidden md:block ">
                <img src="{{ asset('images/tests/bg.jpg') }}" alt="Imagen de login" class="w-full h-full object-cover">
            </div>

            <!-- Formulario -->
            <div class="p-8 flex flex-col justify-center ">
               

                <h2 class="text-2xl font-semibold text-gray-700 text-center">Iniciar sesión</h2>

                <form action="{{ route('auth.login') }}" method="POST" class="mt-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-gray-600">Correo electrónico</label>
                        <input type="email" id="email" name="email" required
                            class="w-full px-4 py-2 mt-2 border rounded-lg focus:ring focus:ring-blue-200">
                    </div>

                    <div class="mt-4">
                        <label for="password" class="block text-gray-600">Contraseña</label>
                        <input type="password" id="password" name="password" required
                            class="w-full px-4 py-2 mt-2 border rounded-lg focus:ring focus:ring-blue-200">
                    </div>

                    <button type="submit"
                        class="w-full mt-6 px-4 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Iniciar sesión
                    </button>
                </form>

                <p class="mt-4 text-center text-gray-600">
                    ¿No tienes cuenta? <a href="{{ route('auth.registerform') }}"
                        class="text-blue-600 hover:underline">Regístrate</a>
                </p>
            </div>
        </div>

    </div>
</div>
