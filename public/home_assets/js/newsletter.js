document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('newsletterForm');
    if (!form) return;

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const btn = form.querySelector('button[type="submit"]');
        const formData = new FormData(form);
        const url = form.dataset.action; // Blade route ab yahan se milega

        if (!url) {
            Swal.fire({ icon: 'error', title: 'Oops...', text: 'Form action URL missing.' });
            return;
        }

        btn.disabled = true;

        try {
            const response = await fetch(url, {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            });

            const data = await response.json();

            if (!response.ok) {
                let errorMessage = data.errors
                    ? Object.values(data.errors)[0][0]
                    : (data.message || 'Something went wrong!');

                Swal.fire({ icon: 'error', title: 'Oops...', text: errorMessage });
                return;
            }

            if (data.status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Subscribed!',
                    text: data.message,
                    confirmButtonColor: '#3085d6',
                });
                form.reset();
            } else {
                Swal.fire({ icon: 'error', title: 'Oops...', text: data.message || 'Something went wrong!' });
            }

        } catch (error) {
            Swal.fire({ icon: 'error', title: 'Server Error', text: 'Please try again later.' });
        } finally {
            btn.disabled = false;
        }
    });
});