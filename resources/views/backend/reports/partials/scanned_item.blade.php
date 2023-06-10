<tr>
    <td>1</td>
    <td>
        {{ $order->code }}@if($order->viewed == 0) <span class="badge badge-inline badge-info">{{translate('New')}}</span>@endif
    </td>
    <td>
        @php $shipping_address = json_decode($order->shipping_address) @endphp
        <span>{{ $shipping_address->name }}</span>&nbsp;-&nbsp;<span>{{ $shipping_address->phone }}</span> <br>
    </td>
    <td>
        <span class="text-danger">{{ $order->additional_info }}</span>
    </td>
    <td>
        {{ intval($order->grand_total) }}
    </td>
    <td>
        {{ translate(ucfirst(str_replace('_', ' ', $order->delivery_status))) }}
    </td>
    <td>
        @if ($order->payment_status == 'paid')
        <span class="badge badge-inline badge-success">{{translate('Paid')}}</span>
        @else
        <span class="badge badge-inline badge-danger">{{translate('Unpaid')}}</span>
        @endif
    </td>
    <th class="d-print-none">
        <a href="#" class="btn btn-soft-danger btn-icon-xs btn-circle btn-xs" title="{{ translate('Remove') }}">
            <i class="las la-times"></i>
        </a>
    </th>
</tr>