<div class="">
    <div class="w-full h-screen bg-[#dcdcdc] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Grid -->
            <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
                <div>
                    <h1
                        class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white">
                        Temukan Kemurnian <span class="text-yellow-600">Minyak Goreng Kami</span>
                    </h1>
                    <p class="mt-3 text-lg ">
                        Beli minyak goreng premium yang dibuat dengan kualitas, rasa, dan kesehatan.
                    </p>
                    <!-- Tombol -->
                    <div class="mt-7  w-full sm:inline-flex">
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold  border border-transparent bg-yellow-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/register">
                            Mulai Sekarang
                        </a>
                        <a class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium  border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                            href="/contact">
                            Hubungi Tim Penjualan
                        </a>
                    </div>
                    <!-- Akhir Tombol -->
                </div>
                <!-- Akhir Kolom -->
                <div class="relative ms-4">
                    <img class="w-full rounded-md"
                        src="https://static.vecteezy.com/system/resources/previews/011/993/278/non_2x/3d-render-online-shopping-bag-using-credit-card-or-cash-for-future-use-credit-card-money-financial-security-on-mobile-3d-application-3d-shop-purchase-basket-retail-store-on-e-commerce-free-png.png"
                        alt="Deskripsi Gambar">
                    <div
                        class="absolute inset-0 -z-[1] bg-gradient-to-tr from-gray-200 via-white/0 to-white/0 w-full h-full rounded-md mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-slate-800 dark:via-slate-900/0 dark:to-slate-900/0">
                    </div>
                </div>
                <!-- Akhir Kolom -->
            </div>
            <!-- Akhir Grid -->
        </div>
    </div>
    {{-- merek --}}
    <div class="bg-[#dcdcdc]">
        <div class="text-center ">
            <h1 class="block text-3xl font-bold lg:text-6xl lg:leading-tight dark:text-yellow-600">Emas Murni di Setiap
                Tetesan</h1>
            <div class="">
                <p class="text-lg">Rasakan Kualitas Rasa</p>
            </div>
        </div>

        <div class="container mx-auto pt-8 pb-8 grid grid-cols-5 gap-4 relative overflow-hidden">
            @foreach ($brands as $index => $brand)
                <div class="box rounded-lg bg-cover bg-center transition-all duration-300"
                    style="background-image: url('{{ asset('storage/' . $brand->image) }}');"
                    wire:key="{{ $brand->id }}" data-text="{{ $brand->name }}"></div>
            @endforeach
        </div>
    </div>
    {{-- lokasi --}}
    <div class="bg-[#dcdcdc] grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
        <!-- Bagian Kiri (Judul dan Konten) -->
        <div class="p-32">
            <h1 class="text-3xl lg:text-4xl font-bold mb-4 text-yellow-600 flex items-center">
                Mengapa Memilih Kami
            </h1>
            <p class="text-lg lg:text-xl mb-6 text-full text-justify">
                Kami berkomitmen untuk menyediakan minyak goreng dengan kualitas terbaik, diproduksi secara hati-hati
                agar menjaga kemurnian, cita rasa, dan manfaat kesehatan bagi setiap konsumen. Dengan menggunakan
                bahan-bahan alami dan proses pengolahan yang ramah lingkungan, kami memastikan setiap tetes minyak yang
                Anda gunakan memberikan hasil terbaik untuk masakan Anda.
            </p>

        </div>
        <!-- Bagian Kanan (Gambar) -->
        <div class="w-full lg:pl-8 flex justify-center relative">
            <div
                class="absolute left-48 transform -translate-x-2 -translate-y-10 w-40 h-40 bg-yellow-600 z-0 rounded-lg overflow-hidden">
                <!-- Efek Stroke -->
                <div class="absolute inset-0 bg-transparent border-4 border-yellow-600"></div>
            </div>
            <!-- Lapisan Belakang -->
            <div
                class="w-52 h-48 bg-white rounded-lg overflow-hidden shadow-lg flex justify-center items-center relative z-10">
                <img src="{{ asset('images/logo.png') }}" alt="Gambar Artikel" class="w-96 h-64 object-cover">
            </div>
        </div>

    </div>
    @include('livewire.partials.footer')
</div>
