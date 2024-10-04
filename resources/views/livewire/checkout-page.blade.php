<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-2xl font-bold text-gray-800 dark:text-dark mb-4">
        Pembayaran
    </h1>
    <form action="" wire:submit.prevent='placeorder'>
        <div class="grid grid-cols-12 gap-4">
            <div class="md:col-span-12 lg:col-span-8 col-span-12">
                <!-- Kartu -->
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-white">
                    <!-- Alamat Pengiriman -->
                    <div class="mb-6">
                        <h2 class="text-xl font-bold text-gray-700 dark:text-dark mb-2">
                            Alamat Pengiriman
                        </h2>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-gray-700 dark:text-dark mb-1" for="first_name">
                                    Nama Depan
                                </label>
                                <input wire:model='first_name'
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-white dark:text-dark black:border-none"
                                    id="first_name" type="text">
                                </input>
                            </div>
                            <div>
                                <label class="block text-gray-700 dark:text-dark mb-1" for="last_name">
                                    Nama Belakang
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
                                    Telepon
                                </label>
                                <input wire:model='phone'
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-white dark:text-dark black:border-none"
                                    id="phone" type="text">
                                </input>
                            </div>
                            <div>
                                <label class="block text-gray-700 dark:text-dark mb-1" for="zip">
                                    Kode Pos
                                </label>
                                <input wire:model='zip_code'
                                    class="w-full rounded-lg border py-2 px-3 dark:bg-white dark:text-dark black:border-none"
                                    id="zip" type="text">
                                </input>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label class="block text-gray-700 dark:text-dark mb-1" for="address">
                                Alamat
                            </label>
                            <input wire:model='street_address'
                                class="w-full rounded-lg border py-2 px-3 dark:bg-white dark:text-dark black:border-none"
                                id="address" type="text">
                            </input>
                            <label class="block text-gray-700 dark:text-dark mb-1" for="notes">
                                Catatan
                            </label>
                            <input wire:model='notes'
                                class="w-full rounded-lg border py-2 px-3 dark:bg-white dark:text-dark black:border-none"
                                id="notes" type="text">
                            </input>
                        </div>
                    </div>
                    <div class="text-lg font-semibold mb-4">
                        Pilih Metode Pembayaran
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
                                        Bayar di Tempat (Cash on Delivery)
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
                                type="radio" value="Transfer" onclick="toggleBankInfo()">
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-white dark:hover:bg-gray-700"
                                for="payment_bank_transfer">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        Transfer Bank
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
                            <input wire:model='payment_method' class="hidden peer" id="payment_qris" type="radio"
                                value="Qris" onclick="toggleQRISImage()">
                            <label
                                class="inline-flex items-center justify-between w-full p-5 text-gray-500 bg-white border border-gray-200 rounded-lg cursor-pointer dark:hover:text-gray-300 dark:border-gray-700 dark:peer-checked:text-blue-500 peer-checked:border-blue-600 peer-checked:text-blue-600 hover:text-gray-600 hover:bg-gray-100 dark:text-gray-400 dark:bg-white dark:hover:bg-gray-700"
                                for="payment_qris">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">
                                        Qris
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

                    <!-- Dropdown Info Bank -->
                    <div id="bank-info" class="hidden mt-4 p-4 bg-gray-100 rounded-lg">
                        <h3 class="font-semibold text-lg">Informasi Transfer Bank</h3>
                        @foreach ($transfers as $transfer)
                            <ul class="list-disc pl-5 mt-2">
                                <li>Bank:{{ $transfer->nama_bank }}</li>
                                <li>Nomor Rekening: {{ $transfer->rekening }}</li>
                                <li>Atas Nama: {{ $transfer->nama_penerima }}</li>
                            </ul>
                        @endforeach
                    </div>

                    <!-- Gambar QRIS -->
                    <div id="qris-image" class="hidden mt-4">
                        <h3 class="font-semibold text-lg">QRIS</h3>
                        <img src={{ url('storage', $transfer->gambar) }} alt="QRIS" class="mt-2 w-48 h-48">
                    </div>
                </div>
                <!-- Akhir Kartu -->
            </div>
            <div class="md:col-span-12 lg:col-span-4 col-span-12">
                <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-white">
                    <div class="text-xl font-bold text-gray-700 dark:text-black mb-4">
                        RINGKASAN PESANAN
                    </div>
                    <div class="mb-4">
                        <ul class="divide-y divide-gray-200 dark:divide-gray-700 space-y-2" role="list">
                            @foreach ($cart_items as $item)
                                <li class="py-3 sm:py-4">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">

                                            <div class="ml-3">
                                                <div class="text-sm font-semibold text-gray-900 dark:text-black">
                                                    {{ $item['name'] }}
                                                </div>
                                                <div class="text-sm text-gray-500 dark:text-gray-600">
                                                    Jumlah: {{ $item['quantity'] }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-black">
                                            {{ Number::currency($item['total_amount'], 'IDR') }}
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
                    Pesan Sekarang
                </button>
                <div class="md:col-span-12 lg:col-span-4 col-span-12 pt-5">
                    <div class="bg-white rounded-xl shadow p-4 sm:p-7 dark:bg-white">
                        <div class="text-xl font-bold text-gray-700 dark:text-black mb-4">
                            Penting Untuk Dibaca
                        </div>
                        <div class="mb-4">
                            <h1 class="divide-y divide-gray-200 dark:divide-gray-700 space-y-2" role="list">
                                Jika melakukan pembayaran dengan menggunakan Transfer Bank dan Qris, wajib melampirkan
                                bukti pembayaran di nomor WA ini:
                                <a href="https://wa.me/62895613308484" class="text-blue-500 underline">
                                    08xxxxxxxxxx
                                </a>
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function toggleBankInfo() {
        const bankInfo = document.getElementById('bank-info');
        const qrisImage = document.getElementById('qris-image'); // Ambil elemen QRIS
        const transferRadio = document.getElementById('payment_bank_transfer');

        // Sembunyikan gambar QRIS jika metode transfer bank dipilih
        if (transferRadio.checked) {
            bankInfo.classList.remove('hidden');
            qrisImage.classList.add('hidden'); // Sembunyikan QRIS
        } else {
            bankInfo.classList.add('hidden');
        }
    }

    function toggleQRISImage() {
        const qrisImage = document.getElementById('qris-image');
        const bankInfo = document.getElementById('bank-info'); // Ambil elemen info bank
        const qrisRadio = document.getElementById('payment_qris');

        // Sembunyikan informasi transfer bank jika metode QRIS dipilih
        if (qrisRadio.checked) {
            qrisImage.classList.remove('hidden');
            bankInfo.classList.add('hidden'); // Sembunyikan info bank
        } else {
            qrisImage.classList.add('hidden');
        }
    }
</script>
