<div>
    <p class="font-semibold text-xl">Cantidad por especies</p>
    <div class="flex">
        @foreach ($especies as $especie)
            <div class="bg-gray-300 p-4 m-1 rounded-lg flex">
                <p class="font-semibold mr-1">{{ Str::ucfirst($especie->nombre) }}: </p>
                @php

                    $requestUserId = Auth::user()->id;
                    $user = App\Models\User::find($requestUserId);
                    if ($user->admin) {
                        $admin_id = $user->id;
                    } else {    
                        $admin_id = $user->admin_id;
                    }

                    $cantidad = 0;
                    $mascotas = App\Models\Mascota::where('especie_id', $especie->id)
                                                   ->where('owner_id', $admin_id)
                                                    ->get();

                    $cantidad = count($mascotas);
                @endphp
                <span> {{ $cantidad }}</span>

            </div>
        @endforeach
    </div>
</div>
