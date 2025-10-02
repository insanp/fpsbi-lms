<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Course Enrollment</h1>
    </div>
    <p class="mb-4">Enroll user / member baru ke dalam Course</p>
    <div class="card shadow mb-4 p-4">
        <?php
        helper('form');
        if (!empty($validation_errors)) {
            foreach ($validation_errors as $field => $error) {
                echo "<p style='color:red'>{$error}</p>";
            }
        }
        ?>
        <form id="enrollmentForm" method="post">
            <div class="form-group">
                <label for="course_id">Course:</label>
                <select class="form-control form-control-user" name="course_id" id="course_id">
                    <?php foreach ($courses as $course): ?>
                        <option value="<?= $course['id'] ?>"><?= $course['name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Search User Input -->
            <div class="form-group">
                <label for="user_search">Search User:</label>
                <input type="text" id="user_search" class="form-control form-control-user" placeholder="Enter member ID, name, or email">
                <!-- Auto-suggestion list -->
                <div id="suggestion-list" style="position:absolute; background: white; max-height:300px; overflow:auto; border:solid 1px; z-index:10;"></div>
            </div>

            <!-- User Enrollment Table -->
            <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="user_table" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="display:none;">ID</th>
                                        <th style="min-width:100px;">Member ID</th>
                                        <th style="min-width:100px;">Name</th>
                                        <th style="min-width:100px;">Email</th>
                                        <th style="min-width:100px;">Enroll At</th>
                                        <th style="min-width:100px;">Access Until</th>
                                        <th style="min-width:100px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                document.getElementById('user_search').addEventListener('input', function() {
                    let query = this.value;

                    if (query.length > 2) {
                        fetch(`<?= base_url('admin/users/search-suggestion?query=') ?>${encodeURIComponent(query)}`)
                            .then(response => response.text())
                            .then(data => {
                                document.getElementById('suggestion-list').innerHTML = data;
                            })
                            .catch(error => console.error('Error:', error));
                    } else {
                        document.getElementById('suggestion-list').innerHTML = ''; // Clear suggestions if query is too short
                    }
                });

                function selectUser(user) {
                    addUserToTable(user);
                    document.getElementById('suggestion-list').innerHTML = ''; // Clear suggestions after selection
                    document.getElementById('user_search').value = '';
                }

                function addUserToTable(user) {
                    // Helper function to set date to midnight at GMT+7
                    function toGMT7Midnight(date) {
                        // Adjust date to GMT+7 by subtracting the timezone offset and adding 7 hours
                        const gmt7Offset = 7 * 60; // 7 hours in minutes
                        const adjustedDate = new Date(date.getTime() + (gmt7Offset - date.getTimezoneOffset()) * 60 * 1000);

                        // Set hours, minutes, seconds, and milliseconds to midnight
                        adjustedDate.setUTCHours(0, 0, 0, 0);

                        // Format as "YYYY-MM-DDTHH:MM" for datetime-local input
                        return adjustedDate.toISOString().slice(0, 16);
                    }

                    // Set enroll_at to today's date at midnight GMT+7
                    const today = new Date();
                    const enrollAt = toGMT7Midnight(today);

                    // Set access_until to 45 days from today at midnight GMT+7
                    const accessUntilDate = new Date();
                    accessUntilDate.setDate(accessUntilDate.getDate() + 45);
                    const accessUntil = toGMT7Midnight(accessUntilDate);

                    const row = document.createElement('tr');
                    row.innerHTML = `
        <td style="display:none;"><input type="hidden" name="user_ids[]" value="${user.id}">${user.id}</td>
        <td>${user.member_id}</td>
        <td>${user.name}</td>
        <td>${user.email}</td>
        <td><input type="datetime-local" name="enroll_at[]" value="${enrollAt}"></td>
        <td><input type="datetime-local" name="access_until[]" value="${accessUntil}"></td>
        <td><button type="button" onclick="removeUser(this)">Remove</button></td>
    `;
                    document.getElementById('user_table').querySelector('tbody').appendChild(row);
                }

                function removeUser(button) {
                    button.closest('tr').remove();
                }

                document.getElementById('enrollmentForm').addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent default form action

                    const course_id = document.getElementById('course_id').value;
                    const user_ids = Array.from(document.querySelectorAll("input[name='user_ids[]']")).map(input => input.value);
                    const enroll_at = Array.from(document.querySelectorAll("input[name='enroll_at[]']")).map(input => input.value);
                    const access_until = Array.from(document.querySelectorAll("input[name='access_until[]']")).map(input => input.value);

                    const data = {
                        course_id: course_id,
                        user_ids: user_ids,
                        enroll_at: enroll_at,
                        access_until: access_until
                    };

                    fetch('<?= base_url('admin/course-enrollments/store') ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data && data.redirect) {
                                // Optionally show a quick message before redirecting
                                // Store a temporary message in session via server; server already saved flashdata.
                                window.location.href = data.redirect; // Redirect to index which will display results
                            } else if (data && data.message) {
                                alert(data.message);
                            } else {
                                alert('Unexpected response from server');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('An error occurred while processing enrollments.');
                        });
                });
            </script>


            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/bxmu5oqbbkulyn4fhs8j1u6gk1qy7hjgvrs0h5u5rfyen1l3/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<?= $this->endSection() ?>