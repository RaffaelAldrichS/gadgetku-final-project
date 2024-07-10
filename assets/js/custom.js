$(document).ready(function () {
  // Increment button
  $('.increment_btn').click(function (e) {
    e.preventDefault();

    const qty = $(this).closest('.product_data').find('.input_qty').val();
    let value = parseInt(qty, 10);
    value = isNaN(value) ? 0 : value;

    if (value < 10) {
      value++;
      $(this).closest('.product_data').find('.input_qty').val(value);
    }
  });

  //   Decrement button
  $('.decrement_btn').click(function (e) {
    e.preventDefault();

    const qty = $(this).closest('.product_data').find('.input_qty').val();
    let value = parseInt(qty, 10);
    value = isNaN(value) ? 0 : value;

    if (value > 1) {
      value--;
      $(this).closest('.product_data').find('.input_qty').val(value);
    }
  });

  //   Add to cart
  $('.add_to_cart').click(function (e) {
    e.preventDefault();

    const qty = $(this).closest('.product_data').find('.input_qty').val();
    const prodId = $(this).val();

    $.ajax({
      method: 'post',
      url: './functions/handlecart.php',
      data: {
        prod_id: prodId,
        prod_qty: qty,
        scope: 'add',
      },
      success: function (response) {
        if (response == 201) {
          alertify.success('Product added to cart');
        } else if (response == 202) {
          alertify.success('Product quantity updated in cart');
        } else if (response == 401) {
          alertify.success('Login to continue');
        } else if (response == 500) {
          alertify.success('Something went wrong');
        }
      },
    });
  });

  // Update qty from cart
  $(document).on('click', '.update_qty', function () {
    const qty = $(this).closest('.product_data').find('.input_qty').val();
    const prodId = $(this).closest('.product_data').find('.prod_id_value').val();

    $.ajax({
      method: 'post',
      url: './functions/handlecart.php',
      data: {
        prod_id: prodId,
        prod_qty: qty,
        scope: 'update',
      },
      success: function (response) {
        // if (response == 202) {
        //   alertify.success('Product quantity updated');
        // } else if (response == 500) {
        //   alertify.success('Something went wrong');
        // }
      },
    });
  });

  // Delete from cart
  $(document).on('click', '.delete_cart_btn', function () {
    const cart_id = $(this).val();

    $.ajax({
      method: 'post',
      url: './functions/handlecart.php',
      data: {
        cart_id: cart_id,
        scope: 'delete',
      },
      success: function (response) {
        if (response == 200) {
          alertify.success('Item deleted successfully');
          $('#myCart').load(location.href + ' #myCart');
        } else {
          alertify.success(response);
        }
      },
    });
  });
});
