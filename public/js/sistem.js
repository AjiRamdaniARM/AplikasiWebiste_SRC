// === modal content === //
document.addEventListener('DOMContentLoaded', function () {
    const modalHideButtons = document.querySelectorAll('[data-modal-hide="authentication-modal"]');

    modalHideButtons.forEach(button => {
        button.addEventListener('click', function () {
            const modal = document.getElementById('authentication-modal');
            modal.classList.add('hidden');
        });
    });
});

    // === download file projeck === //
    function downloadFile(filename) {
        const url = `../upload/${filename}`;
        const a = document.createElement('a');
        a.href = url;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    }

