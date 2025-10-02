<!-- Quiz widget -->
<div class="row text-gray-900" style="margin-bottom: 10px;">
    <div class="col-lg-10">
        <div class="card shadow mb-4">
            <div class="card-header py-3 text-center">
                <h2 class="m-0 font-weight-bold">Latihan Quiz</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col text-justify">
                        <p>Uji pemahaman Anda melalui kuis pilihan berganda interaktif berikut ini. Anda dapat melakukan kuis ini berkali-kali, jadi manfaatkan untuk memperdalam pemahaman dan keterampilan Anda dalam setiap topik yang dibahas.</p>
                        <br />
                        <p>
                            Untuk membuka topik selanjutnya, silakan selesaikan latihan berikut ini setidaknya sekali.</p>
                    </div>
                </div>
                <br />
                <hr />
                <div class="row">
                    <div id="quiz-container" class="col text-justify">
                        <div id="welcome-screen" class="text-center mb-5 mt-4">
                            <h4 class="text-center" id="task-name"></h4>
                            <p id="starting-statement"></p>
                            <br />
                            <button id="start-quiz" class="btn btn-success" style="padding: 15px;">Mulai</button>
                        </div>

                        <div id="quiz-screen" style="display:none;" class="mb-5 mt-4">
                            <div id="question-container">
                                <h4 class="text-center" id="question-counter"></h4>
                                <br />
                                <p id="question-text"></p>
                                <br />
                                <div class="text-center"><img src="" id="question-image" class="mb-4" /></div>
                                <div id="options-container" class="col text-center">
                                </div>
                                <div class="col feedback-container text-center">
                                    <p id="feedback-answer"></p>
                                </div>
                                <div style="display:none" id="correct-feedback-placeholder"></div>
                                <div style="display:none" id="incorrect-feedback-placeholder"></div>
                            </div>
                            <br />
                            <div class="text-center">
                                <button id="next-question" class="btn btn-info" style="display:none;">Selanjutnya</button>
                            </div>
                        </div>

                        <div id="score-screen" style="display:none;" class="mb-5 mt-4 text-center">
                            <h4 class="text-center">Nilai quiz Anda:<br /><strong><span id="final-score"></span></strong></h4>
                            <div id="completed-task" class="mt-4 text-center">
                                <div id="stars-container" class="text-center mb-4">
                                    <!-- Stars will be dynamically added here -->
                                </div>
                                <p id="finishing-statement"></p>
                                <br />
                                <button id="to-next-topic" class="btn btn-success" style="padding: 15px;">Topik Selanjutnya</button>
                                <button id="retry-quiz" class="btn btn-warning" style="padding: 15px;">Mulai Ulang</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    // Global variable to hold the quiz data
    let quizData = null;
    let currentQuestionIndex = 0;
    let correctAnswers = 0;
    let taskId = <?= $task_id ?>;
    let topicId = <?= $topic_id ?>;
    let taskAttemptId = null;
    let score = 0;

    function loadQuiz() {
        fetch('<?= base_url('/member/api/task/load-quiz/' . $task_id) ?>', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json' // Expect JSON from the server
                },
                credentials: 'include' // Ensure the session cookie is included
            })
            .then(response => response.json())
            .then(data => {
                quizData = data;
                showWelcomeScreen();
            })
            .catch(error => console.error('Error fetching questions:', error));
    }

    loadQuiz();

    // Function to display the welcome screen with the starting statement
    function showWelcomeScreen() {
        const taskName = quizData.task.name;
        const startingStatement = quizData.task.starting_statement;

        // Display the task name and starting statement on the welcome screen
        document.getElementById('task-name').textContent = taskName;
        document.getElementById('starting-statement').textContent = startingStatement;

        // Show the welcome screen and hide the quiz screen
        document.getElementById('welcome-screen').style.display = 'block';
        document.getElementById('quiz-screen').style.display = 'none';
    }

    // Event listener for the "Start Quiz" button
    document.getElementById('start-quiz').addEventListener('click', function() {
        startQuiz();
    });

    // Function to start the quiz (hide the welcome screen, show the quiz screen)
    function startQuiz() {
        const taskId = <?= $task_id ?>;

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
                    taskAttemptId = parseInt(data.task_attempt_id);
                    // Proceed with the quiz start
                    document.getElementById('welcome-screen').style.display = 'none';
                    document.getElementById('quiz-screen').style.display = 'block';
                    document.getElementById('score-screen').style.display = 'none';
                    showQuestion(currentQuestionIndex);
                } else {
                    console.error('Failed to create task attempt.');
                }
            })
            .catch(error => console.error('Error:', error));
    }

    // Function to display a question and its options
    function showQuestion(questionIndex) {
        const question = quizData.questions[questionIndex];

        const totalQuestions = quizData.questions.length;
        const counterText = `Pertanyaan ${questionIndex + 1} dari ${totalQuestions}`;
        document.getElementById('question-counter').textContent = counterText;

        // Display the question text
        document.getElementById('question-text').innerHTML = question.question;
        document.getElementById('question-image').src = question.image ? '<?= base_url('assets/member/img/') ?>' + question.image : '';
        document.getElementById('question-image').style.display = question.image ? 'inline-block' : 'none';
        document.getElementById('correct-feedback-placeholder').textContent = question.correct_feedback;
        document.getElementById('incorrect-feedback-placeholder').textContent = question.incorrect_feedback;

        // Display the options
        const optionsContainer = document.getElementById('options-container');
        optionsContainer.innerHTML = ''; // Clear previous options

        // Shuffles the options
        question.options = shuffleArray(question.options);

        // Loop through the options and create buttons for each
        question.options.forEach((option) => {
            const optionButton = document.createElement('button');
            optionButton.className = 'btn btn-answer text-gray-900';
            optionButton.textContent = option.option_text;
            optionButton.setAttribute('data-option-id', option.id); // Add option ID for future use

            // Add an event listener to handle the click
            optionButton.addEventListener('click', function() {
                handleAnswer(option.id, question.id);
            });

            // Append the option button to the options container
            optionsContainer.appendChild(optionButton);
        });
    }

    // Function to handle answer selection
    function handleAnswer(optionId, questionId) {
        const postData = {
            task_attempt_id: taskAttemptId,
            question_id: questionId,
            option_id: optionId
        };

        // Send the data via POST to your API
        fetch('<?= base_url('/member/api/task/submit-mc-answer') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(postData)
            })
            .then(response => response.json())
            .then(data => {
                // Highlight the correct answer
                const correctButton = document.querySelector(`button[data-option-id="${data.correct_option_id}"]`);
                if (correctButton) {
                    correctButton.classList.add('correct-answer');
                }

                const selectedButton = document.querySelector(`button[data-option-id="${optionId}"]`);
                if (selectedButton !== correctButton) {
                    selectedButton.classList.add('incorrect-answer');
                }

                // Disable all option buttons after answering
                const allButtons = document.querySelectorAll('#options-container button');
                allButtons.forEach(button => button.disabled = true);

                if (data['is_correct']) {
                    document.getElementById('feedback-answer').innerHTML = '<span class="text-success">Benar</span> - ' + document.getElementById('correct-feedback-placeholder').innerHTML;
                    correctAnswers++;
                } else {
                    document.getElementById('feedback-answer').innerHTML = '<span class="text-danger">Salah</span> - ' + document.getElementById('incorrect-feedback-placeholder').innerHTML;
                }

                document.getElementById('next-question').style.display = 'inline-block';

                document.getElementById('feedback-answer').scrollIntoView({
                    behavior: 'smooth' // Optional: Adds smooth scrolling
                });
            })
            .catch(error => console.error('Error:', error));
    }

    function retryQuiz() {
        currentQuestionIndex = 0;
        correctAnswers = 0;
        document.getElementById('welcome-screen').style.display = 'block';
        document.getElementById('score-screen').style.display = 'none';
    }

    document.getElementById('retry-quiz').addEventListener('click', function() {
        retryQuiz();
    });

    // Event listener for the "Next Question" button
    document.getElementById('next-question').addEventListener('click', function() {
        // Move to the next question
        currentQuestionIndex++;
        document.getElementById('feedback-answer').innerHTML = '';
        document.getElementById('next-question').style.display = 'none';
        if (currentQuestionIndex < quizData.questions.length) {
            // Show the next question
            showQuestion(currentQuestionIndex);
        } else {
            // If no more questions, finish the quiz
            finishQuiz();
        }
        document.getElementById('question-container').scrollIntoView({
            behavior: 'smooth' // Optional: Adds smooth scrolling
        });
    });

    function completeQuiz() {
        fetch('<?= base_url('/member/api/task/complete-quiz') ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    task_id: taskId,
                    topic_id: topicId,
                    score: score
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
    }

    // Function to finish the quiz and display the result
    function finishQuiz() {
        score = correctAnswers / quizData.questions.length * 100; // Calculate score as a percentage
        let totalQuestions = quizData.questions.length;
        let litStars = (correctAnswers === totalQuestions) ? 3 : (correctAnswers / totalQuestions > 0.5 ? 2 : 1);
        let starsHtml = '';
        for (let i = 0; i < 3; i++) {
            if (i < litStars) {
                starsHtml += '<i class="fas fa-star" style="color:gold; font-size: xxx-large;"></i> ';
            } else {
                starsHtml += '<i class="far fa-star" style="color:gray; font-size: xxx-large;"></i> ';
            }
        }
        let feedbackText = '';
        if (litStars === 1) {
            feedbackText = "Cukup baik, Anda bisa tingkatkan!";
        } else if (litStars === 2) {
            feedbackText = "Luar biasa, terus kembangkan!";
        } else if (litStars === 3) {
            feedbackText = "Sempurna, Anda sangat memahami materi!";
        }

        document.getElementById('quiz-screen').style.display = 'none';
        document.getElementById('score-screen').style.display = 'block';
        document.getElementById('final-score').textContent = correctAnswers + ' dari ' + totalQuestions;
        document.getElementById('completed-task').style.display = 'block';
        document.getElementById('stars-container').innerHTML = starsHtml + '<br /><br /><p><strong>' + feedbackText + '</strong></p>';
        document.getElementById('finishing-statement').textContent = quizData.task.finishing_statement;
        document.getElementById('quiz-container').scrollIntoView({
            behavior: 'smooth' // Optional: Adds smooth scrolling
        });
        completeQuiz();
    }

    // Fisher-Yates Shuffle function to shuffle an array
    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]]; // Swap elements
        }
        return array;
    }

    document.getElementById('to-next-topic').addEventListener('click', function() {
        document.getElementById('go-to-next').click();
    });
</script>
<!-- End Quiz Widget -->