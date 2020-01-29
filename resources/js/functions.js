window.functions = class functions
{
    static initialize()
    {
        $('select').chosen({
            disable_search_threshold: 10
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

    static initializeSubmitter()
    {
        $('.submit').click(function (event) {
            event.preventDefault();

            var form = $(this).closest('form');
            form.validate();

            if (form.valid()) {
                functions.request(form.prop('method'), form.prop('action'), form.serialize(), function (response) {
                    console.log(response);
                });
            }
        });
    }

    static request(type, url, data, success)
    {
        $.ajax({
            type: type,
            url: url,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if (!response['success']) {
                    functions.notify(__('An error occurred while executing the request'), 'error');
                } else {
                    success(response);

                    if (response['notification']) {
                        functions.notify(response['notification']['text'], response['notification']['type']);
                    } else if (response['redirect']) {
                        window.location.href = response['redirect'];
                    } else if (response['reload']) {
                        location.reload();
                    }
                }
            },
        });
    }

    static notify(text, type = 'info', position = 'bottomRight')
    {
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