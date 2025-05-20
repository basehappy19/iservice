<div class="modal fade" id="exampleModal<?php echo $report['device_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">รูป/วิดีโอประกอบการแจ้งซ่อม</h5>
                <button type="button" class="btn" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fa-solid fa-x"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <?php
                if (!isset($report['device_id'])) {
                    echo "<p>ไม่มีข้อมูลที่ระบุ</p>";
                    return;
                }

                $sql = "SELECT * FROM file_report WHERE b_id = :b_id";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':b_id', $report['device_id'], PDO::PARAM_INT);
                $stmt->execute();
                $files = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if (empty($files)) {
                    echo "<p>ไม่มีข้อมูลที่ระบุ</p>";
                }

                foreach ($files as $index => $file) {
                    switch ($file['file_type']) {
                        case 'image':
                            echo "<div class='file-item' id='file-{$index}'>";
                            echo "<img src='/helper/data/report/{$report['device_id']}/{$file['path']}' class='img-fluid mx-auto d-block'>";
                            echo "</div><hr>";
                            break;

                        case 'video':
                            $file_extension = pathinfo($file['path'], PATHINFO_EXTENSION);
                            if (in_array($file_extension, ['mp4', 'avi', 'mov'])) {
                                echo "<div class='file-item' id='file-{$index}'>";
                                echo "<video controls class='mx-auto d-block'>";
                                echo "<source src='./helper/data/report/{$report['device_id']}/{$file['path']}' type='video/{$file_extension}'>";
                                echo "</video>";
                                echo "</div><hr>";
                            }
                            break;
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>