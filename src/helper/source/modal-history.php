<div class="modal fade" id="history<?php echo $report['device_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="historyLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title head-info" id="historyLabel">ประวัติการซ่อม <?php echo $index + 1; ?></h1>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                $device_id = $report['device_id'];
                $sql_history = "SELECT *,
                DATE_ADD(history.history_date, INTERVAL 543 YEAR) AS history_date
                FROM history WHERE device_broken_id = '$device_id'";
                $stmt = $conn->prepare($sql_history);
                $stmt->execute();
                $histories = $stmt->fetchAll();
                if (!empty($histories)) : foreach ($histories as $history) : ?>
                        <h3 class="head-info">หัวข้อ : <?php echo $history['history_title'] ?></h3>
                        <h6>คำอธิบาย : <?php echo $history['history_des'] ?></h6>
                        <p class="head-info"><i class="fa-solid fa-calendar-days"></i> <?php echo $history['history_date']?></p>
                        <hr>
                    <?php endforeach; ?>
                <?php else: 
                    echo "<p>ไม่มีประวัติการซ่อม</p>";
                endif; ?>
            </div>
        </div>
    </div>
</div>
