<table class="responsive-table centered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Total</th>
            <th>Address ID</th>
            <th>Address Line</th>
            <th>Postal Code</th>
            <th>City</th>
            <th>Transaction ID</th>
            <th>Status</th>
            <th>Customer ID</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
    </thead>
    <tbody>
        @forelse($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->total}}</td>
                <td>{{$order->address_id}}</td>
                <td>{{$order->address->address_1}}</td>
                <td>{{$order->address->postal_code}}</td>
                <td>{{$order->address->city}}</td>
                <td>{{$order->payment->transaction_id}}</td>
                <td>{{($order->paid) ? 'Paid' : 'Failed'}}</td>
                <td>{{$order->user_id}}</td>
                <td>{{$order->created_at->diffForHumans()}}</td>
                <td>{{$order->updated_at->diffForHumans()}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="7">
                    <h6 class="center">No Orders Found!</h6>
                </td>
            </tr>
        @endforelse
    </tbody>
</table>
<br>
<div class="center-align">
    {{$orders->appends(request()->query())->links('vendor.pagination.default',['item' => $orders])}}
</div>