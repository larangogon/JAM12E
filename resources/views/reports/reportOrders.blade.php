<table class="table table-hover table-bordered">
    <thead>
    <tr class="table-primary">
        <th scope="col">
            ID
        </th>
        <th scope="col">
            Nombre usuario
        </th>
        <th scope="col">
            Estado
        </th>
        <th scope="col">
            Total
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($order as $order)
        <tr>
            <td>
                {{$order->id}}
            </td>
            <td>
                {{$order->user->name}}
            </td>
            <td>
                {{$order->status}}
            </td>
            <td>
                {{number_format($order->total)}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<table class="table table-hover table-bordered">
    <thead>
    <tr class="table-primary">
        <th scope="col">
            ID
        </th>
        <th scope="col">
            id producto
        </th>
        <th scope="col">
            id color
        </th>
        <th scope="col">
            Total
        </th>
        <th scope="col">
            order id
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->details as $orderD)
        <tr>
            <td>
                {{$orderD->id}}
            </td>
            <td>
                {{$orderD->product_id}}
            </td>
            <td>
                {{$orderD->color_id}}
            </td>
            <td>
                {{number_format($orderD->total)}}
            </td>
            <td>
                {{$orderD->order_id}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>



