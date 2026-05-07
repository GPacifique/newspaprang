import './bootstrap';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
window.ClassicEditor = ClassicEditor;

// Only initialize CKEditor if editor exists
document.addEventListener('DOMContentLoaded', () => {
    const editorElement = document.querySelector('#editor');

    if (editorElement) {
        ClassicEditor
            .create(editorElement)
            .catch(error => {
                console.error(error);
            });
    }
});

Alpine.start();