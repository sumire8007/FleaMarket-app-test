const uploader = document.getElementById("imageUploader");
const preview = document.getElementById("previewImage");

uploader.addEventListener("change",(event) => {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = () => {
            preview.src = reader.result;
        };
        reader.readAsDataURL(file);
    }
})