<div class="space-y-4">
    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Customer:</strong> {{ $order->user->name ?? '-' }}</p>
    <p><strong>Total:</strong> Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
    <p><strong>Payment:</strong> {{ $order->payment_method }}</p>

</div>
