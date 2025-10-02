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
        <h1 class="h3 mb-0 text-gray-800">LMS - Kode Etik dan Rules of Conduct</h1>
    </div>

    <div class="row text-gray-900">
        <div class="col-lg-10">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col text-center">
                            <h2><strong>Assessment</strong></h2>
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
                            <td>Waktu mulai</td>
                            <td>: <?= isset($part1['attempt_created_at']) && $part1['attempt_created_at'] ? $part1['attempt_created_at'] : '-' ?></td>
                        </tr>
                        <tr>
                            <td>Waktu selesai</td>
                            <td>: <?= isset($part1['attempt_completed_at']) && $part1['attempt_completed_at'] ? $part1['attempt_completed_at'] : '-' ?></td>
                        </tr>
                        <tr>
                            <td>Lama pengerjaan</td>
                            <td>:
                                <?php
                                if (isset($part1['attempt_created_at'], $part1['attempt_completed_at']) && $part1['attempt_created_at'] && $part1['attempt_completed_at']) {
                                    $start = new DateTime($part1['attempt_created_at']);
                                    $end = new DateTime($part1['attempt_completed_at']);
                                    $diff = $start->diff($end);
                                    echo $diff->format('%h jam, %i menit, %s detik');
                                } else {
                                    echo '-';
                                }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Percobaan ke-</td>
                            <td>: <?= isset($part1['attempt_number']) ? $part1['attempt_number'] : '-' ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-gray-900">
        <div class="col-lg-10 text-center">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($part1['score'] < 80): ?>
                        <div class="alert alert-danger">
                            <strong>Nilai Anda di bawah 80%.</strong> Anda perlu mengulang assessment untuk mendapatkan nilai yang lebih baik.<br />
                            Percobaan ke-<?= $part1['attempt_count'] ?> dari maksimal <?= $part1['max_attempts'] ?> percobaan.<br /><br />
                            <?php if ($part1['attempt_count'] < $part1['max_attempts']): ?>
                                <a href="<?= base_url('member/code-of-ethics/final-assessment/show') ?>" class="btn btn-primary">Ulangi Assessment</a>
                            <?php else: ?>
                                <span class="text-danger font-weight-bold">Anda telah mencapai batas maksimal percobaan assessment.</span>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <p>Selamat telah menyelesaikan Assessment Kode Etik dan Rules of Conduct.</p>
                    <p>Berikut ini adalah hasil evaluasi dan feedback dari jawaban Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row text-gray-900">
        <div class="col-lg-10">
            <div id="exam-part-1">
                <div class="card shadow mb-4">
                    <a href="#part1" class="d-block card-header bg-secondary py-3 text-center" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                        <h3 class="m-0 font-weight-bold text-white">Pilihan Ganda</h3>
                    </a>

                    <div class="collapse show" id="part1">
                        <div class="card-body">
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
                                        $temp_correct = false;
                                        foreach ($question['options'] as $option):
                                            $temp_submitted =  ($option['id'] == $part1['results'][$question['id']]['submitted_option']) ? true : false; ?>
                                            <li class="option-item" <?php if ($temp_submitted) : ?>
                                                style="border-radius: 5px; background: palegoldenrod;" <?php endif; ?>>
                                                <label class="option-label">
                                                    <input type="radio" name="part1[<?= $question['id'] ?>]" value="<?= $option['id'] ?>" disabled="disabled"
                                                        <?php if ($temp_submitted) { ?> checked="checked" <?php } ?>>
                                                    <div class="option-text"
                                                        <?php
                                                        if ($option['is_correct']) {
                                                            if ($temp_submitted)  $temp_correct = true;
                                                            echo 'style="color:green"';
                                                        } elseif ($temp_submitted && !$option['is_correct']) {
                                                            echo 'style="color:red"';
                                                        }
                                                        ?>><?= $option['option_text'] ?></div>
                                                </label>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>

                                    <p class="options">
                                        <?php if ($temp_correct): ?>
                                            <span class="text-success font-weight-bold">Benar</span> - <?= $question['correct_feedback'] ?>
                                        <?php else: ?>
                                            <span class="text-danger font-weight-bold">Salah</span> - <?= $question['incorrect_feedback'] ?>
                                        <?php endif; ?>
                                    </p>

                                </div>
                            <?php endforeach; ?>
                            <div class="alert alert-info">
                                <p><strong>Total Penilaian: <?= $part1['correct_answers'] . ' / ' . $part1['total_questions'] ?></strong></p>
                            </div>

                            <a href="#part1" data-toggle="collapse" class="btn btn-warning">Sembunyikan Pilihan Ganda</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        localStorage.removeItem('finalAssessmentAnswers');
    });
</script>
<?= $this->endSection() ?>