function previewImage(event, targetId, fallbackImage) {
    const file = event.target.files[0];
    const target = document.getElementById(targetId);

    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            target.src = e.target.result;
        };
        reader.readAsDataURL(file);
    } else {
        target.src = fallbackImage;
    }
}
