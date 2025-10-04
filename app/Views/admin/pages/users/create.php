<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
    </div>
    <p class="mb-4">Tambah user / member baru</p>
    <div class="card shadow mb-4 p-4">
        <?php
        helper('form');
        if (!empty($validation_errors)) {
            foreach ($validation_errors as $field => $error) {
                echo "<p style='color:red'>{$error}</p>";
            }
        }
        ?>
        <form action="<?= base_url('admin/users/store') ?>" method="post">
            <div class="form-group">
                <label for="member ID">Member ID:</label>
                <input type="text" class="form-control form-control-user" name="member_id" placeholder="DDDDDDDD" value="<?= old('member_id', $memberId); ?>" maxlength="8">
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control form-control-user" name="email" placeholder="email" pattern="[^ @]*@[^ @]*" value="<?= old('email'); ?>">
            </div>

            <div class="form-group">
                <label for="member ID">Nama:</label>
                <input type="text" class="form-control form-control-user" name="name" placeholder="nama" value="<?= old('name'); ?>">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="custom-control custom-checkbox small" name="password" placeholder="Password" >
            </div>

            <div class="form-group">
                <label for="password confirm">Konfirmasi Password:</label>
                <input type="password" class="custom-control custom-checkbox small" name="password_confirm" placeholder="Konfirmasi Password">
            </div>

            <div class="form-group">
                <label for="member ID">Aktif:</label>
                <input type="checkbox" class="custom-control custom-checkbox small" name="is_active" <?=set_checkbox('is_active', '1', old('is_active') == 1)?>>
            </div>

            <div class="form-group">
                <label for="member ID">Admin:</label>
                <input type="checkbox" class="custom-control custom-checkbox small" name="is_admin" <?=set_checkbox('is_admin', 'on', old('is_admin') == 1)?>>
            </div>

            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/bxmu5oqbbkulyn4fhs8j1u6gk1qy7hjgvrs0h5u5rfyen1l3/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<?= $this->endSection() ?>