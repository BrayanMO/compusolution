<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight capitalize">
            Departamento: {{ $department->name }}
        </h2>
    </x-slot>

    <div class="container py-12">
        {{-- Agregar Ciudad --}}
        <x-jet-form-section submit="save" class="mb-6">
            <x-slot name="title">
                Agregar una nueva Provincia
            </x-slot>

            <x-slot name="description">
                Complete la información necesaria para agregar una nuevo provincia
            </x-slot>

            <x-slot name="form">
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label>
                        Nombre
                    </x-jet-label>
                    <x-jet-input wire:model.defer="createForm.name" type="text" class="w-full mt-1" />
                    <x-jet-input-error for="createForm.name" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label>
                        Costo
                    </x-jet-label>
                    <x-jet-input wire:model.defer="createForm.cost" type="text" class="w-full mt-1" />
                    <x-jet-input-error for="createForm.cost" />
                </div>
            </x-slot>

            <x-slot name="actions">
                <x-jet-action-message class="mr-3" on="saved">
                    Provincia agregada
                </x-jet-action-message>
                <x-jet-button>
                    Agregar
                </x-jet-button>
            </x-slot>
        </x-jet-form-section>

        {{-- Mostrar Departamentos --}}
        <x-jet-action-section>
            <x-slot name="title">
                Lista de Provincias
            </x-slot>

            <x-slot name="description">
                Aquí encontrará todas las provincias agregadas
            </x-slot>

            <x-slot name="content">

                <table class="text-gray-600">
                    <thead class="border-b border-gray-300">
                        <tr class="text-left">
                            <th class="py-2 w-full">Nombre</th>
                            <th class="py-2">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-300">
                        @foreach ($cities as $city)
                            <tr>
                                <td class="py-2">
                                    <a href="{{ route('admin.cities.show', $city) }}" class="upercase underline hover:text-blue-600">
                                        {{ $city->name }}
                                    </a>

                                </td>
                                <td class="py-2">
                                    <div class="flex divide-x divide-gray-300 font-semibold">
                                        <a class="pr-2 hover:text-blue-600 cursor-pointer" wire:click="edit({{ $city }})">Editar</a>
                                        <a class="pl-2 hover:text-red-600 cursor-pointer" wire:click="$emit('deleteCity', {{ $city->id }})">Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-slot>
        </x-jet-action-section>

        {{-- Modal Editar --}}
        <x-jet-dialog-modal wire:model="editForm.open" wire:ignore>
            <x-slot name="title">
                Editar provincia
            </x-slot>
            <x-slot name="content">

                <div class="space-y-3">
                    <div>
                        <x-jet-label class="mt-3">
                            Nombre
                        </x-jet-label>

                        <x-jet-input wire:model="editForm.name" type="text" class="w-full mt-1" />

                        <x-jet-input-error for="editForm.name" />
                    </div>

                    <div>
                        <x-jet-label class="mt-3">
                            Costo
                        </x-jet-label>

                        <x-jet-input wire:model="editForm.cost" type="text" class="w-full mt-1" />

                        <x-jet-input-error for="editForm.cost" />
                    </div>
                </div>

            </x-slot>
            <x-slot name="footer">
                <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" wire:target="update">
                    Actualizar
                </x-jet-danger-button>
            </x-slot>
        </x-jet-dialog-modal>

    </div>
        @push('script')

            <script>
                Livewire.on('deleteCity', cityId => {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Livewire.emitTo('admin.show-department', 'delete', cityId)
                            Swal.fire(
                                'Deleted',
                                'You file has been deleted',
                                'success'
                            )
                        }
                    })
                });
            </script>

        @endpush

</div>
