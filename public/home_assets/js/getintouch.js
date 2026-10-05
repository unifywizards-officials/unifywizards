document.addEventListener("DOMContentLoaded", function () {

    const form = document.getElementById("contact-form-2");

    if (!form) {
        return;
    }

    form.addEventListener("submit", function (e) {

        e.preventDefault();

        const submitBtn = document.getElementById("contactSubmitBtn");
        submitBtn.disabled = true;

        const formData = new FormData(form);

        fetch(form.action, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": form.querySelector('input[name="_token"]').value,
                "Accept": "application/json"
            },
            body: formData
        })
        .then(async response => {

            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;
        })
        .then(data => {

            Swal.fire({
                icon: "success",
                title: "Success",
                text: data.message
            });

            form.reset();

        })
        .catch(error => {

            Swal.fire({
                icon: "error",
                title: "Error",
                text: error.message || "Something went wrong."
            });

        })
        .finally(() => {

            submitBtn.disabled = false;

        });

    });

});