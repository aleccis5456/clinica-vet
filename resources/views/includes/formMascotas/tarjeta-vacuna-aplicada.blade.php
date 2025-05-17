 @if ($vacuna->etiqueta == null)
     <p class="font-semibold text-sm">{{ $vacuna->producto->nombre }}</p>
     <div class="max-w-sm">
         <form wire:submit.prevent="guardarEtiqueta({{ $vacuna->id }})" class="max-w-sm" enctype="multipart/form-data">
             <input wire:model='etiqueta' type="file" id="fileInput" class="hidden">
             @if ($preview && $vacunaId == $vacuna->id)
                 <div class="w-36 h-36 relative bg-white m-12">
                     <img class="w-auto h-auto object-cover  rounded-md  " src="{{ $preview }}" alt="">
                     <button
                         class="cursor-pointer absolute top-0 right-0 bg-red-500 text-white rounded-full p-1 hover:bg-gray-100 hover:text-black"
                         wire:click="removeImage" type="button">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="w-4 h-4">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                         </svg>
                     </button>
                     <button
                         class="text-xs text-center mt-4 font-semibold text-gray-100 bg-gray-800 rounded-md px-2 py-1 cursor-pointer hover:bg-gray-700"
                         type="submit">Guardar</button>
                 </div>
             @else
                 <label for="fileInput" class="cursor-pointer flex" wire:click="setVacunaId({{ $vacuna->id }})">
                     <div class="bg-gray-200 rounded-md px-2 py-1 mr-2">
                         <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-6">
                             <path stroke-linecap="round" stroke-linejoin="round"
                                 d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                         </svg>
                     </div>
                     <span class="text-xs mt-2 font-semibold text-gray-500">
                         Agregar Etiqueta
                     </span>
             @endif
             </label>
         </form>
     </div>
     
 @else
     <div class="relative flex gap-2 items-center">
         <p class="text-sm font-semibold text-gray-700">
             {{ $vacuna->producto->nombre }}</p>
         <div class="group">
             <img class=" w-12 h-12 transition-all duration-150 group-hover:scale-500 group-hover:mb-26"
                 src="{{ asset("uploads/etiquetas/$vacuna->etiqueta") }}" alt="">
             <button wire:click="deleteImage({{ $vacuna->id }})" type="button"
                 class="cursor-pointer opacity-0 transition-ease-in duration-500 group-hover:opacity-100 -z-10 group-hover:z-40 absolute {{ $contador == 1 ? '-top-8 -right-22' : '-top-23 -right-22' }} bg-red-500 text-white rounded-full p-1 hover:bg-gray-100 hover:text-black">
                 <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                     stroke="currentColor" class="w-4 h-4">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                 </svg>
             </button>
         </div>
     </div>
 @endif
