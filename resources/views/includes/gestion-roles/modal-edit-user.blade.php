<div id="" tabindex="-1"
    class=" fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full h-full bg-black/50">
    <div class="relative p-4 w-full max-w-md">
        <button type="button"
            class="m-2 absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center"
            wire:click="editUserFalse">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Cerrar</span>
        </button>

        <form action="{{ route('user.update') }}" method="POST"
            class="bg-white border border-gray-100 p-8 max-w-md mx-auto shadow-lg  rounded-lg max-h-[620px] outline-none overflow-x-hidden overflow-y-auto">
            @csrf
            <p class="text-2xl font-semibold text-center text-gray-800 mb-6">Editar Usuario</p>
            <input type="hidden" name="userId" value="{{ $userToEdit->id }}">
            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Nombre</label>
                <input name="name" type="text" value="{{ $userToEdit->name }}"
                    class="select2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                <p>
                    @error('rolName')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">E mail</label>
                <input name="email" type="email" value="{{ $userToEdit->email }}"
                    class="select2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">
                <p>
                    @error('rolName')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-800 font-medium mb-2">Contraseña</label>
                <input name="password" type="password" placeholder="Ingrese nueva constaseña"
                    class="select2 w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100">                
                <p>
                    @error('rolName')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>


            <div class="mb-4 ">
                <label class="block text-gray-800 font-medium mb-2">Rol</label>
                <select name="rol" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:bg-gray-100" >
                    <option value="">-Seleccione un rol-</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id }}" {{ $rol->id == $userToEdit->rol_id ? 'selected' : '' }}>{{ $rol->name }}</option>
                    @endforeach
                </select>                
                <p>
                    @error('rolName')
                        <span class="text-red-700 underline">{{ $message }}</span>
                    @enderror
                </p>
            </div>

            <button type="submit"
                class="w-full bg-gray-800 text-white font-medium py-2 rounded-md hover:bg-black transition duration-300">
                Guardar
            </button>        

        </form>

    </div>

</div>