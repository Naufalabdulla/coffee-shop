<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-6">
        <h1 class="text-xl font-bold mb-4">My Transactions</h1>

        <table class="w-full border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border p-2">Order ID</th>
                    <th class="border p-2">Total</th>
                    <th class="border p-2">Status</th>
                    <th class="border p-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $transaction)
                    <tr>
                        <td class="border p-2">{{ $transaction->order_id }}</td>
                        <td class="border p-2">
                            Rp {{ number_format($transaction->total, 0, ',', '.') }}
                        </td>
                        <td class="border p-2">
                            <span class="px-2 py-1 rounded text-white
                                {{ $transaction->status === 'paid' ? 'bg-green-600' : 'bg-yellow-500' }}">
                                {{ strtoupper($transaction->status) }}
                            </span>
                        </td>
                        <td class="border p-2">
                            @if ($transaction->status === 'pending' && $transaction->snaptoken)
                                <button
                                    type="button"
                                    class="pay-btn bg-blue-600 text-white px-3 py-1 rounded"
                                    data-token="{{ $transaction->snaptoken }}">
                                    Pay Now
                                </button>
                            @else
                                —
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- MIDTRANS --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script>

        document.addEventListener('click', function (e) {
            if (!e.target.classList.contains('pay-btn')) return;

            const token = e.target.dataset.token;

            snap.pay(token, {
                onSuccess: function () {
                    location.reload();
                },
                onPending: function () {
                    location.reload();
                },
                onError: function (result) {
                    alert(result.status_message);
                }
            });
        });
    </script>
</x-app-layout>
