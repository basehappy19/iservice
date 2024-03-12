<script>
    $("#floor_form").hide();
    $("#building_id").on("change", function() {
        var buildingId = $(this).val();
        if (buildingId) {
            fetchFloors(buildingId);
        } else {
            $("#floor_form").hide();
            $("#floor_id").empty().hide();
        }
    });

    function fetchFloors(buildingId) {
        $.ajax({
            url: "helper/API/building_floor/get_data.php",
            type: "POST",
            data: {
                buildingId: buildingId
            },
            success: function(data) {
                if (data.length > 0) {
                    updateFloorDropdown(data);
                    $("#floor_form").show();
                    $("#floor_id").show();
                } else {
                    $("#floor_form").hide();
                    $("#floor_id").empty().append('<option value="19" selected>-- ไม่มีชั้น --</option>').show();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching floors:", textStatus, errorThrown);
            },
        });
    }

    function updateFloorDropdown(floors) {
        $("#floor_id").empty();
        $("#floor_id").append('<option value="">-- ชั้น --</option>');

        $.each(floors, function(index, floor) {
            var option = $("<option>").val(floor.floor_id).text(floor.floor_name);
            $("#floor_id").append(option);
        });
    }
</script>