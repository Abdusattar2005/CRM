<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Feedback Widget</title>
    <style>
        body{font-family:Arial,Helvetica,sans-serif;padding:12px}
        .widget{max-width:480px;border:1px solid #e5e7eb;padding:16px;border-radius:8px;background:#fff}
        label{display:block;margin-top:8px}
        input,textarea{width:100%;padding:8px;margin-top:4px}
        .btn{margin-top:12px;padding:10px 14px;border:none;background:#2563eb;color:#fff;border-radius:6px}
        .error{color:#dc2626}
    </style>
</head>
<body>
<div class="widget">
    <h3>Связаться с нами</h3>
    <form id="widgetForm">
        <label>Имя <input name="name" required></label>
        <label>Телефон <input name="phone" placeholder="+996700000000" required></label>
        <label>Email <input name="email" type="email"></label>
        <label>Тема <input name="subject" required></label>
        <label>Сообщение <textarea name="body" rows="4" required></textarea></label>
        <label>Файлы <input name="files[]" type="file" multiple></label>
        <button class="btn" type="submit">Отправить</button>
        <div id="message"></div>
    </form>
</div>
<script>
const form = document.getElementById('widgetForm');
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const data = new FormData(form);
    const message = document.getElementById('message');
    message.textContent = '';
    try {
        const res = await fetch('/api/tickets', { method: 'POST', body: data });
        const json = await res.json();
        if (!res.ok) {
            if (json.errors) {
                message.innerHTML = '<div class="error">' + Object.values(json.errors).flat().join('<br>') + '</div>';
            } else {
                message.innerHTML = '<div class="error">Ошибка отправки</div>';
            }
        } else {
            message.innerHTML = '<div style="color:green">Спасибо! Ваша заявка принята.</div>';
            form.reset();
        }
    } catch (err) {
        message.innerHTML = '<div class="error">Ошибка сети</div>';
    }
});
</script>
</body>
</html>
