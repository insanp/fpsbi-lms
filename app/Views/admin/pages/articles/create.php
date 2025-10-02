<?= $this->extend('admin/layouts/main') ?>
<?= $this->section('content') ?>


<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Artikel</h1>
    </div>
    <p class="mb-4">Tambah artikel baru</p>
    <div class="card shadow mb-4 p-4">
        <?php
        if (!empty($validation_errors)) {
            foreach ($validation_errors as $field => $error) {
                echo "<p style='color:red'>{$error}</p>";
            }
        }
        ?>
        <form action="<?= base_url('admin/articles/store') ?>" method="post">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control form-control-user" name="title" placeholder="Judul" value="<?= old('title'); ?>">
            </div>

            <div class="form-group">
                <label for="resume">Resume:</label>
                <textarea name="resume" class="form-control form-control-user"><?= old('resume'); ?></textarea>
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="editor" name="content" class="form-control form-control-user"><?= old('content'); ?></textarea>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status">
                    <option value="draft" <?=(old('status') == 'draft') ? 'selected' : ''?>>Draft</option>
                    <option value="publish" <?=(old('status') == 'publish') ? 'selected' : ''?>>Publish</option>
                    <option value="delete" <?=(old('status') == 'delete') ? 'selected' : ''?>>Delete</option>
                </select>
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