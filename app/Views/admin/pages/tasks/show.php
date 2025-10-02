<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Show Task</h1>
    </div>
    <p class="mb-4">Details of the task</p>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" value="<?= esc($task['name']) ?>" readonly>
            </div>
            <div class="form-group">
                <label for="starting_statement">Starting Statement</label>
                <textarea id="starting_statement" class="form-control" readonly><?= esc($task['starting_statement']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="finishing_statement">Finishing Statement</label>
                <textarea id="finishing_statement" class="form-control" readonly><?= esc($task['finishing_statement']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="type">Type</label>
                <input type="text" id="type" class="form-control" value="<?= ucfirst(str_replace('_', ' ', esc($task['type']))) ?>" readonly>
            </div>
            <a href="<?= base_url('admin/topics/' . $task['topic_id']) ?>" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <!-- Questions Section -->
    <?php if (in_array($task['type'], ['quiz', 'exam_mc'])): ?>
        <form action="<?= base_url('admin/tasks/updateQuestions') ?>" method="post">
            <input type="hidden" name="task_id" value="<?= $task['id'] ?>">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Questions</h6>
                </div>
                <div class="card-body">
                    <ul class="list-group" id="question-list">
                        <?php if (!empty($questions)): ?>
                            <?php foreach ($questions as $question): ?>
                                <li class="list-group-item" data-id="<?= $question['id'] ?>" draggable="false">
                                    <a href="#question_<?= $question['id'] ?>" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="question_<?= $question['id'] ?>">
                                        <strong> <span class="order-num"><?= $question['order_num'] ?></span>. <span id="question_text_<?= $question['id'] ?>"><?= esc($question['question']) ?></span> (ID: <?= $question['id'] ?>)</strong>
                                    </a>
                                    <div class="collapse" id="question_<?= $question['id'] ?>">
                                        <div class="card-body">
                                            <div class="form-row align-items-center">
                                                <div class="col-auto">
                                                    <strong> Q: </strong>
                                                </div>
                                                <div class="col">
                                                    <textarea name="questions[<?= $question['id'] ?>][question]" id="question_input_<?= $question['id'] ?>" class="form-control" oninput="updateQuestionText(<?= $question['id'] ?>)"><?= esc($question['question']) ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-row align-items-center mt-2">
                                                <div class="col-auto">
                                                    <label for="image_<?= $question['id'] ?>">Image:</label>
                                                </div>
                                                <div class="col">
                                                    <input type="text" name="questions[<?= $question['id'] ?>][image]" id="image_<?= $question['id'] ?>" class="form-control" value="<?= esc($question['image']) ?>">
                                                </div>
                                            </div>
                                            <?php if (!empty($question['options'])): ?>
                                                <ul class="list-group mt-2">
                                                    <?php foreach ($question['options'] as $option): ?>
                                                        <li class="list-group-item-option">
                                                            <div class="form-row align-items-center">
                                                                <div class="col">
                                                                    <textarea name="questions[<?= $question['id'] ?>][options][<?= $option['id'] ?>][option_text]" id="option_<?= $option['id'] ?>" class="form-control"><?= esc($option['option_text']) ?></textarea>
                                                                </div>
                                                                <div class="col-auto">
                                                                    <small>ID: <?= $option['id'] ?></small>
                                                                </div>
                                                                <div class="form-check
                                                                <div class=" col-auto">
                                                                    <div class="form-check mt-2">
                                                                        <input class="form-check-input" type="checkbox" name="questions[<?= $question['id'] ?>][options][<?= $option['id'] ?>][is_correct]" id="correct_<?= $option['id'] ?>" <?= $option['is_correct'] ? 'checked' : '' ?>>
                                                                        <label class="form-check-label" for="correct_<?= $option['id'] ?>">
                                                                            Correct
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mt-2">

                                                            </div>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                            <div class="form-row align-items-center mt-2">
                                                <div class="col">
                                                    <label for="correct_feedback_<?= $question['id'] ?>">Correct Feedback:</label>
                                                    <textarea name="questions[<?= $question['id'] ?>][correct_feedback]" id="correct_feedback_<?= $question['id'] ?>" class="form-control" style="min-height: 100px;"><?= esc($question['correct_feedback']) ?></textarea>
                                                </div>
                                                <div class="col">
                                                    <label for="incorrect_feedback_<?= $question['id'] ?>">Incorrect Feedback:</label>
                                                    <textarea name="questions[<?= $question['id'] ?>][incorrect_feedback]" id="incorrect_feedback_<?= $question['id'] ?>" class="form-control" style="min-height: 100px;"><?= esc($question['incorrect_feedback']) ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No questions found for this task.</p>
                        <?php endif; ?>
                    </ul>
                </div>
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm" onclick="addNewQuestion()">Add Question</button>
                    <button type="button" class="btn btn-secondary btn-sm" id="toggle-draggable">Enable Dragging</button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Questions</button>
        </form>
    <?php endif; ?>
</div>

<script>
    function updateQuestionText(questionId) {
        var input = document.getElementById('question_input_' + questionId);
        var span = document.getElementById('question_text_' + questionId);
        span.textContent = input.value;
    }

    function addNewQuestion() {
        var questionList = document.getElementById('question-list');
        var newQuestionId = 'new_' + Date.now();
        var newQuestionHtml = `
            <li class="list-group-item" data-id="${newQuestionId}" draggable="false">
                <a href="#question_${newQuestionId}" class="d-block card-header py-3 collapsed" data-toggle="collapse" role="button" aria-expanded="false" aria-controls="question_${newQuestionId}">
                    <strong> <span class="order-num"></span>. <span id="question_text_${newQuestionId}"></span> (ID: ${newQuestionId})</strong>
                </a>
                <div class="collapse" id="question_${newQuestionId}">
                    <div class="card-body">
                        <div class="form-row align-items-center">
                            <div class="col-auto">
                                <strong> Q: </strong>
                            </div>
                            <div class="col">
                                <textarea name="questions[${newQuestionId}][question]" id="question_input_${newQuestionId}" class="form-control" oninput="updateQuestionText('${newQuestionId}')"></textarea>
                            </div>
                        </div>
                        <div class="form-row align-items-center mt-2">
                            <div class="col-auto">
                                <label for="image_${newQuestionId}">Image:</label>
                            </div>
                            <div class="col">
                                <input type="text" name="questions[${newQuestionId}][image]" id="image_${newQuestionId}" class="form-control" value="">
                            </div>
                        </div>
                        <ul class="list-group mt-2">
                            ${[1, 2, 3, 4].map(optionIndex => `
                                <li class="list-group-item-option">
                                    <div class="form-row align-items-center">
                                        <div class="col">
                                            <textarea name="questions[${newQuestionId}][options][new_${optionIndex}][option_text]" id="option_${newQuestionId}_${optionIndex}" class="form-control"></textarea>
                                        </div>
                                        <div class="col-auto">
                                            <small>ID: new_${optionIndex}</small>
                                        </div>
                                        <div class="form-check col-auto">
                                            <div class="form-check mt-2">
                                                <input class="form-check-input" type="checkbox" name="questions[${newQuestionId}][options][new_${optionIndex}][is_correct]" id="correct_${newQuestionId}_${optionIndex}">
                                                <label class="form-check-label" for="correct_${newQuestionId}_${optionIndex}">
                                                    Correct
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-2"></div>
                                </li>
                            `).join('')}
                        </ul>
                        <div class="form-row align-items-center mt-2">
                            <div class="col">
                                <label for="correct_feedback_${newQuestionId}">Correct Feedback:</label>
                                <textarea name="questions[${newQuestionId}][correct_feedback]" id="correct_feedback_${newQuestionId}" class="form-control" style="min-height: 100px;"></textarea>
                            </div>
                            <div class="col">
                                <label for="incorrect_feedback_${newQuestionId}">Incorrect Feedback:</label>
                                <textarea name="questions[${newQuestionId}][incorrect_feedback]" id="incorrect_feedback_${newQuestionId}" class="form-control" style="min-height: 100px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        `;
        questionList.insertAdjacentHTML('beforeend', newQuestionHtml);
        updateOrderNumbers();
        addDragAndDropListeners();
    }

    function addDragAndDropListeners() {
        var questionList = document.getElementById('question-list');
        var draggedItem = null;

        questionList.addEventListener('dragstart', function(e) {
            if (e.target.tagName === 'LI' && e.target.getAttribute('draggable') === 'true') {
                draggedItem = e.target;
                e.target.style.opacity = 0.5;
            } else if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
                // Prevent drag events on inputs and textareas
                e.preventDefault();
            } else {
                e.preventDefault();
            }
        });

        questionList.addEventListener('dragend', function(e) {
            e.target.style.opacity = "";
            draggedItem = null;
        });

        questionList.addEventListener('dragover', function(e) {
            e.preventDefault();
        });

        questionList.addEventListener('dragenter', function(e) {
            if (e.target.classList.contains('list-group-item')) {
                e.target.style.borderTop = "2px solid #007bff";
            }
        });

        questionList.addEventListener('dragleave', function(e) {
            if (e.target.classList.contains('list-group-item')) {
                e.target.style.borderTop = "";
            }
        });

        questionList.addEventListener('drop', function(e) {
            e.preventDefault();
            if (e.target.classList.contains('list-group-item')) {
                e.target.style.borderTop = "";
                questionList.insertBefore(draggedItem, e.target.nextSibling);
                updateOrderNumbers();
            }
        });
    }

    function updateOrderNumbers() {
        var items = document.querySelectorAll('#question-list .list-group-item');
        items.forEach(function(item, index) {
            item.querySelector('.order-num').textContent = index + 1;
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('question-list')) {
            addDragAndDropListeners();
        }

        var toggleDraggableButton = document.getElementById('toggle-draggable');
        toggleDraggableButton.addEventListener('click', function() {
            var questionListItems = document.querySelectorAll('#question-list .list-group-item');
            var isDraggable = questionListItems[0].getAttribute('draggable') === 'true';
            questionListItems.forEach(function(item) {
                item.setAttribute('draggable', !isDraggable);
            });
            toggleDraggableButton.textContent = isDraggable ? 'Enable Dragging' : 'Disable Dragging';
        });
    });
</script>

<?= $this->endSection() ?>