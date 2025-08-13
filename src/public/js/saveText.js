document.addEventListener("DOMContentLoaded", () => {
    const textarea = document.querySelector(".message-box");
    if (!textarea) return;

    // ページ側の HTML に data-item-id を埋め込んでおく
    const itemId = textarea.dataset.itemId; 
    if (!itemId) {
        console.warn("itemId が取得できませんでした。data-item-id 属性を確認してください。");
        return;
    }

    const STORAGE_KEY = "chat_draft_message_" + itemId;

    // 保存していた内容を復元
    const saved = localStorage.getItem(STORAGE_KEY);
    if (saved) {
        textarea.value = saved;
    }

    // 入力のたびに保存
    textarea.addEventListener("input", () => {
        localStorage.setItem(STORAGE_KEY, textarea.value);
    });

    // 送信したら保存内容を削除
    const form = textarea.closest("form");
    if (form) {
        form.addEventListener("submit", () => {
            localStorage.removeItem(STORAGE_KEY);
        });
    }
});
