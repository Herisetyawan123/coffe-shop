@extends('admin.layouts.app')
@section('page')
    Transactions Report
@endsection
@section('content')
    <div class="panel" style="max-width: 1000px;">
        @if (session('success'))
            <div class="flex items-center p-3.5 rounded text-success bg-success-light dark:bg-success-dark-light mb-5">
                <span class="ltr:pr-2 rtl:pl-2"><strong
                        class="ltr:mr-1 rtl:ml-1">Success!</strong>{{ session('success') }}</span>
            </div>
        @elseif (session('error'))
            <div class="flex items-center p-3.5 rounded text-danger bg-danger-light dark:bg-danger-dark-light mb-5">
                <span class="ltr:pr-2 rtl:pl-2"><strong class="ltr:mr-1 rtl:ml-1">Error!</strong>{{ session('error') }}</span>
            </div>
        @endif

        <h2 class="text-lg font-semibold mb-4">Transaction Report</h2>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th class="w-10">No.</th>
                        <th>Product Name</th>
                        <th>Buyer Name</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                        <tr>
                            <td>{{ ($transactions->currentPage() - 1) * $transactions->perPage() + $loop->iteration }}</td>
                            <td class="whitespace-nowrap">{{ $transaction->product_name }}</td>
                            <td>{{ $transaction->buyer_name }}</td>
                            <td>{{ $transaction->quantity }}</td>
                            <td>{{ number_format($transaction->total, 2) }}</td>
                            <td>{{ $transaction->created_at->format('d M Y, H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-5">
                {{ $transactions->onEachSide(1)->links() }}
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endsection
