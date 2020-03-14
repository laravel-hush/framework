window.functions = class functions {
    static initialize() {
        $('select').chosen({
            disable_search_threshold: 10
        });

        $('.custom-file-input').change(function () {
            if (this.files && this.files[0]) {
                var image = $(this).data('image-id');
                var reader = new FileReader();

                reader.onload = function (e) {
                    $(image).attr('src', e.target.result);
                }

                reader.readAsDataURL(this.files[0]);
            }
        });

        $('.codemirror').each(function () {
            var code = CodeMirror.fromTextArea(this, {
                lineNumbers: true,
                matchBrackets: true,
                mode: 'htmlmixed'
            });

            code.on('change', function () {
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
    }

    static initializeDeleter() {
        $('.delete-item').off('click').click(function (event) {
            event.preventDefault();

            var url = $(this).attr('href');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    functions.request('delete', url);
                }
            })
        });

    }

    static initializeInModal() {
        $('.in-modal').off('click').click(function (event) {
            event.preventDefault();
            functions.openDynamicModal($(this).attr('href'));
        });
    }

    static initializeSearch() {
        $('.search-button').off('click').click(function (event) {
            event.preventDefault();
            functions.openDynamicModal('/admin/search');
        });
    }

    static initializeSubmitter() {
        $('.submitable').off('submit').submit(function (event) {
            event.preventDefault();

            var form = $(this);
            var formData = new FormData(this);
            form.validate();

            form.find('.form-group').each(function () {
                $(this).removeClass('error')
                    .find('.validation-error')
                    .remove();
            });

            if (form.valid()) {
                functions.request(
                    form.prop('method'),
                    form.prop('action'),
                    formData,
                    function (response) {

                    },
                    function (xhr, status, error) {
                        if (xhr.status == 422) {
                            $.each(xhr.responseJSON.errors, function (index, value) {
                                form.find('[name="' + index + '"]')
                                    .closest('.form-group')
                                    .addClass('error')
                                    .append('<small class="validation-error">' + value + '</small>');
                            });
                        }
                    }
                );
            }
        });
    }

    static openDynamicModal(link) {
        $.get(link, function (response) {
            $('#modals').html(response);
            $('#dynamic-modal').modal();
            functions.initialize();
            functions.initializeSubmitter();
        });
    }

    static request(type, url, data = null, success = function () { }, error = function () { }) {
        $.ajax({
            type: type,
            url: url,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status != "success") {
                    functions.notify('An error occurred while executing the request', 'error');
                } else {
                    success(response);

                    if (response.notification) {
                        functions.notify(response.notification.text, response.notification.type);
                    } else if (response.swal) {
                        Swal.fire(
                            response.swal.title,
                            response.swal.text,
                            response.swal.type
                        ).then((result) => {
                            functions.processResponseRedirects(response);
                        })

                        return false;
                    }

                    functions.processResponseRedirects(response);
                }
            },
            error: function (xhr, status, error_obj) {
                error(xhr, status, error_obj);

                functions.notify(
                    xhr.responseJSON.message
                        ? xhr.responseJSON.message
                        : 'An error occurred while executing the request',
                    'error'
                );
            }
        });
    }

    static processResponseRedirects(response) {
        if (response.redirect) {
            window.location.href = response.redirect;
        } else if (response.reload) {
            location.reload();
        }
    }

    static notify(text, type = 'info', position = 'bottomRight') {
        new Noty({
            theme: 'metroui',
            type: type,
            layout: position,
            text: text,
            animation: {
                open: function (promise) {
                    var n = this;
                    var Timeline = new mojs.Timeline();
                    var body = new mojs.Html({
                        el: n.barDom,
                        x: { 500: 0, delay: 0, duration: 500, easing: 'elastic.out' },
                        isForce3d: true,
                        onComplete: function () {
                            promise(function (resolve) {
                                resolve();
                            })
                        }
                    });

                    var parent = new mojs.Shape({
                        parent: n.barDom,
                        width: 200,
                        height: n.barDom.getBoundingClientRect().height,
                        radius: 0,
                        x: { [150]: -150 },
                        duration: 1.2 * 500,
                        isShowStart: true
                    });

                    n.barDom.style['overflow'] = 'visible';
                    parent.el.style['overflow'] = 'hidden';

                    var burst = new mojs.Burst({
                        parent: parent.el,
                        count: 10,
                        top: n.barDom.getBoundingClientRect().height + 75,
                        degree: 90,
                        radius: 75,
                        angle: { [-90]: 40 },
                        children: {
                            fill: '#EBD761',
                            delay: 'stagger(500, -50)',
                            radius: 'rand(8, 25)',
                            direction: -1,
                            isSwirl: true
                        }
                    });

                    var fadeBurst = new mojs.Burst({
                        parent: parent.el,
                        count: 2,
                        degree: 0,
                        angle: 75,
                        radius: { 0: 100 },
                        top: '90%',
                        children: {
                            fill: '#EBD761',
                            pathScale: [.65, 1],
                            radius: 'rand(12, 15)',
                            direction: [-1, 1],
                            delay: .8 * 500,
                            isSwirl: true
                        }
                    });

                    Timeline.add(body, burst, fadeBurst, parent);
                    Timeline.play();
                },
                close: function (promise) {
                    var n = this;
                    new mojs.Html({
                        el: n.barDom,
                        x: { 0: 500, delay: 10, duration: 500, easing: 'cubic.out' },
                        skewY: { 0: 10, delay: 10, duration: 500, easing: 'cubic.out' },
                        isForce3d: true,
                        onComplete: function () {
                            promise(function (resolve) {
                                resolve();
                            })
                        }
                    }).play();
                }
            }
        }).show();
    }
}
