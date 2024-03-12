<div class="modal fade" id="exampleModal<?php echo $row['device_id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                $rel = $row['rel'];
                $sql_media = "SELECT * FROM media_broken WHERE rel = '$rel'";
                $result_media = mysqli_query($conn, $sql_media);
                if (mysqli_num_rows($result_media) > 0) {
                    while ($media_row = mysqli_fetch_assoc($result_media)) {
                        $file_extension = pathinfo($media_row['path'], PATHINFO_EXTENSION);
                        if (in_array($file_extension, array('jpg', 'jpeg', 'png', 'gif'))) {
                            echo "<img src='helper/data/report/{$media_row['path']}' class='img-fluid mx-auto d-block'>";
                            echo "<hr>";
                        } elseif (in_array($file_extension, array('mp4', 'avi', 'mov'))) {
                            echo "<video controls class='mx-auto d-block'><source src='helper/data/report/{$media_row['path']}' type='video/{$file_extension}'></video>";
                        }
                    }
                } else {
                    echo "<p>ไม่มีรูปภาพหรือวิดีโอที่แนบมา</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
