<div class="modal fade" id="history<?php echo $row['device_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="historyLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title head-info" id="historyLabel">ประวัติการซ่อม <?php echo $i; ?></h1>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $device_id = $row['device_id'];
                $sql_history = "SELECT *,
                DATE_ADD(history.history_date, INTERVAL 543 YEAR) AS history_date
                FROM history WHERE device_broken_id = '$device_id'";
                $result_history = mysqli_query($conn, $sql_history);
                if (mysqli_num_rows($result_history) > 0) {
                    while ($history_row = mysqli_fetch_assoc($result_history)) {
                        ?>
                        <h3 class="head-info">หัวข้อ : <?php echo $history_row['title'] ?></h3>
                        <h6>คำอธิบาย : <?php echo $history_row['des'] ?></h6>
                        <p class="head-info"><i class="fa-solid fa-calendar-days"></i> <?php echo $history_row['history_date']?></p>
                        <hr>
                    <?php
                    }
                } else {
                    echo "<p>ไม่มีประวัติการซ่อม</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
