var modal = document.getElementById("myModal"); //モーダルの要素を取得
var btn = document.getElementById("openModal"); //開くボタンの要素を取得
var span = document.getElementById("closeModal"); //閉じる要素を取得

btn.onclick = function () {
    modal.style.display = "block";//モーダルのdisplayスタイルをblockにして表示
}
span.onclick = function () {
    modal.style.display = "none"; //モーダルのdisplayスタイルをnoneにして非表示
}
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none"; //モーダルのdisplayスタイルをnoneにして非表示
    }
}