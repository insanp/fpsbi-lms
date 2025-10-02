<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Alumni</h1>
    </div>
    <p class="mb-4">Add new alumni manually</p>
    <div class="card shadow mb-4 p-4">
        <?php
        helper('form');
        if (!empty($validation_errors)) {
            foreach ($validation_errors as $field => $error) {
                echo "<p style='color:red'>{$error}</p>";
            }
        }
        ?>
        <form id="alumniForm" method="post">
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
                                        <th style="min-width:100px;">Created At (Alumnus Date)</th>
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
                    const today = new Date().toISOString().slice(0, 16);

                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td style="display:none;"><input type="hidden" name="user_ids[]" value="${user.id}">${user.id}</td>
                        <td>${user.member_id}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td><input type="datetime-local" name="created_at[]" value="${today}"></td>
                        <td><button type="button" onclick="removeUser(this)">Remove</button></td>
                    `;
                    document.getElementById('user_table').querySelector('tbody').appendChild(row);
                }

                function removeUser(button) {
                    button.closest('tr').remove();
                }

                document.getElementById('alumniForm').addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent default form action

                    const course_id = document.getElementById('course_id').value;
                    const user_ids = Array.from(document.querySelectorAll("input[name='user_ids[]']")).map(input => input.value);
                    const created_at = Array.from(document.querySelectorAll("input[name='created_at[]']")).map(input => input.value);

                    const data = {
                        course_id: course_id,
                        user_ids: user_ids,
                        created_at: created_at
                    };

                    fetch('<?= base_url('admin/alumni/store') ?>', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify(data)
                        })
                        .then(response => response.json())
                        .then(data => {
                            alert(data.message); // Notify user on success
                            document.getElementById('user_table').querySelector('tbody').innerHTML = ''; // Clear table after submission
                        })
                        .catch(error => console.error('Error:', error));
                });
            </script>

            <div class="form-group">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
