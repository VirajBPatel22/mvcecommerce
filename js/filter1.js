$(document).ready(function() {
    function updateProducts() {
        var queryParams = [];
        
        // Build category filter: join checked category ids with commas.
        var categories = [];
        $("input[name='id[]']:checked").each(function() {
            console.log(this);
            categories.push($(this).val());
        });
        if (categories.length > 0) {
            queryParams.push("id=" + categories.join(","));
        }
        
        var colors = [];
        // Process color checkboxes (kept as array parameters)
        $("input[name='color[]']:checked").each(function() {
            console.log($(this).val());
            console.log(this);
            colors.push($(this).val());
        });
        if(colors.length > 0){
            queryParams.push("color="+colors.join(","));
        }
        var brands = [];
        
        // Process brand checkboxes (kept as array parameters)
        $("input[name='brand[]']:checked").each(function() {
            brands.push($(this).val());
        });
        if(brands.length > 0){
            queryParams.push("brand="+brands.join(','));

        }
        // Construct the query string.
        var queryString = queryParams.join("&");
        var newUrl = window.location.protocol + "//" + window.location.host + window.location.pathname + (queryString ? "/?" + queryString : "");
        
        // Update the browser's URL without reloading the page.
        history.pushState(null, "", newUrl);
        
        // AJAX request to fetch the filtered products.
        $.ajax({
            url: newUrl,
            type: "GET",
            success: function(response) {
                var newProductHtml = $(response).find("#product-container").html();
                $("#product-container").html(newProductHtml);
            },
            error: function() {
                alert("An error occurred while loading products. Please try again.");
            }
        });
    }

    // Trigger the updateProducts function when any of the filter checkboxes change.
    $("#filter-form").on("change", "input[name='id[]'], input[name='color[]'], input[name='brand[]']", function() {
        updateProducts();
    });

    // Handle "Select All" functionality for categories.
    $("#selectAll").on("change", function() {
        $(".category").prop("checked", $(this).prop("checked"));
        updateProducts();
    });
});
