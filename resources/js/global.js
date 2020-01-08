$(document).ready(function () {
    $('select').chosen({
        disable_search_threshold: 10
    });

    $('.codemirror').each(function() {
        var code = CodeMirror.fromTextArea(this, {
            lineNumbers: true,
            matchBrackets: true,
            mode: 'htmlmixed'
        }); 
    
        code.on('change', function() {
            code.save(); 
        });
    });

    $.trumbowyg.svgPath = '/vendor/hush/svg/icons.svg';
    $('.wysiwyg').trumbowyg({
        lang: document.querySelector('html').lang,
        btns: [
            ['viewHTML'],
            ['undo', 'redo'],
            ['formatting', 'foreColor', 'backColor'],
            ['strong', 'em', 'del'],
            ['fontfamily', 'fontsize'],
            ['superscript', 'subscript'],
            ['link', 'emoji'],
            ['insertImage', 'upload'],
            ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
            ['unorderedList', 'orderedList'],
            ['table'],
            ['horizontalRule'],
            ['removeformat'],
            ['fullscreen']
        ],
        plugins: {
            upload: {
                serverPath: '/admin/upload/image',
            }
        }
    });

});