<div>

    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="font-semibold text-xl font-gray-800 leading-tight">
                    Productos
                </h1>

                <x-jet-danger-button wire:click="$emit('deleteProduct')">
                    Eliminar
                </x-jet-danger-button>

            </div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-gray-700">

        <h1 class="text-3xl text-center font-semibold mb-8">Complete esta información para crear un producto</h1>

        <div class="mb-4" wire:ignore>
            <form action="{{ route('admin.products.files', $product) }}" method="POST" class="dropzone"
                id="my-awesome-dropzone">
            </form>
        </div>

        @if ($product->images->count())
            <section class="bg-white shadow-xl rounded-lg p-6 mb-4">
                <h1 class="text-2xl text-center font-semibold mb-3">Imagenes del producto</h1>

                <ul class="flex flex-wrap">
                    @foreach ($product->images as $image)
                        <li class="relative" wire:key="image-{{ $image->id }}">
                            <img class="w-32 h-20 object-cover" src="{{ Storage::url($image->url) }}" alt="">
                            <x-jet-danger-button class="absolute right-2 top-2 w-3 h-3 opacity-70 hover:opacity-100"
                                wire:click="deleteImage({{ $image->id }})" wire:loading.attr="disable"
                                wire:target="deleteImage({{ $image->id }})">
                                x
                            </x-jet-danger-button>
                        </li>
                    @endforeach

                </ul>
            </section>
        @endif

        @livewire('admin.status-product', ['product' => $product], key('status-product-' . $product->id))


        <div class="bg-white shadow-xl rounded-lg p-6">
            <div class="grid grid-cols-2 gap-6 mb-4">

                {{-- Categoria --}}
                <div>
                    <x-jet-label class="mb-2 text-md" value="Categorías" />
                    <select class="w-full form-control border-gray-200 shadow rounded-lg" wire:model="category_id">
                        <option value="" selected disabled>Seleccione una categoría</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach

                    </select>
                    <x-jet-input-error for="product.category_id" />
                </div>


                {{-- Subcategoria --}}

                <div>
                    <x-jet-label class="mb-2 text-md" value="Subcategorías" />
                    <select class="w-full form-control border-gray-200 shadow rounded-lg"
                        wire:model="product.subcategory_id">
                        <option value="" selected disabled>Seleccione una subcategoría</option>

                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                        @endforeach

                    </select>
                    <x-jet-input-error for="subcategory_id" />
                </div>

            </div>

            {{-- Nombre --}}
            <div class="mb-4">
                <x-jet-label value="Nombre" />
                <x-jet-input class="w-full" type="text" wire:model="product.name"
                    placeholder="Ingrese el nombre del producto" />
                <x-jet-input-error for="product.name" />
            </div>

            {{-- Slug --}}
            <div class="mb-4">
                <x-jet-label value="Slug" />
                <x-jet-input class="w-full bg-gray-200" type="text" wire:model="slug"
                    placeholder="Ingrese el slug del producto" disabled />
                <x-jet-input-error for="slug" />
            </div>

            {{-- descripcion --}}
            <div class="mb-4">

                <div wire:ignore>
                    <x-jet-label value="Descripción" />

                    <textarea class="w-full form-control rounded-lg border-gray-300 shadow" rows="10"
                        wire:model="product.description" x-data x-init="ClassicEditor
                        .create( $refs.miEditor )
                        .then(function(editor){
                            editor.model.document.on('change:data', () => {
                                @this.set('product.description', editor.getData())
                            })
                        })
                        .catch( error => {
                            console.error( error );
                        } );" x-ref="miEditor"></textarea>
                </div>
                <x-jet-input-error for="product.description" />
            </div>


            <div class="grid grid-cols-2 gap-6 mb-4">
                {{-- Marca --}}
                <div>
                    <x-jet-label value="Marca" />
                    <select class="w-full form-control border-gray-200 shadow rounded-lg" wire:model="product.brand_id">
                        <option value="" selected disabled>Seleccione una marca</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="product.brand_id" />
                </div>

                {{-- Precio --}}
                <div>
                    <x-jet-label value="Precio" />
                    <x-jet-input wire:model="product.price" type="number" class="w-full" step=".01" />
                    <x-jet-input-error for="product.price" />
                </div>

                {{-- Cantidad --}}
            </div>

            <div>
                <x-jet-label value="Cantidad" />
                <x-jet-input wire:model="product.quantity" type="number" class="w-full" step=".01" />
                <x-jet-input-error for="product.quantity" />
            </div>

            <div class="flex justify-end items-center mt-4">

                <x-jet-action-message class="mr-3" on="saved">
                    Guardado Correctamente
                </x-jet-action-message>

                <a href="{{route('admin.index')}}">
                    <x-jet-button wire:loading.attr="disable" wire:target="save" wire:click="save">
                        Guardar Producto
                    </x-jet-button>
                </a>
            </div>
        </div>


    </div>

    @push('script')
        <script>
            Dropzone.options.myAwesomeDropzone = { // camelized version of the `id`
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dictDefaultMessage: "Arrastre una imagen aquí",
                acceptedFiles: 'image/*',
                paramName: "file", // The name that will be used to transfer the file
                maxFilesize: 2, // MB
                complete: function(file) {
                    this.removeFile(file);
                },
                queuecomplete: function() {
                    Livewire.emit('refreshProduct');
                }
            };

            Livewire.on('deleteProduct', () => {
                Swal.fire({
                    title: '¿Estás Seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, borrar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Livewire.emitTo('admin.edit-product', 'delete');
                        Swal.fire(
                            '¡Eliminado!',
                            'El producto ha sido eliminado.',
                            'success'
                        )
                    }
                })
            })

        </script>
    @endpush


</div>
