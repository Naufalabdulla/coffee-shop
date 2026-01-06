<x-layout>
    <div class="container my-5">
    <!-- Title -->
    <h3 class="fw-semibold mb-4 text-dark">My Transactions</h3>

    <!-- Card -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">

            <table class="table align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3">Order ID</th>
                        <th class="px-4 py-3">Total</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3 text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr class="transaction-row">
                            <td class="px-4 py-3 fw-medium">
                                {{ $transaction->order_id }}
                            </td>

                            <td class="px-4 py-3">
                                Rp {{ number_format($transaction->total, 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3">
                                <span class="badge rounded-pill px-3 py-2
                                    {{ $transaction->status === 'paid'
                                        ? 'bg-success-subtle text-success'
                                        : 'bg-warning-subtle text-warning' }}">
                                    {{ strtoupper($transaction->status) }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-center">
                                @if ($transaction->status === 'pending' && $transaction->snaptoken)
                                    <button
                                        type="button"
                                        class="pay-btn btn btn-primary btn-sm px-4 rounded-pill"
                                        data-token="{{ $transaction->snaptoken }}">
                                        <i class="bi bi-credit-card"></i> Pay Now
                                    </button>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                
            </table>

        </div>
    </div>
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
</x-layout>
