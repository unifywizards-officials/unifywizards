document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('.proposal-ajax-form');

    forms.forEach(function (form) {

        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const btn = form.querySelector('button[type="submit"]');
            const formData = new FormData(form);
            const url = form.dataset.action;
            const tokenInput = form.querySelector('input[name="_token"]');

            if (!url || !tokenInput) {
                alert('Form configuration error. Please refresh the page.');
                return;
            }

            const originalBtnHTML = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = 'Sending...';

            try {
                const response = await fetch(url, {
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': tokenInput.value,
                        'Accept': 'application/json'
                    },
                    body: formData
                });

                const data = await response.json();

                if (!response.ok) {
                    let errorMessage = data.errors
                        ? Object.values(data.errors)[0][0]
                        : (data.message || 'Something went wrong.');
                    alert(errorMessage);
                    return;
                }

                if (data.status) {
                    alert(data.message);
                    form.reset();
                } else {
                    alert(data.message || 'Something went wrong.');
                }

            } catch (error) {
                console.log(error);
                alert('Server Error. Please try again later.');
            } finally {
                btn.disabled = false;
                btn.innerHTML = originalBtnHTML;
            }
        });
    });
});
