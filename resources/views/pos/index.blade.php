@extends('template.admin')

@section('content')
<div class="row">
    <!-- Product Search and List -->
    <div class="col-md-8">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Products</h3>
                <div class="box-tools">
                    <div class="input-group">
                        <input type="text" id="product-search" class="form-control" placeholder="Search products...">
                        <div class="input-group-btn">
                            <button class="btn btn-default" id="search-btn">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="row" id="product-list">
                    <!-- Products will be loaded here via AJAX -->
                </div>
            </div>
        </div>
    </div>

    <!-- Cart -->
    <div class="col-md-4">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Cart</h3>
            </div>
            <div class="box-body">
                <div id="cart-items">
                    @include('pos.cart-items', ['cart' => $cart])
                </div>
            </div>
            <div class="box-footer">
                <button class="btn btn-primary btn-block" data-toggle="modal" data-target="#checkout-modal">
                    Checkout
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Checkout Modal -->
<div class="modal fade" id="checkout-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Checkout</h4>
            </div>
            <form id="checkout-form" action="{{ route('pos.checkout') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Customer</label>
                        <select name="customer_id" class="form-control" required>
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Payment Method</label>
                        <select name="payment_method" class="form-control" required>
                            <option value="cash">Cash</option>
                            <option value="card">Credit Card</option>
                            <option value="transfer">Bank Transfer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Amount Paid</label>
                        <input type="number" name="amount_paid" class="form-control" step="0.01" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Complete Sale</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
$(document).ready(function() {
    // Search products
    function searchProducts(query) {
        $.get('{{ route("pos.search") }}', { search: query }, function(data) {
            let html = '';
            data.forEach(function(product) {
                // In the search results
                html += `
                    <div class="col-md-3 col-sm-6">
                        <div class="product-item">
                            <div class="product-info">
                                <h4>${product.name}</h4>
                                <p>${product.code}</p>
                                <p>${parseFloat(product.price).toFixed(2)}</p>
                                <button class="btn btn-primary btn-add-to-cart" 
                                        data-id="${product.id}">
                                    Add to Cart
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            });
            $('#product-list').html(html);
        });
    }

    // Initial load
    searchProducts('');

    // Search on input
    $('#product-search').on('input', function() {
        searchProducts($(this).val());
    });

    // Add to cart
    $(document).on('click', '.btn-add-to-cart', function() {
        const productId = $(this).data('id');
        
        $.post('{{ route("pos.addToCart") }}', {
            _token: '{{ csrf_token() }}',
            product_id: productId
        }, function(response) {
            updateCart(response);
        });
    });

    // Update cart
    function updateCart(cart) {
        let total = 0;
        let itemsHtml = '';
        
        $.each(cart, function(id, item) {
            const subtotal = item.price * item.quantity;
            total += subtotal;
            
            itemsHtml += `
                <div class="cart-item" data-id="${id}">
                    <div class="row">
                        <div class="col-xs-6">
                            <h4>${item.name}</h4>
                            <p>${item.code}</p>
                        </div>
                        <div class="col-xs-3">
                            <input type="number" class="form-control input-sm quantity" 
                                   value="${item.quantity}" min="1">
                        </div>
                        <div class="col-xs-3 text-right">
                            <p>$${subtotal.toFixed(2)}</p>
                            <button class="btn btn-danger btn-xs btn-remove">
                                <i class="fa fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <hr>
                </div>
            `;
        });

        $('#cart-items').html(`
            ${itemsHtml}
            <div class="text-right">
                <h4>Total: $${total.toFixed(2)}</h4>
            </div>
        `);

        // Update amount paid field
        $('input[name="amount_paid"]').val(total.toFixed(2));
    }

    // Update quantity
    $(document).on('change', '.quantity', function() {
        const itemId = $(this).closest('.cart-item').data('id');
        const quantity = $(this).val();
        
        $.post('{{ route("pos.updateCart") }}', {
            _token: '{{ csrf_token() }}',
            id: itemId,
            quantity: quantity
        }, function(response) {
            updateCart(response);
        });
    });

    // Remove item
    $(document).on('click', '.btn-remove', function() {
        const itemId = $(this).closest('.cart-item').data('id');
        
        $.post('{{ route("pos.removeFromCart") }}', {
            _token: '{{ csrf_token() }}',
            id: itemId
        }, function(response) {
            updateCart(response);
        });
    });
});
</script>

<style>
    .product-item {
        border: 1px solid #ddd;
        padding: 15px;
        margin-bottom: 15px;
        text-align: center;
        height: 200px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    .product-item h4 {
        margin-top: 0;
    }
    .cart-item {
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px solid #eee;
    }
    .quantity {
        width: 60px;
        text-align: center;
    }
</style>
@endpush