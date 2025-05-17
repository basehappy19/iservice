<script>
    $("#department_form").hide();
    $("#work_group_id").on("change", function() {
        var workGroupId = $(this).val();
        if (workGroupId) {
            fetchDepartments(workGroupId);
        } else {
            $("#department_form").hide();
            $("#department_id").empty().hide();
        }
    });

    function fetchDepartments(workGroupId) {
        $.ajax({
            url: "helper/API/department/get_data.php",
            type: "POST",
            data: {
                workGroupId: workGroupId
            },
            success: function(data) {
                if (data.length > 0) {
                    updateDepartmentDropdown(data);
                    $("#department_form").show();
                    $("#department_id").show();
                } else {
                    $("#department_form").hide();
                    $("#department_id").empty().append('<option value="63" selected>-- ไม่มีแผนก --</option>').show();

                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching departments:", textStatus, errorThrown);
            },
        });
    }

    function updateDepartmentDropdown(departments) {
        $("#department_id").empty();
        $("#department_id").append('<option value="">-- เลือกแผนก --</option>');

        $.each(departments, function(index, department) {
            var option = $("<option>").val(department.department_id).text(department.department_name);
            $("#department_id").append(option);
        });
    }
</script>