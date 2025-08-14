document.addEventListener("DOMContentLoaded", () => {
    const textarea = document.querySelector(".message-box");
    if (!textarea) return;

    const itemId = textarea.dataset.itemId;

    // 下書き取得
    fetch(`/chat-draft/${itemId}`)
        .then(res => res.json())
        .then(data => {
            textarea.value = data.message || "";
        });

    // 入力のたびに保存（0.5秒遅延）
    let timer;
    textarea.addEventListener("input", () => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            fetch("/chat-draft/save", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    item_id: itemId,
                    message: textarea.value
                })
            });
        }, 500);
    });

    // 送信したら保存内容をNULLに更新
    const sendButton = document.querySelector("#sendButton");
    sendButton.addEventListener("click", () => {
            fetch ("/chat-draft/delete", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    item_id: itemId,
                })
            })
        .then(response => response.json())
        .then(data => {
        if (data.status === 'OK') {
            textarea.value = ""; // 入力欄を空にする
        }
    });
    });
});
