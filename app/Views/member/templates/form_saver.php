<script>
    function saveFormDataToLocalStorage() {
        const form = document.getElementById(formSaverID);

        const formData = new FormData(form);

        // Convert form data to an object
        const formDataObject = {};
        formData.forEach((value, key) => {
            formDataObject[key] = value;
        });

        const formDataJSON = JSON.stringify(formDataObject);
        localStorage.setItem(formSaverLocalStorageName, formDataJSON);
        const timestamp = new Date().toLocaleString();
        document.getElementById("last_saved").textContent = timestamp;
    }

    setInterval(saveFormDataToLocalStorage, 5000);

    // Load any saved data from local storage on page load
    window.addEventListener("load", function() {
        const formDataJSON = localStorage.getItem(formSaverLocalStorageName);

        if (formDataJSON) {
            const formDataObject = JSON.parse(formDataJSON);

            const form = document.getElementById(formSaverID);
            for (const key in formDataObject) {
                if (formDataObject.hasOwnProperty(key)) {
                    const input = form.querySelector(`[name="${key}"]`);
                    if (input.type === 'radio') {
                        const radio = form.querySelector(`[name="${key}"][value="${formDataObject[key]}"]`);

                        if (radio) {
                            radio.checked = true;
                        }
                    } else {
                        input.value = formDataObject[key];
                    }
                }
            }
        }
    });

    document.getElementById("clearData").addEventListener("click", function() {
        localStorage.removeItem(formSaverLocalStorageName);
        document.getElementById(formSaverID).reset();
    });
</script>