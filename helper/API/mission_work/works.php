<script>
    $("#work_group_form").hide();
    $("#mission_group_id").on("change", function() {
        var missionGroupId = $(this).val();
        if (missionGroupId) {
            fetchWorkGroups(missionGroupId);
        } else {
            $("#work_group_form").hide();
            $("#work_group_id").empty().hide();

        }
    });

    function fetchWorkGroups(missionGroupId) {
        $.ajax({
            url: "helper/API/mission_work/get_data.php",
            type: "POST",
            data: {
                missionGroupId: missionGroupId
            },
            success: function(data) {
                if (data.length > 0) {
                    updateWorkGroupDropdown(data);
                    $("#work_group_form").show();
                    $("#work_group_id").show();
                } else {
                    $("#work_group_form").hide();
                    $("#work_group_id").empty().hide();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching work groups:", textStatus, errorThrown);
            },
        });
    }

    function updateWorkGroupDropdown(workGroups) {
        $("#work_group_id").empty();
        $("#work_group_id").append('<option value="">-- เลือกกลุ่มงาน --</option>');

        $.each(workGroups, function(index, workGroup) {
            var option = $("<option>").val(workGroup.work_group_id).text(workGroup.work_group_name);
            $("#work_group_id").append(option);
        });
    }

    
</script>
