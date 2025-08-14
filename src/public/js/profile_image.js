document.addEventListener("DOMContentLoaded", function () {
    const uploader = document.getElementById("imageUploader");
    const previewImage = document.getElementById("previewImage");

    // 初期状態では非表示
    previewImage.style.display = "none";

    uploader.addEventListener("change", function () {
        if (uploader.files && uploader.files.length > 0) {
            // 選択された画像をプレビュー表示
            const file = uploader.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewImage.style.display = "block";
            };

            reader.readAsDataURL(file);
        } else {
            // ファイルが選択されていないときは非表示
            previewImage.src = "";
            previewImage.style.display = "none";
        }
    });
});

