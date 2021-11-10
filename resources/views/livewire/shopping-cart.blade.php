<div class="container py-8">
    <section class="bg-white rounded-lg shadow-lg p-6 text-gray-500">
        <h1 class="text-lg font-semibold mb-6">CARRO DE COMPRAS</h1>

        @if (Cart::count())
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th></th>
                        <th>Precio</th>
                        <th>Cant</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach (Cart::content() as $item)
                        <tr>
                            <td>
                                <div class="flex mb-3">
                                    <img class="h-15 w-20 object-cover mr-4" src="{{$item->options->image}}" alt="">
                                    <div class="flex items-center">
                                        <p class="font-bold ">{{$item->name}}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">
                                <span>S/ {{$item->price}}</span>
                                <a class="ml-6 cursor-pointer hover:text-red-600"
                                    wire:click="delete('{{$item->rowId}}')"
                                    wire:loading.class="text-red-600 opacity-25"
                                    wire:target="delete('{{$item->rowId}}')"> {{-- metodo que quiere que se desencadene --}}
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>

                            <td>
                            <div class="flex justify-center">
                                @livewire('update-cart-item', ['rowId' => $item->rowId], key($item->rowId))
                                </div>
                            </td>

                            <td class="text-center">
                                S/ {{$item->price * $item->qty }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <a class="text-sm cursor-pointer hover:underline mt-3 inline-block"
                wire:click="destroy">

                <i class="fas fa-trash"></i>
                Borrar carrito de compras
            </a>
        @else
            <div class="flex flex-col items-center">
                <x-cart class="flex"/>
                <p class="text-lg text-gray-700 mt-4">Comienza tu experiencia de compra en CompuSolution con los mejores productos, al mejor precio.</p>

                <x-button-enlace href="/" class="mt-4 px-16">
                    Ir al inicio
                </x-button-enlace>

            </div>
        @endif
    </section>

    @if (Cart::count())

        <div class="bg-white rounded-lg shadow-lg px-6 py-4 mt-4">
            <div class="flex justify-between items-center">
                <div>
                    <p class="text-gray-700">
                        <span class="font-bold text-lg">Total: </span>
                        S/ {{Cart::subTotal()}}
                    </p>
                </div>

                <div>
                    <x-button-enlace href="{{route('orders.create')}}">
                        Continuar
                    </x-button-enlace>
                </div>

            </div>
        </div>

    @endif
</div>
