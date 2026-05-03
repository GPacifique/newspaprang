import './bootstrap';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic'

window.ClassicEditor = ClassicEditor;
ClassicEditor
    .create(document.querySelector('#editor'));
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
