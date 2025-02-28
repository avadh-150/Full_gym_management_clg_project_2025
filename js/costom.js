$(document).ready(function () {

    // Increment quantity
            $(document).on('click', '.increase-btn', function (e) {
            e.preventDefault();
    
            
            var qty = $(this).closest('.product-content').find('.quantity-input').val();
            var value = parseInt(qty, 10);
            value = isNaN(value) ? 0 : value;
    
            if (value < 10) {
                value++;
                $(this).closest('.product-content').find('.quantity-input').val(value);
            }
    
        });
    
        // Decrement quantity
       
            $(document).on('click', '.decrease-btn', function (e) {
            e.preventDefault();
    
            var qty = $(this).closest('.product-content').find('.quantity-input').val();
            var value = parseInt(qty, 10);
            value = isNaN(value) ? 0 : value;
    
            if (value > 1) {
                value--;
                $(this).closest('.product-content').find('.quantity-input').val(value);
            }
        }); 
    
    
    // Add to cart
    $(document).on('click', '.addTocart', function (e) {
        e.preventDefault();

        var qty = $(this).closest('.product-content').find('.quantity-input').val();
        var pro_id = $(this).val();

        $.ajax({
            url: "include/handlecart.php", // Adjust the path if necessary
            method: "POST",
            data: {
                "pro_id": pro_id,
                "pro_qty": qty,
                "scope": "add"
            },
            success: function (response) {
                alertify.success(response);               
            },
            
            
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert("An error occurred. Please try again.");
            }
        });
    });
    $(document).on('click', ".deleteItems",function (e) {
        e.preventDefault();
        var cid=$(this).val();

        $.ajax({
            url: "include/handlecart.php", // Adjust the path if necessary
            method: "POST",
            data: {
                "cid": cid,
                "scope": "delete"
            },
            success: function (data) {
                // $("#massge").html(data);
                alertify.success(data);
                $("#body").load(location.href + " #body");               
            },           
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert("An error occurred. Please try again.");
            }
        });
    });
    $(document).on('click', ".updateQty",function (e) {
        e.preventDefault();
        var qty = $(this).closest('.product-content').find('.quantity-input').val();
        
        var pro_id = $(this).closest('.product-content').find('.product_id').val();
        
        

        $.ajax({
            url: "include/handlecart.php", // Adjust the path if necessary
            method: "POST",
            data: {
                "pro_id": pro_id,
                "pro_qty": qty,
                "scope": "update"
            },
            success: function (data) {
                // $("#massge").html(data);
                alertify.success(data);
                $("#body").load(location.href + " #body");               
            },           
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                alert("An error occurred. Please try again.");
            }
        });
    });
});
