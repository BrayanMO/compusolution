<x-app-layout>
    <div class="container py-8">
        <div class="grid grid-cols-2 gap-6">
            <div>
                <div class="flexslider">
                    <ul class="slides">
                        @foreach ($product->images as $image)
                            <li data-thumb="{{ Storage::url($image->url)}}">
                                <img class="object-contain h-48 w-32 bg-size" src="{{ Storage::url($image->url)}}" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div>
                <h1 class="text-xl font-bold text-gray-700">{{$product->name}}</h1>

                <div class="flex mb-4">
                    <p class="text-gray-700">Marca: <a class="underline capitalize hover:text-orange-500" href="">{{$product->brand->name}}</a></p>
                    <p class="text-gray-700 mx-6">5 <i class="fas fa-star text-sm text-yellow-400"></i></p>
                    <a class="text-orange-500 hover:text-orange-600 underline " href="">39 reseñas</a>
                </div> 

                <span class="text-md font-semibold text-gray-500">{!!$product->description!!}</span>

                <p class="text-2xl font-semibold text-gray-700 my-4">S/ {{$product->price}}</p>

                <div class="bg-white rounded-lg shadow-lg mb-6">
                    <div class="p-4 flex items-center">
                        <span class="flex items-center justify-center h-10 w-10 rounded-full bg-greenLime-600">
                            <i class="fas fa-truck text-sm text-white"></i>
                        </span>
                        <div class="ml-4">
                            <p class="text-lg font-semibold text-greenLime-600">Se hacen envíos a todo el Perú</p>
                            <p>Recibelo el <span class=" font-semibold text-greenLime-600">{{Date::now()->addDay(3)->locale('es')->format('l j F')}}</span></p>
                        </div>
                    </div>
                </div>

                <div>
                    @livewire('add-cart-item', ['product' => $product])
                </div>



            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function() {
                $('.flexslider').flexslider({
                    animation: "slide",
                    controlNav: "thumbnails"
                });
            });
        </script>
    @endpush
</x-app-layout>
