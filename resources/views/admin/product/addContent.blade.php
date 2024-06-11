<style>
    /* 這裡可改長和寬 */
    #container {
        width: 1000px;
        margin: 20px auto;
    }

    .ck-editor__editable[role="textbox"] {
        /* Editing area */
        min-height: 200px;
    }

    .ck-content .image {
        /* Block images */
        max-width: 80%;
        margin: 20px auto;
    }
</style>
<div id="container">
    <!-- <div id="editor"> -->
    <textarea name="content" id="editor"></textarea>
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/super-build/ckeditor.js"></script>
<script src="/js/admin/editor.js"></script>