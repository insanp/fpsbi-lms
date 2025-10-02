<?= $this->extend('member/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid topic-content-container">
    <style>
        /* Ensure question number and text are aligned and wrapped text starts after the number */
        .question-row {
            display: flex;
            gap: 0.75rem;
            align-items: flex-start;
        }

        /* Reserve a fixed column for the question number so options can align to question-text */
        .question-number {
            flex: 0 0 2.2rem;
            min-width: 2.2rem;
            text-align: right;
            font-weight: 600;
        }

        .question-text {
            flex: 1 1 auto;
        }

        /* Options: push options to start at same horizontal point as question-text
              margin-left matches .question-number width (2.2rem) + the gap (0.75rem) */
        .options {
            padding-left: 0;
            margin: 0;
            margin-left: calc(2.2rem + 0.75rem);
        }

        .options .option-item {
            list-style: none;
            margin-bottom: 0.5rem;
        }

        /* Keep radio and option text pinned to the top so long text wraps from the first line */
        .option-label {
            display: flex;
            gap: 0.5rem;
            align-items: flex-start;
        }

        /* Small top offset to visually center the radio with the first line of text */
        .option-label input[type="radio"] {
            flex: 0 0 auto;
            margin-top: 0.35rem;
            margin-right: 0.35rem;
        }

        .option-text {
            flex: 1 1 auto;
        }
    </style>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">LMS - Registered Financial Planner&reg;</h1>
    </div>

    <div class="row text-gray-900">
        <div class="col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col text-center">
                            <h2><strong>Latihan Ujian</strong></h2>
                        </div>
                    </div>
                    <br />
                    <table>
                        <tr>
                            <td>Member ID</td>
                            <td>: <?= $sessionData['member_id'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama peserta</td>
                            <td>: <?= $sessionData['name'] ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal sejak dimulai</td>
                            <td>: <span id="start-time"><?= $part1Data['task']['created_at'] ?></span>
                                <!-- Dynamic elapsed time display -->
                                <span id="elapsed-time" data-created-at="<?= $part1Data['task']['created_at'] ?>"></span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- start exam form -->
    <form id="assessment-form" action="<?= base_url('member/rfp-ins/final-assessment/submit') ?>" method="POST">
        <div class="row text-gray-900">
            <div class="col-lg-10">
                <div id="exam-part-1">
                    <div class="card shadow mb-4">
                        <a href="#part1" class="d-block card-header bg-secondary py-3 text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                            <h3 class="m-0 font-weight-bold text-white">Multiple Choice Questions</h3>
                        </a>
                        <input type="hidden" name="part1_taskid" value="<?= $part1Data['task']['id'] ?>" />

                        <div class="collapse show" id="part1">
                            <div class="card-body pr-5">
                                <!-- Questions Loop -->
                                <?php foreach ($part1Data['questions'] as $index => $question): ?>
                                    <div class="mb-4">
                                        <div class="question-row mb-2">
                                            <div class="question-number"><?= $index + 1 ?>.</div>
                                            <div class="question-text text-justify"><?= $question['question'] ?></div>
                                        </div>

                                        <!-- Image, if exists -->
                                        <?php if (!empty($question['image'])): ?>
                                            <div class="text-center mb-3 mt-3">
                                                <img src="<?= base_url('assets/member/img/' . $question['image']) ?>" alt="Question Image" style="width:100%; max-width:500px;">
                                            </div>
                                        <?php endif; ?>

                                        <!-- Options Loop -->
                                        <ul class="options">
                                            <?php
                                            shuffle($question['options']);
                                            foreach ($question['options'] as $option): ?>
                                                <li class="option-item">
                                                    <label class="option-label">
                                                        <input type="radio" name="part1[<?= $question['id'] ?>]" value="<?= $option['id'] ?>">
                                                        <div class="option-text"><?= $option['option_text'] ?></div>
                                                    </label>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row text-gray-900">
            <div class="col-lg-10 text-center">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p><strong>Multiple Choice:</strong> <span id="part1-answered-count">0</span></p>
                        <a class="btn btn-success mt-2" href="#" data-toggle="modal" data-target="#submitModal">
                            Submit Jawaban
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="fa_secret_key" value="<?= $fa_secret_key ?>" />
    </form>
    <!-- end exam form -->
    <div id="save-notification" class="exam-save-notification" style="display: none;">
        <p>Jawaban telah disimpan ke penyimpanan lokal browser Anda.</p>
    </div>

    <button id="save-button" class="exam-save-button">Klik untuk Simpan Draft Jawaban</button>
</div>
<div class="modal fade" id="submitModal" tabindex="-1" role="dialog" aria-labelledby="submitModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitModalLabel">Submit jawaban Final Assessment</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Apakah Anda sudah yakin dengan jawaban Anda?</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Belum</button>
                <button class="btn btn-primary" id="confirm-submit" type="button">Yakin</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        const mcOptions = document.querySelectorAll('input[name^="part1"]');
        const answeredCountDisplay = document.getElementById('part1-answered-count');
        const saveButton = document.getElementById('save-button');
        const saveNotification = document.getElementById('save-notification');
        const storageKey = 'finalAssessmentAnswers';

        // Load saved answers from local storage on page load
        function loadAnswers() {
            const savedAnswers = JSON.parse(localStorage.getItem(storageKey)) || {};

            // Load multiple-choice selections
            mcOptions.forEach(option => {
                const questionName = option.name;
                if (savedAnswers[questionName] === option.value) {
                    option.checked = true;
                }
            });
        }

        // Save answers to local storage
        function saveAnswers() {
            const answers = {};

            // Save multiple-choice answers
            mcOptions.forEach(option => {
                if (option.checked) {
                    answers[option.name] = option.value;
                }
            });

            localStorage.setItem(storageKey, JSON.stringify(answers));
            showSaveNotification();
        }

        // Show save notification balloon
        function showSaveNotification() {
            saveButton.style.display = 'none';
            saveNotification.style.display = 'block';

            setTimeout(() => {
                saveNotification.style.display = 'none';
                saveButton.style.display = 'block';
            }, 2000);
        }

        // Update Part 1 answered count
        function updateAnsweredCount() {
            const uniqueAnsweredQuestions = new Set();
            mcOptions.forEach(option => {
                if (option.checked) {
                    uniqueAnsweredQuestions.add(option.name);
                }
            });

            answeredCountDisplay.textContent = `${uniqueAnsweredQuestions.size} soal sudah terjawab.`;
        }

        // Add event listeners
        mcOptions.forEach(option => {
            option.addEventListener('change', updateAnsweredCount);
        });

        // Event listener for the Save button
        saveButton.addEventListener('click', saveAnswers);

        // Auto-save every minute
        setInterval(saveAnswers, 60000);

        // Initial load and update on page load
        loadAnswers();
        updateAnsweredCount();
    });

    document.getElementById("confirm-submit").addEventListener("click", function() {
        // Submit the form when "Yakin" is clicked
        document.getElementById("assessment-form").submit();
    });

    document.addEventListener("DOMContentLoaded", function() {
        const elapsedTimeElement = document.getElementById("elapsed-time");
        const createdAt = elapsedTimeElement.getAttribute("data-created-at");

        // Parse created_at into a Date object
        const createdAtDate = new Date(createdAt);

        function updateElapsedTime() {
            // Get current time
            const now = new Date();

            // Calculate the difference in milliseconds
            const diff = now - createdAtDate;

            // Convert to hours, minutes, and seconds
            const hours = Math.floor(diff / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            // Display the elapsed time in the format "Elapsed time: X hours, Y minutes, Z seconds"
            elapsedTimeElement.textContent = `(${hours} jam, ${minutes} menit, ${seconds} detik)`;
        }

        // Initial calculation and update every second
        updateElapsedTime();
        setInterval(updateElapsedTime, 1000); // Update every 1000 milliseconds (1 second)
    });
</script>
<?= $this->endSection() ?>