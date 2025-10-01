<x-filament::page>
    {{-- Konten dashboard --}}
    @if ($showOrderModal)
        <x-filament::modal id="orderModal" wire:model="showOrderModal">
            <x-slot name="heading">
                Pesanan Baru Masuk
            </x-slot>

            <p>Ada order #{{ $latestOrder->id }} dengan metode pembayaran {{ $latestOrder->payment_method }}.</p>

            <x-slot name="footer">
                <button wire:click="closeModal" class="filament-button">
                    Tutup
                </button>
            </x-slot>
        </x-filament::modal>
    @endif
</x-filament::page>
