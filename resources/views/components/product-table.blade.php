
<table  class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Edit</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price (USD)</th>
                <th>Created</th>
                <th>Total Val.</th>
            </tr>
        </thead>
        <tbody>
            @if(isset($products))
            @foreach($products as $product)
                <tr row_id="{{$product['product_name']}}" tabindex='0'>
                    <td>
                        <button class="edit-btn btn btn-primary">Edit</button>
                    </td>
                    <td class="editable" col_id="product_name" >{{$product["product_name"]}}</td>
                    <td class="editable" col_id="product_quantity" >{{$product["product_quantity"]}}</td>
                    <td class="editable" col_id="product_price" >{{$product["product_price"]}}</td>
                    <td>{{$product["created_at"]}}</td>
                    <td class="total-value">{{$product["product_quantity"] * $product["product_price"]}}</td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>