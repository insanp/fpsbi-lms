<div class="row text-gray-900">
    <div class="col">
        <div id="game-matching-widget">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary py-3 text-center">
                    <h2 class="m-0 font-weight-bold text-white">Task</h2>
                </div>
                <div class="card-body">
                    <div id="welcome_screen">
                        <p>Anda diberikan user dan password khusus untuk masuk ke dalam tools perhitungan Financial Health Scale. Cobalah latihan menggunakan tool tersebut kepada seseorang. Klik tombol di bawah atau navigasi ke Tools->Health Scale pada sidebar.</p>
                        <p class="text-center"><a href="<?= base_url('member/health-scale') ?>" class="btn btn-success">Klik untuk ke Financial Health Scale</a></p>
                        <p>Tes ini mengeksplorasi pemahaman Anda tentang penggunaan tools Financial Health Scale yang digunakan untuk menilai cepat kesehatan finansial klien. Untuk menyelesaikan tugas ini, silakan mencoba untuk menyimpan data hasil dari perhitungan dan upload file .afci ke kolom di bawah ini:</p>
                        <br />
                        <form method="post" id="importForm" action="<?= base_url('member/import') ?>" class="text-center" enctype="multipart/form-data">
                            <label class="btn btn-info btn-icon-split file">
                                <input name="importFile" type="file" accept=".afci" id="importFile" />
                                <input name="redirectUrl" type="hidden" value="<?= current_url() ?>" />
                                <input name="toolKey" type="hidden" value="Financial Health Scale" />
                                <span>Cek File .afci yang dibuat</span>
                            </label>
                            <div class="alert alert-danger mt-4" role="alert" id="assignment_error" style="display:none;">
                            </div>
                        </form>
                        <p>Apabila terdapat kendala terkait sistem, silahkan menghubungi info@financialcoachacademy.asia.</p>
                    </div>
                    <div id="finish_screen" style="display:none;" class="alert alert-success mt-4 text-center">
                        <i class="fas fa-check" style="font-size: xxx-large; color: green;"></i><br /><br />
                        File yang diunggah merupakan file .afci tools Financial Health Scale yang valid.<br />Anda telah menyelesaikan tugas ini.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const importFile = document.getElementById("importFile");

    importFile.addEventListener("change", async () => {
        if (importFile.files.length > 0) {
            const formData = new FormData();
            formData.append("importFile", importFile.files[0]);
            formData.append("redirectUrl", document.querySelector("input[name='redirectUrl']").value);
            formData.append("toolKey", document.querySelector("input[name='toolKey']").value);

            var errorObj = document.getElementById('assignment_error');

            try {
                const response = await fetch("<?= base_url('member/api/check-file-ajax') ?>", {
                    method: "POST",
                    body: formData
                });

                if (response.ok) {
                    const result = await response.json();
                    console.log("File uploaded successfully:", result);

                    if (result.success != null) {
                        document.getElementById('welcome_screen').style.display = 'none';
                        document.getElementById('finish_screen').style.display = 'block';
                        completeAssignment();
                    } else {
                        errorObj.innerHTML = result.error;
                        errorObj.style.display = 'block';
                    }
                } else {
                    console.error("Upload failed:", response.statusText);
                    errorObj.innerHTML = 'Gagal upload.';
                    errorObj.style.display = 'block';
                }
            } catch (error) {
                console.error("An error occurred:", error);
                errorObj.innerHTML = 'Gagal upload. '.error;
                errorObj.style.display = 'block';
                // Handle error, e.g., display a network error message.
            }
        }
    })

    function startAssignment() {
        const taskId = <?= $task_id_assignment ?>;

        // Initiate a task attempt on the server
        fetch('<?= base_url('/member/api/task/create-attempt') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    task_id: taskId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log(data.message);
                } else {
                    console.error('Failed to create task attempt.');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    function completeAssignment() {
        fetch('<?= base_url('/member/api/task/complete-assignment') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    task_id: <?= $task_id_assignment ?>,
                    topic_id: <?= $topic_id ?>
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Task attempt marked as completed.');
                } else {
                    console.error('Failed to mark task attempt as completed.');
                }
            })
            .catch(error => console.error('Error:', error));
    };

    startAssignment();
</script>