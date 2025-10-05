<?= $this->extend('member/layouts/main') ?>
<?= $this->section('content') ?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
    </div>
    <p class="mb-4">Edit profil saya</p>
    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-info" role="alert">
            <?= session()->getFlashdata('message') ?>
        </div>
    <?php endif; ?>
    <div class="card shadow mb-4 p-4">
        <?php
        helper('form');
        if (!empty($validation_errors)) {
            foreach ($validation_errors as $field => $error) {
                echo "<p style='color:red'>{$error}</p>";
            }
        }
        ?>
        <form action="<?= base_url('member/profile/update') ?>" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control form-control-user" name="email" placeholder="email" pattern="[^ @]*@[^ @]*" value="<?= old('email', $user['email']); ?>" readonly="readonly">
            </div>

            <div class="form-group">
                <label for="member ID">Nama:</label>
                <input type="text" class="form-control form-control-user" name="name" placeholder="nama" value="<?= old('name', $user['name']); ?>" readonly="readonly">
            </div>

            <div class="form-group">
                <label for="password">Password: <em style='color:red'>(Kosongkan saja bila tidak diubah)</em></label>
                <input type="password" class="custom-control custom-checkbox small" name="password" placeholder="Password" >
            </div>

            <div class="form-group">
                <label for="password confirm">Konfirmasi Password:</label>
                <input type="password" class="custom-control custom-checkbox small" name="password_confirm" placeholder="Konfirmasi Password">
            </div>

            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>

<!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/bxmu5oqbbkulyn4fhs8j1u6gk1qy7hjgvrs0h5u5rfyen1l3/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
    tinymce.init({
        selector: '#editor',
        plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [{
                value: 'First.Name',
                title: 'First Name'
            },
            {
                value: 'Email',
                title: 'Email'
            },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
    });
</script>
<?= $this->endSection() ?>