function previewFile() {
    var preview = document.querySelector('#preview');
    var file = document.querySelector('input[type=file]').files[0];
    var reader = new FileReader();

    reader.onloadend = function() {
        if (file.type.includes('image')) {
            var img = document.createElement('img');
            img.src = reader.result;
            img.classList.add('img-fluid');
            preview.innerHTML = '';
            preview.appendChild(img);
        } else if (file.type.includes('video')) {
            var video = document.createElement('video');
            video.src = reader.result;
            video.controls = true;
            video.classList.add('img-fluid');
            preview.innerHTML = '';
            preview.appendChild(video);
        } else {
            preview.innerHTML = 'ไม่สามารถแสดงตัวอย่างไฟล์นี้ได้';
        }
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = '';
    }
}
