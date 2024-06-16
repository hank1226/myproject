import ClassicEditor from 'ckeditor';

document.addEventListener('DOMContentLoaded', function () {
    ClassicEditor
        .create(document.querySelector('#article-ckeditor'))
        .catch(error => {
            console.error(error);
        });
});
