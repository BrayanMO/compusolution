@props(['product'])

<li class="bg-white rounded-lg shadow mb-4" >
    <article class="flex">
        <figure>
            <img class="h-48 w-full md:w-56 object-cover object-center rounded-lg" src="{{Storage::url($product->images->first()->url)}}" alt="">
        </figure>

        <div class="flex-1 py-4 px-6 flex flex-col">
            <div class="lg:flex justify-between">
                <div>
                    <h1 class="text-lg font-semibold text-gray-600">{{$product->name}}</h1>
                    <p class="font-bold text-gray-700">S/ {{$product->price}}</p>
                </div>

                @if($product->reviews->count())
                    <div class="flex items-center">
                        <ul class="flex text-sm ">
                            <li>
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                            </li>
                           
                        </ul>
                        <span class="text-gray-700 text-sm">({{$product->reviews->avg('rating')}})</span>
                    </div>
                @else
                    <i class="fas fa-star text-gray-700 ml-auto pt-1"></i>
                    <p>(0)</p>
                @endif
            </div>
            <div class="mt-4 md:mt-auto mb-4">
                <x-danger-enlace href="{{route('products.show', $product)}}">
                    Más información
                </x-danger-enlace>
            </div>
        </div>
    </article>
</li>
