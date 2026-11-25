// JavaScript riêng cho khu vực sinh viên.
document.addEventListener('DOMContentLoaded', () => {
    const themeButton = document.querySelector('[data-theme-toggle]');
    const root = document.documentElement;

    themeButton?.addEventListener('click', () => {
        const currentTheme = root.dataset.theme || 'light';
        root.dataset.theme = currentTheme === 'dark' ? 'light' : 'dark';
    });

    document.querySelectorAll('[data-confirm]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            const message = form.dataset.confirm || 'Bạn có chắc chắn muốn tiếp tục?';
            if (!window.confirm(message)) event.preventDefault();
        });
    });
});
