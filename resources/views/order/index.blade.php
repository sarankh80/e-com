<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="text-xl font-bold text-gray-900">Orders</h2>
            <a href="{{ route('orders.create') }}" class="bg-gray-900 hover:bg-black text-white px-4 py-2 rounded-lg text-sm font-semibold transition-colors">
                + Add Order
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg text-sm">{{ session('success') }}</div>
            @endif

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm">
                    <table id="products-table" data-dt class="admin-table">
                        <thead>
                            <tr>
                                <th>Order Number</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                   <td>{{ $order->order_number }}</td>
                                   <td>{{ $order->customer_name }}</td>
                                   <td>${{ number_format($order->total_amount, 2) }}</td>
                                   <td>{{ $order->status }}</td>
                                   <td>
                                       <a href="" class="text-blue-500 hover:text-blue-700">View</a>
                                   </td>
                                </tr>
                            @empty
                                <tr>                    
                                    <td colspan="5" class="text-center text-gray-500 py-4">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
