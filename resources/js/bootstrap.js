
const LOCALE = 'en';

window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')
        }
    });

    require('bootstrap');
    require('chosen-js');
    require('jquery-validation');
} catch (e) { }

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

require('codemirror/mode/htmlmixed/htmlmixed');
require('@fortawesome/fontawesome-free/js/all.js');

window.CodeMirror = require('codemirror/lib/codemirror');
window.moment = require('moment');
window.Noty = require('noty');
window.Mojs = require('@mojs/core');
window.slugify = require('slugify');
window.Swal = require('sweetalert2');

require('daterangepicker');

require('trumbowyg');
if (LOCALE != 'en') {
    require('trumbowyg/dist/langs/' + LOCALE + '.js');
}
require('trumbowyg/dist/plugins/cleanpaste/trumbowyg.cleanpaste.min.js');
require('trumbowyg/dist/plugins/colors/trumbowyg.colors.min.js');
require('trumbowyg/dist/plugins/emoji/trumbowyg.emoji.min.js');
require('trumbowyg/dist/plugins/fontfamily/trumbowyg.fontfamily.min.js');
require('trumbowyg/dist/plugins/fontsize/trumbowyg.fontsize.min.js');
require('trumbowyg/dist/plugins/table/trumbowyg.table.min.js');
require('trumbowyg/dist/plugins/upload/trumbowyg.upload.min.js');
