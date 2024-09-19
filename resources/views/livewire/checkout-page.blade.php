<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-dark= mb-4">
        Checkout
    </h1>
    <form action="" wire:submit.prevent='placeorder'>
        <div class="grid grid-cols-12 gap-4">
            <div class="md:col-span-12 lg:col-span-8 col-span-12">
                <!-- Card -->
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-white">
                    <!-- Shipping Address -->
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-700 dark:text-dark mb-2">
                            Shipping Address
                        </h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 dark:text-dark mb-1" for="first_name">
                                    First Name
                                </label>
                                <input wire:model='first_name'
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-white dark:text-dark black:border-none"
                                    id="first_name" type="text">
                                </input>
                            </div>
                            <div>
                                <label class="block text-gray-700 dark:text-dark mb-1" for="last_name">
                                    Last Name
                                </label>
                                <input wire:model='last_name'
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-white dark:text-dark black:border-none"
                                    id="last_name" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="">
                                <label class="block text-gray-700 dark:text-dark mb-1" for="phone">
                                    Phone
                                </label>
                                <input wire:model='phone'
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-white dark:text-dark black:border-none"
                                    id="phone" type="text">
                                </input>
                            </div>
                            <div>
                                <label class="block text-gray-700 dark:text-dark mb-1" for="zip">
                                    Pos Code
                                </label>
                                <input wire:model='zip_code'
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-white dark:text-dark black:border-none"
                                    id="zip" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-dark mb-1" for="address">
                                Address
                            </label>
                            <input wire:model='street_address'
                                class="w-full rounded-lg border py-2 px-3 dark:bg-white dark:text-dark black:border-none"
                                id="address" type="text">
                            </input>
                            <label class="block text-gray-700 dark:text-dark mb-1" for="notes">
                                Note
                            </label>
                            <input wire:model='notes'
                                class="w-full rounded-lg border py-2 px-3 dark:bg-white dark:text-dark black:border-none"
                                id="notes" type="text">
                            </input>
                        </div>
                    </div>
                    <div class="text-lg font-semibold mb-4">
                        Select Payment Method
                    </div>
                    <ul class="grid w-full gap-6 md:grid-cols-2">
                        <li>
                            <input wire:model='payment_method' class="hidden peer" id="payment_cod" type="radio"
                                value="cod" required>
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-white dark:hover:bg-gray-700"
                                for="payment_cod">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        Cash on Delivery
                                    </div>
                                </div>
                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                    viewBox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </label>
                        </li>
                        <li>
                            <input wire:model='payment_method' class="hidden peer" id="payment_bank_transfer"
                                type="radio" value="Transfer">
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-white dark:hover:bg-gray-700"
                                for="payment_bank_transfer">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        Bank Transfer
                                    </div>
                                </div>
                                <svg aria-hidden="true" class="w-5 h-5 ms-3 rtl:rotate-180" fill="none"
                                    viewBox="0 0 14 10" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1 5h12m0 0L9 1m4 4L9 9" stroke="currentColor" stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"></path>
                                </svg>
                            </label>
                        </li>
                    </ul>

                    <!-- Bank Transfer Details -->
                    @if ($payment_method === 'Transfer')
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-dark mb-1" for="whatsapp_number">
                                WhatsApp Number
                            </label>
                            <select id="whatsapp_number"
                                class="w-full rounded-lg border py-2 px-3 dark:bg-white dark:text-dark black:border-none">
                                <option value="+628123456789">+628123456789</option>
                                <option value="+628987654321">+628987654321</option>
                                <option value="+628555555555">+628555555555</option>
                            </select>
                            <div class="mt-2">
                                <a id="whatsapp_link"
                                    class="bg-green-500 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600 block text-center"
                                    href="https://wa.me/628123456789" target="_blank">
                                    Contact via WhatsApp
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
                <!-- End Card -->
            </div>
            <div class="md:col-span-12 lg:col-span-4 col-span-12">
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-white">
                    <div class="text-xl font-bold text-gray-700 dark:text-black mb-4">
                        ORDER SUMMARY
                    </div>
                    <div class="mb-4">
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700 space-y-2" role="list">
                            @foreach ($cart_items as $item)
                                <li class="py-3 sm:py-4" wire:key='{{ $item['product_id'] }}'>
                                    <div class="flex items-center w-full">
                                        <div class="flex-1 min-w-0 ml-4">
                                            <p class="text-sm font-medium text-black">
                                                {{ $item['name'] }}
                                            </p>
                                            <p class="text-sm  truncate text-black">
                                                Quantity: {{ $item['quantity'] }}
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-black">
                                            {{ Number::currency($item['total_amount']) }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <hr class="bg-slate-400 my-4 h-1 rounded">
                    <div class="flex justify-between mb-2 font-bold text-black">
                        <span>
                            Total Item
                        </span>
                        <span>
                            {{ Number::currency($grand_total, 'IDR') }}
                        </span>
                    </div>
                </div>

                <button type="submit"
                    class="bg-green-500 mt-4 w-full p-3 rounded-lg text-lg text-white hover:bg-green-600">
                    Place Order
                </button>
            </div>
        </div>
    </form>
</div>
