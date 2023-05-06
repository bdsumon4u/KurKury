<tr>
    <td>{{ $si }}</td>
    <td>
        {{ $order->code }}@if($order->viewed == 0) <span class="badge badge-inline badge-info">{{translate('New')}}</span>@endif
    </td>
    <td>
        @php $shipping_address = json_decode($order->shipping_address) @endphp
        <span>{{ $shipping_address->name }}</span> <br>
        <span>{{ $shipping_address->phone }}</span> <br>
        <span class="text-danger">{{ $order->additional_info }}</span>
    </td>
    <td>
        {{ single_price($order->grand_total) }}
    </td>
    <td>
        {{ translate(ucfirst(str_replace('_', ' ', $order->delivery_status))) }}
    </td>
    <td>
        {{ translate(ucfirst(str_replace('_', ' ', $order->payment_type))) }}
    </td>
    <td>
        @if ($order->payment_status == 'paid')
        <span class="badge badge-inline badge-success">{{translate('Paid')}}</span>
        @else
        <span class="badge badge-inline badge-danger">{{translate('Unpaid')}}</span>
        @endif
    </td>
</tr>