//メッセージの編集
var editModal = document.getElementById("myEditModal"); //モーダルの要素を取得
var editBtn = document.getElementById("openEditModal"); //開くボタンの要素を取得
var editSpan = document.getElementById("closeEditModal"); //閉じる要素を取得

editBtn.onclick = function () {
    editModal.style.display = "block";//モーダルのdisplayスタイルをblockにして表示
}
editSpan.onclick = function () {
    editModal.style.display = "none"; //モーダルのdisplayスタイルをnoneにして非表示
}

//メッセージの削除
var deleteModal = document.getElementById("myDeleteModal"); //モーダルの要素を取得
var deleteBtn = document.getElementById("openDeleteModal"); //開くボタンの要素を取得
var deleteSpan = document.getElementById("closeDeleteModal"); //閉じる要素を取得

deleteBtn.onclick = function () {
    deleteModal.style.display = "block";//モーダルのdisplayスタイルをblockにして表示
}
deleteSpan.onclick = function () {
    deleteModal.style.display = "none"; //モーダルのdisplayスタイルをnoneにして非表示
}
