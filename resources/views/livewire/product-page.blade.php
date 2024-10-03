<div class="bg-[#dcdcdc]">
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <section class="py-10 bg-gray-50 font-poppins rounded-lg">
            <div class="px-4 py-4 mx-auto max-w-7xl lg:py-6 md:px-6">
                <div class="flex flex-wrap mb-24 -mx-3">
                    <div class="w-full pr-2 lg:w-1/4 lg:block">
                        <div class="p-4 mb-5 bg-white border border-gray-200 rounded-lg">
                            <h2 class="text-2xl font-bold dark:text-gray-400"> Categories</h2>
                            <div class="w-16 pb-2 mb-6  border-rose-600 dark:border-gray-400"></div>
                            <ul>
                                @foreach ($categories as $category)
                                    <li class="mb-4" wire:key='{{ $category->id }}'>
                                        <label for="{{ $category->slug }}"
                                            class="flex items-center dark:text-gray-400 ">
                                            <input type="checkbox" wire:model.live="selected_categories"
                                                id="{{ $category->id }}" value="{{ $category->id }}"
                                                class="w-4 h-4 mr-2">
                                            <span class="text-lg">{{ $category->name }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="p-4 mb-5 bg-white border border-gray-200 rounded-lg">
                            <h2 class="text-2xl font-bold dark:text-gray-400">Brand</h2>
                            <div class="w-16 pb-2 mb-6  border-rose-600 dark:border-gray-400"></div>
                            <ul>
                                @foreach ($brands as $brand)
                                    <li class="mb-4" wire:key='{{ $brand->id }}'>
                                        <label for="{{ $brand->slug }}" class="flex items-center dark:text-gray-300">
                                            <input type="checkbox" wire:model.live='selected_brands'
                                                id="{{ $brand->id }}" value="{{ $brand->id }}"
                                                class="w-4 h-4 mr-2">
                                            <span class="text-lg dark:text-gray-400">{{ $brand->name }}</span>
                                        </label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="p-4 mb-5 bg-white border border-gray-200 rounded-lg">
                            <h2 class="text-2xl font-bold dark:text-gray-400">Product Status</h2>
                            <div class="w-16 pb-2 mb-6 border-rose-600 dark:border-gray-400"></div>
                            <ul>
                                <li class="mb-4">
                                    <label for="featured" class="flex items-center dark:text-gray-300">
                                        <input type="checkbox" id="featured" wire:model.live="featured" value="1"
                                            class="w-4 h-4 mr-2">
                                        <span class="text-lg dark:text-gray-400">Featured</span>
                                    </label>
                                </li>
                                <li class="mb-4">
                                    <label for="on_sale" class="flex items-center dark:text-gray-300">
                                        <input type="checkbox" id="on_sale" wire:model.live='on_sale' value="1"
                                            class="w-4 h-4 mr-2">
                                        <span class="text-lg dark:text-gray-400">On Sale</span>
                                    </label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="w-full px-3 lg:w-3/4">
                        <div class="px-3 mb-4">
                            <div class="i hidden px-3 py-2 md:flex justify-end">
                                <input type="text"
                                    class="border-0 border-b-2 border-black bg-gray-50 focus:outline-none focus:border-black placeholder-gray-500"
                                    placeholder="search" wire:model.debounce.500ms="search">
                                <button type="submit" wire:click="searchUpdated">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-5 w-5 ml-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                                    </svg>
                                </button>
                            </div>

                        </div>
                        <div class="flex flex-wrap items-center">
                            @foreach ($products as $product)
                                <div class="w-full px-3 mb-6 sm:w-1/2 md:w-1/3 lg:w-1/4">
                                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                                        <div class="relative">
                                            <a href="/products/{{ $product->slug }}">
                                                <img src="{{ url('storage', $product->images[0]) }}"
                                                    alt="Product Image" class="object-cover w-full h-56">
                                            </a>
                                            <button wire:click='addToCart ({{ $product->id }})' href=""
                                                class="absolute top-2 right-2 bg-white p-2 rounded-full shadow-md">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-6 h-6 text-gray-800">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="p-4 bg-yellow-600 text-white">
                                            <h3 class="text-lg font-medium mb-2">{{ $product->name }}</h3>
                                            <p class="text-sm">{{ Number::currency($product->price, 'IDR') }}</p>
                                            <a href="/products/{{ $product->slug }}"
                                                class="bg-white text-yellow-600 p-2 rounded-lg flex items-center justify-center mt-3">
                                                <span>Buy</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <!-- pagination start -->
                    <div class="flex justify-end mt-6">
                        {{ $products->links() }}
                    </div>
                    <!-- pagination end -->
                </div>
            </div>
        </section>
    </div>
    @include('livewire.partials.footer')
</div>
