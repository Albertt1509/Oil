<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-500">Pesanan Saya</h1>
    <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase"></th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status
                                    Pesanan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status
                                    Pembayaran</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Jumlah
                                    Pesanan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                @php
                                    $status = '';
                                    $payment_status = '';
                                    if ($order->status == 'new') {
                                        $status =
                                            '<span class="bg-blue-500 py-1 px-3 rounded text-white shadow">Baru</span>';
                                    } elseif ($order->status == 'processing') {
                                        $status =
                                            '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Sedang Diproses</span>';
                                    } elseif ($order->status == 'shipped') {
                                        $status =
                                            '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Dikirim</span>';
                                    } elseif ($order->status == 'delivered') {
                                        $status =
                                            '<span class="bg-purple-500 py-1 px-3 rounded text-white shadow">Terkirim</span>';
                                    } elseif ($order->status == 'cancelled') {
                                        $status =
                                            '<span class="bg-gray-500 py-1 px-3 rounded text-white shadow">Dibatalkan</span>';
                                    }
                                    if ($order->payment_status == 'pending') {
                                        $payment_status =
                                            '<span class="bg-yellow-500 py-1 px-3 rounded text-white shadow">Menunggu Pembayaran</span>';
                                    } elseif ($order->payment_status == 'paid') {
                                        $payment_status =
                                            '<span class="bg-green-500 py-1 px-3 rounded text-white shadow">Lunas</span>';
                                    } elseif ($order->payment_status == 'failed') {
                                        $payment_status =
                                            '<span class="bg-red-500 py-1 px-3 rounded text-white shadow">Gagal</span>';
                                    }
                                @endphp
                                <tr class="odd:bg-white even:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-black"
                                        wire:key="{{ $order->id }}">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                        {{ $order->created_at->format('d-m-Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                        {!! $status !!}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                        {!! $payment_status !!}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-black">
                                        {{ Number::currency($order->grand_total, 'IDR') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <a href="/my-orders/{{ $order->id }}"
                                            class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">Lihat
                                            Detail</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
