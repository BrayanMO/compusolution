<div class="container py-8 grid lg:grid-cols-2 xl:grid-cols-5 gap-6">

    <div class="order-2 lg:order-1 lg:col-span-1 xl:col-span-3">

        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <x-jet-label value="Nombre de contácto" />
                <x-jet-input type="text"
                            wire:model.defer="contact" {{-- el ..defer hara que se actulice la info despues de presionar el boton continuar --}}
                            placeholder="Ingrese el nombre de la persona que recibirá el producto"
                            class="w-full"/>
                <x-jet-input-error for="contact" />
            </div>

            <div class="mb-4">
                <x-jet-label value="Dni de contácto" />
                <x-jet-input type="text"
                            wire:model.defer="dni" {{-- el ..defer hara que se actulice la info despues de presionar el boton continuar --}}
                            placeholder="Ingrese el dni de la persona que recibirá el producto"
                            class="w-full"/>
                <x-jet-input-error for="dni" />
            </div>

            <div>
                <x-jet-label value="Telefono de contácto" />
                <x-jet-input type="text"
                            wire:model.defer="phone"
                            placeholder="Ingrese un número de telefono de contácto"
                            class="w-full"/>
                <x-jet-input-error for="phone" />
            </div>
        </div>

       <div x-data="{envio_type: @entangle('envio_type')}">
            <p class="mt-6 mb-3 text-lg text-gray-700 font-semibold">Envíos</p>

            <label class="bg-white rounded-lg shadow px-6 py-4 flex items-center mb-4">
                <input x-model="envio_type" type="radio" value="1" name="envio_type" class="text-gray-600" >
                <span class="ml-2 text-gray-700">
                    Recojo en tienda (Jr. Pedro Chamochumbe Nro. 491 - El Agustino - Lima)
                </span>
                <span class="font-semibold text-gray-700 ml-auto">
                    Gratis
                </span>
            </label>

            <div class="bg-white rounded-lg shadow">
                <label class=" px-6 py-4 flex items-center">
                    <input x-model="envio_type" type="radio" value="2" name="envio_type" class="text-gray-600" >
                    <span class="ml-2 text-gray-700">
                        Envío a docimilio
                    </span>

                </label>

                <div class="px-6 pb-6 grid grid-cols-2 gap-6 hidden" :class="{ 'hidden': envio_type != 2 }">{{--  si lo que va a retornar de la clase dinamica es un verdadero, lo va a ocultar - sino lo contrario, EFECTO CONTRARIO--}}

                    {{-- Departamentos --}}
                    <div>
                        <x-jet-label value="Departamento" />

                        <select class="rounded-lg border-gray-300 shadow w-full" wire:model="department_id">

                            <option value="" disabled selected>Seleccione un departamento</option>

                            @foreach ($departments as $department)
                                <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>

                        <x-jet-input-error for="department_id" />

                    </div>

                    {{-- Ciudades --}}
                    <div>
                        <x-jet-label value="Provincia" />

                        <select class="rounded-lg border-gray-300 shadow w-full" wire:model="city_id">

                            <option value="" disabled selected>Seleccione una provincia</option>

                            @foreach ($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="city_id" />
                    </div>

                     {{-- Distritos --}}
                    <div>
                        <x-jet-label value="Distrito" />

                        <select class="rounded-lg border-gray-300 shadow w-full" wire:model="district_id">

                            <option value="" disabled selected>Seleccione un distrito</option>

                            @foreach ($districts as $district)
                                <option value="{{$district->id}}">{{$district->name}}</option>
                            @endforeach
                        </select>
                        <x-jet-input-error for="district_id" />
                    </div>

                    <div>
                        <x-jet-label value="Dirección" />
                        <x-jet-input wire:model="address" type="text" class="w-full" /> {{-- model: sincronizar propiedades --}}
                        <x-jet-input-error for="address" />
                    </div>

                    <div class="col-span-2">
                        <x-jet-label value="Referencia" />
                        <x-jet-input wire:model="reference" type="text" class="w-full" /> {{-- model: sincronizar propiedades --}}
                        <x-jet-input-error for="reference" />
                    </div>

                </div>
            </div>
       </div>

       <div>
           <x-jet-button
             wire:loading.attr="disabled"
             wire:target="create_order"
             class="mt-6 mb-4"
             wire:click="create_order">
               Continuar con la compra
           </x-jet-button>

           <hr>

           <p class="text-gray-500 text-sm mt-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat error iure deleniti veniam pariatur expedita cumque doloribus voluptatem. <a href="" class="font-semibold text-orange-500 hover:underline">Políticas y Privacidad</a></p>
       </div>

    </div>

    <div class="order-1 lg:order-2 lg:col-span-1 xl:col-span-2">
       <div class="bg-white rounded-lg shadow p-6">
            <ul>
                @forelse (Cart::content() as $item)
                    <li class="flex  p-2 border-b border-gray-200">
                        <img class="h-15 w-20 object-cover mr-4 rounded-lg " src="{{$item->options->image}}" alt="">

                        <article class="flex-1">
                            <h1 class="font-bold">{{$item->name}}</h1>

                            <p>Cant: {{$item->qty}}</p>

                            <p>S/ {{$item->price}} </p>

                        </article>
                    </li>
                @empty
                    <li class="py-6 px-4">
                        <p class="text-center text-gray-700">
                            No tiene agregado ningún item en el carrito
                        </p>
                    </li>

                @endforelse
            </ul>

            <hr class="mt-4 mb-3">

            <div class="text-gray-700 ">
                <p class="flex justify-between items-center">
                    Subtotal
                    <span class="font-semibold">S/ {{str_replace(",", "", Cart::subtotal())}} </span>
                </p>
                <p class="flex justify-between items-center">
                    Envío
                    <span class="font-semibold">
                        @if ($envio_type == 1 || $shipping_cost == 0 )
                            Gratis
                        @else
                            S/ {{$shipping_cost}}
                        @endif
                    </span>
                </p>

                <hr class="mt-4 mb-3">

                <p class="flex justify-between items-center font-semibold">
                    <span class="text-lg">Total </span>
                    @if ($envio_type == 1)
                        S/ {{str_replace(",", "", Cart::subtotal())}}
                    @else
                    S/ {{str_replace(",", "", Cart::subtotal()) + $shipping_cost}}
                    @endif
                </p>

            </div>
       </div>
    </div>

</div>
