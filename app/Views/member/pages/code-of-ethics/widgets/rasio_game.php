<div class="row text-gray-900">
    <div class="col">
        <div id="game-matching-widget">
            <div class="card shadow mb-4">
                <div class="card-header bg-primary py-3 text-center">
                    <h2 class="m-0 font-weight-bold text-white">Game Matching Pair</h2>
                </div>
                <div class="card-body">
                    <div id="game-start-screen" class="row screen active text-center">
                        <p>
                            Anda dapat mencoba memainkan permainan matching pair di bawah ini untuk mengevaluasi pengetahuan Anda terkait rumus dari ke 8 rasio keuangan.</p>
                        <button onclick="startGame()" class="btn btn-success mt-4" style="padding: 15px;">Mulai</button>
                    </div>

                    <div id="game-gameplay-screen" class="row screen">
                        <p class="text-center"><strong>Klik rasio dan rumus</strong> yang cocok terhadap satu sama lain. Bila benar, maka pilihan akan hilang. Selesaikan semua pasangan!</p>
                        <p class="text-center"><strong>Waktu: <span id="game-timer">0</span> detik</strong></p>
                        <p class="text-center"><strong>Total Pasangan: <span id="game-match-counter">0</span></strong></p>
                        <p class="text-center" id="game-result"></p>
                        <div class="game-container">
                            <div id="game-terms" class="terms">
                                <h4 class="text-center">Rasio</h4>
                                <ul id="game-terms-list">
                                </ul>
                            </div>
                            <div id="game-definitions" class="definitions">
                                <h4 class="text-center">Rumus</h4>
                                <ul id="game-definitions-list">
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div id="game-end-screen" class="row screen">
                        <h4 class="text-center">Selamat!</h4>
                        <p class="text-center">Anda berhasil menyelesaikan game dalam <strong><span id="game-time-spent"></span> detik</strong>.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    const pairsArray = [{
            term: 'Rasio Likuiditas (Basic Liquidity Ratio)',
            definition: 'kas atau setara kas / pengeluaran bulanan'
        },
        {
            term: 'Rasio Aset Likuid Terhadap Nilai Bersih Kekayaan (Liquid Asset to Net Worth Ratio)',
            definition: 'aset likuid / nilai bersih kekayaan'
        },
        {
            term: 'Rasio Tabungan (Saving Ratio)',
            definition: 'tabungan / pendapatan kotor'
        },
        {
            term: 'Rasio Perbandingan Hutang Terhadap Aset (Debt to Asset Ratio)',
            definition: 'total hutang / total aset'
        },
        {
            term: 'Rasio Kemampuan Pelunasan Hutang (Debt Service Ratio)',
            definition: 'total pembayaran pinjaman tahunan / total pendapatan tahunan'
        },
        {
            term: 'Rasio Kemampuan Pelunasan Hutang Non Hipotek (Non Mortgage Debt Service Ratio)',
            definition: 'total pembayaran tahunan pinjaman nonhipotek / total pendapatan tahunan'
        },
        {
            term: 'Rasio Perbandingan Nilai Bersih Aset Investasi Terhadap Nilai Bersih Kekayaan (Net Investment Assets To Net Worth Ratio)',
            definition: 'total aset investasi / nilai bersih kekayaan'
        },
        {
            term: 'Rasio Solvabilitas (Solvency Ratio)',
            definition: 'total nilai bersih kekayaan / total aset'
        }
    ];

    let pairs = []; // This will store the full list of pairs
    let currentBatch = []; // This will store the current batch
    let batchSize = 8; // Default batch size
    let currentBatchIndex = 0; // Index to track which batch we are on

    function shuffleArray(array) {
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]]; // Swap elements
        }
    }

    let selectedDefinition = null;
    let selectedTerm = null;
    let correctMatches = 0; // Track correct matches
    const totalMatches = pairsArray.length; // Total number of matches to complete the game
    let startTime, endTime, timeInterval;
    let isPairingDisabled = false;

    let correctMatchesMap = {};

    // Function to start the game
    function startGame() {
        loadNextBatch();
        // Show the gameplay screen and hide the start screen
        document.querySelector('#game-start-screen').classList.remove('active');
        document.querySelector('#game-gameplay-screen').classList.add('active');

        // Record the start time
        startTime = Date.now();
        timerInterval = setInterval(updateTimer, 1000);
        document.getElementById('game-match-counter').innerHTML = correctMatches + ' / ' + totalMatches;
    }

    function loadNextBatch() {
        document.getElementById('game-timer').scrollIntoView({
            behavior: 'smooth' // Optional: Adds smooth scrolling
        });
        const start = currentBatchIndex * batchSize;
        const end = start + batchSize;
        currentBatch = pairsArray.slice(start, end); // Get the next batch

        if (currentBatch.length > 0) {
            displayBatch(currentBatch);
            currentBatchIndex++; // Increment batch index
        } else {
            endGame();
        }
    }

    function displayBatch(batch) {
        // Create separate arrays for terms and definitions
        const termsArray = batch.map((pair, index) => ({
            id: `game-term${index + 1}`,
            text: pair.term
        }));
        const definitionsArray = batch.map((pair, index) => ({
            id: `game-def${index + 1}`,
            text: pair.definition
        }));

        // Populate correctMatchesMap dynamically from pairsArray
        correctMatchesMap = batch.reduce((map, pair, index) => {
            map[`game-term${index + 1}`] = `game-def${index + 1}`;
            return map;
        }, {});

        // Shuffle both arrays
        shuffleArray(termsArray);
        shuffleArray(definitionsArray);

        const termsList = document.getElementById('game-terms-list');
        const definitionsList = document.getElementById('game-definitions-list');

        // Clear any existing content
        termsList.innerHTML = '';
        definitionsList.innerHTML = '';

        // Populate terms
        termsArray.forEach(term => {
            const li = document.createElement('li');
            li.id = term.id;
            li.setAttribute('onclick', `selectTerm('${term.id}')`);
            li.innerHTML = `<div>${term.text}</div>`;
            termsList.appendChild(li);
        });

        // Populate definitions
        definitionsArray.forEach(def => {
            const li = document.createElement('li');
            li.id = def.id;
            li.setAttribute('onclick', `selectDefinition('${def.id}')`);
            li.innerHTML = `<div>${def.text}</div>`;
            definitionsList.appendChild(li);
        });
    }

    function updateTimer() {
        const currentTime = Date.now();
        const elapsedTime = Math.round((currentTime - startTime) / 1000); // Convert to seconds
        document.getElementById('game-timer').textContent = elapsedTime;
    }

    // Function to select a definition
    function selectDefinition(defId) {
        if (isPairingDisabled) return;
        if (selectedDefinition) {
            selectedDefinition.classList.remove('selected');
        }

        selectedDefinition = document.getElementById(defId);
        selectedDefinition.classList.add('selected');

        if (selectedTerm) {
            checkMatch();
        }
    }

    // Function to select a term
    function selectTerm(termId) {
        if (isPairingDisabled) return;
        if (selectedTerm) {
            selectedTerm.classList.remove('selected');
        }

        selectedTerm = document.getElementById(termId);
        selectedTerm.classList.add('selected');

        if (selectedDefinition) {
            checkMatch();
        }
    }

    // Function to check if the selected term and definition match
    function checkMatch() {
        const termId = selectedTerm.id;
        const definitionId = selectedDefinition.id;

        if (correctMatchesMap[termId] === definitionId) {
            showFeedback('Benar!', 'success');
            removeAfterDelay(selectedTerm, selectedDefinition);
            selectedTerm = null;
            selectedDefinition = null;

            correctMatches++;
            document.getElementById('game-match-counter').innerHTML = correctMatches + ' / ' + totalMatches;
            if (correctMatches === totalMatches) {
                endGame();
            } else if (correctMatches % batchSize === 0) {
                loadNextBatch();
            }
        } else {
            isPairingDisabled = true;
            selectedTerm.classList.add('horizontal-shaking', 'match-wrong');
            selectedDefinition.classList.add('horizontal-shaking', 'match-wrong');
            showFeedback('Salah!', 'error');
            setTimeout(() => {
                selectedTerm.classList.remove('horizontal-shaking', 'match-wrong', 'selected');
                selectedDefinition.classList.remove('horizontal-shaking', 'match-wrong', 'selected');
                selectedTerm = null;
                selectedDefinition = null;
                isPairingDisabled = false;
            }, 1000);
        }
    }

    // Function to remove matched terms and definitions after a delay
    function removeAfterDelay(termElement, definitionElement) {
        termElement.classList.add('match-correct');
        definitionElement.classList.add('match-correct');
        setTimeout(() => {
            termElement.style.cursor = 'default';
            definitionElement.style.cursor = 'default';
        }, 1000);
    }

    // Function to show feedback (Correct/Wrong)
    function showFeedback(message, type) {
        return;
        const result = document.getElementById('game-result');
        result.textContent = message;
        result.style.color = type === 'success' ? 'green' : 'red';

        setTimeout(() => {
            result.textContent = '';
        }, 2000);
    }

    // Function to end the game and show the end screen
    function endGame() {
        // Stop the timer
        clearInterval(timerInterval);
        // Record the end time and calculate the time spent
        endTime = Date.now();
        const timeSpent = Math.round((endTime - startTime) / 1000); // Convert milliseconds to seconds

        // Show the end screen
        document.querySelector('#game-gameplay-screen').classList.remove('active');
        document.querySelector('#game-end-screen').classList.add('active');

        // Display the time spent on the end screen
        document.getElementById('game-time-spent').textContent = timeSpent;
        document.getElementById('game-end-screen').scrollIntoView({
            behavior: 'smooth' // Optional: Adds smooth scrolling
        });
    }
</script>
<style>
    .screen {
        display: none;
    }

    .active {
        display: block;
    }

    .game-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        /* Two equal columns for terms and definitions */
        gap: 20px;
        /* Add some space between the two columns */
    }

    .terms ul,
    .definitions ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .game-container li {
        color: black;
        padding: 10px;
        margin: 5px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        height: 85px;
        /* Set a fixed height for all items */
        box-sizing: border-box;
        /* Include padding and borders in the height */
        white-space: normal;
        /* Allow text to wrap */
        line-height: 1.5;
        border-radius: 2px;
    }

    .game-container li div {
        height: 100%;
        overflow: auto;
    }

    .definitions ul li {
        align-items: center;
        border-radius: 0 50px 50px 0;
        text-align: center;
        background: rgb(249, 249, 249);
        background: linear-gradient(90deg, rgba(249, 249, 249, 1) 0%, rgba(214, 238, 255, 1) 100%);
    }

    .definitions ul li div {
        display: contents;
        font-size: smaller;
    }

    .definitions li:hover {
        background: #e9e9e9;
    }

    .definitions li.selected {
        background: rgb(255, 255, 177);
        background: linear-gradient(90deg, rgba(255, 255, 177, 1) 0%, rgba(255, 245, 0, 1) 100%);
    }

    .definitions li.match-correct {
        background: rgb(99, 168, 122);
        background: linear-gradient(90deg, rgba(99, 168, 122, 1) 0%, rgba(17, 101, 3, 1) 100%);
        color: white;
    }

    .terms ul li {
        align-items: center;
        border-radius: 50px 0 0 50px;
        text-align: center;
        background: rgb(249, 249, 249);
        background: linear-gradient(270deg, rgba(249, 249, 249, 1) 0%, rgba(214, 238, 255, 1) 100%);
    }

    .terms li:hover {
        background: #e9e9e9;
    }

    .terms li.selected {
        background: rgb(255, 255, 177);
        background: linear-gradient(270deg, rgba(255, 255, 177, 1) 0%, rgba(255, 245, 0, 1) 100%);
    }

    .terms li.match-correct {
        background: rgb(99, 168, 122);
        background: linear-gradient(270deg, rgba(99, 168, 122, 1) 0%, rgba(17, 101, 3, 1) 100%);
        color: white;
    }

    .terms ul li div {
        display: contents;
        font-size: smaller;
    }

    .game-container ul li.match-wrong {
        background: red;
        color: white;
    }

    .horizontal-shaking {
        animation: shake 150ms 2 linear;
        -moz-animation: shake 150ms 2 linear;
        -webkit-animation: shake 150ms 2 linear;
        -o-animation: shake 150ms 2 linear;
    }

    @keyframes shake {
        0% {
            transform: translate(3px, 0);
        }

        50% {
            transform: translate(-3px, 0);
        }

        100% {
            transform: translate(0, 0);
        }
    }

    @-moz-keyframes shake {
        0% {
            -moz-transform: translate(3px, 0);
        }

        50% {
            -moz-transform: translate(-3px, 0);
        }

        100% {
            -moz-transform: translate(0, 0);
        }
    }

    @-webkit-keyframes shake {
        0% {
            -webkit-transform: translate(3px, 0);
        }

        50% {
            -webkit-transform: translate(-3px, 0);
        }

        100% {
            -webkit-transform: translate(0, 0);
        }
    }

    @-ms-keyframes shake {
        0% {
            -ms-transform: translate(3px, 0);
        }

        50% {
            -ms-transform: translate(-3px, 0);
        }

        100% {
            -ms-transform: translate(0, 0);
        }
    }

    @-o-keyframes shake {
        0% {
            -o-transform: translate(3px, 0);
        }

        50% {
            -o-transform: translate(-3px, 0);
        }

        100% {
            -o-transform: translate(0, 0);
        }
    }
</style>