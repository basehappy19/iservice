<script>
    $("#category_id").on("change", function() {
        var categoryId = $(this).val();
        if (categoryId) {
            fetchtypes(categoryId);
        } else {
            $("#type_form").hide();
            $("#type_id").empty().hide();
        }
    });

    function fetchtypes(categoryId) {
        $.ajax({
            url: "helper/API/category/get_data.php",
            type: "POST",
            data: {
                categoryId: categoryId
            },
            success: function(data) {
                if (data.length > 0) {
                    updatetypeDropdown(data);
                    $("#type_form").show();
                    $("#type_id").show();
                } else {
                    $("#type_form").hide();
                    $("#type_id").empty().hide();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching types:", textStatus, errorThrown);
            },
        });
    }

    function updatetypeDropdown(types) {
        $("#type_id").empty();
        $("#type_id").append('<option value="">-- เลือกประเภท --</option>');

        $.each(types, function(index, type) {
            var option = $("<option>").val(type.type_id).text(type.type_name);
            $("#type_id").append(option);
        });
    }
</script>