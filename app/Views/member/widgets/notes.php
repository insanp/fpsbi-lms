<!-- Floating Box for user question input using Bootstrap 4 -->
<div class="fixed-bottom text-center mb-3">
    <button id="catatan-button" class="btn btn-primary" type="button" data-toggle="collapse" data-target="#floatingBoxContent" aria-expanded="false" aria-controls="floatingBoxContent" style="opacity: 80%;">
        Notes <i id="toggleIcon" class="fas fa-chevron-up"></i>
    </button>
    <div class="collapse mt-2" id="floatingBoxContent">
        <div class="card card-body mx-auto" style="max-width: 800px;">
            <textarea id="noteInput" class="form-control" rows="5" placeholder="Catatan atau pertanyaan untuk topik '<?= $topic['title'] ?>'..."><?= htmlentities($note) ?></textarea>
            <input type="hidden" id="topicId" value="<?= $topic_id ?>">
            <button id="saveNoteButton" class="btn btn-success mt-2">Simpan</button>
        </div>
    </div>
    <div id="noteFeedback" class="text-center py-1 px-3 rounded" style="top: -30px; display: none; font-size: 0.9rem; opacity: 80%;"></div>
</div>

<script>
    document.getElementById('saveNoteButton').addEventListener('click', function() {
        const note = document.getElementById('noteInput').value;
        const topicId = document.getElementById('topicId').value;
        const feedback = document.getElementById('noteFeedback');
        const floatingBoxContent = document.getElementById('floatingBoxContent');
        const catatanButton = document.querySelector('#catatan-button');

        fetch('<?= base_url('member/api/notes/save') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    note: note,
                    topic_id: topicId
                })
            })
            .then(response => response.json())
            .then(data => {
                feedback.classList.remove('text-danger', 'text-primary'); // Remove any existing classes
                if (data.success) {
                    feedback.textContent = 'Catatan berhasil disimpan.';
                    feedback.classList.add('text-primary'); // Add success class
                    feedback.style.backgroundColor = 'white';
                    feedback.style.display = 'inline-block';
                    catatanButton.style.display = 'none'; // Hide the button
                    $(floatingBoxContent).collapse('hide');

                    setTimeout(() => {
                        feedback.style.display = 'none';
                        catatanButton.style.display = 'inline-block'; // Show the button again
                    }, 3000);
                } else {
                    feedback.textContent = 'Gagal menyimpan catatan.';
                    feedback.classList.add('text-danger'); // Add failure class
                    feedback.style.backgroundColor = 'white';
                    feedback.style.display = 'inline-block';
                }
            })
            .catch(error => {
                feedback.classList.remove('text-primary'); // Remove success class
                feedback.classList.add('text-danger'); // Add failure class
                feedback.textContent = 'Terjadi kesalahan saat menyimpan catatan.';
                feedback.style.backgroundColor = 'white';
                feedback.style.display = 'inline-block';
            });
    });

    // Use MutationObserver to detect class changes on collapse element
    const collapseElement = document.getElementById('floatingBoxContent');
    const toggleIcon = document.getElementById('toggleIcon');
    
    const observer = new MutationObserver(mutations => {
        mutations.forEach(mutation => {
            if (mutation.attributeName === 'class') {
                if (collapseElement.classList.contains('show')) {
                    toggleIcon.classList.remove('fa-chevron-up');
                    toggleIcon.classList.add('fa-chevron-down');
                } else {
                    toggleIcon.classList.remove('fa-chevron-down');
                    toggleIcon.classList.add('fa-chevron-up');
                }
            }
        });
    });
    
    observer.observe(collapseElement, { attributes: true });
</script>