<script>
    const importFile = document.getElementById("importFile");
    const importForm = document.getElementById("importForm");

    importFile.addEventListener("change", () => {
        if (importFile.files.length > 0) {
            importForm.submit();
        }
    });
</script>