// 編集ボタンとモーダル
document.querySelectorAll(".edit-open-modal").forEach((btn) => {
    btn.addEventListener("click", function () {
        const messageId = btn.dataset.messageId;
        const messageText = btn.dataset.message;
        const modal = document.getElementById("myEditModal");
        modal.style.display = "block";
        modal.querySelector('input[name="id"]').value = messageId;
        modal.querySelector('textarea[name="message"]').value = messageText;
    });
});

// 閉じるボタン
document.getElementById("closeEditModal").addEventListener("click", function () {
    document.getElementById("myEditModal").style.display = "none";
});

// 削除ボタンとモーダル
document.querySelectorAll(".delete-open-modal").forEach((btn) => {
    btn.addEventListener("click", function () {
        const messageId = btn.dataset.messageId;
        const messageText = btn.dataset.message;
        const modal = document.getElementById("myDeleteModal");
        modal.style.display = "block";
        modal.querySelector('input[name="id"]').value = messageId;
        modal.querySelector('textarea[name="message"]').value = messageText;
    });
});

// 閉じるボタン
document.getElementById("closeDeleteModal").addEventListener("click", function () {
    document.getElementById("myDeleteModal").style.display = "none";
});
