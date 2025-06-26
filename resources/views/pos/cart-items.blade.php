@if(empty($cart))
    <p>Your cart is empty</p>
@else
    @php $total = 0; @endphp
    @foreach($cart as $item)
        @php 
            $subtotal = $item['price'] * $item['quantity'];
            $total += $subtotal;
        @endphp
        <div class="cart-item" data-id="{{ $item['id'] }}">
            <div class="row">
                <div class="col-xs-6">
                    <h4>{{ $item['name'] }}</h4>
                    <p>{{ $item['code'] }}</p>
                </div>
                <div class="col-xs-3">
                    <input type="number" class="form-control input-sm quantity" 
                           value="{{ $item['quantity'] }}" min="1">
                </div>
                <div class="col-xs-3 text-right">
                    <p>${{ number_format($subtotal, 2) }}</p>
                    <button class="btn btn-danger btn-xs btn-remove">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
            <hr>
        </div>
    @endforeach
    <div class="text-right">
        <h4>Total: ${{ number_format($total, 2) }}</h4>
    </div>
@endif