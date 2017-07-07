tinymce.init({
    selector: 'textarea.tinymce',
    min_height: 350,
    plugins: "table , link , lists , hr , paste , print , textcolor , code , emoticons , searchreplace , spellchecker",
    toolbar: "undo redo | styleselect | searchreplace spellchecker | bold italic | emoticons hr | link unlink | forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table | fontsizeselect"
});
$(document).ready(function(){
    $(".chosen-select").chosen({max_selected_options: 5});
});
