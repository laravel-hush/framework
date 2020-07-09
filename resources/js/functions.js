window.functions = class functions {
  static initialize() {
    $('select').chosen({
      disable_search_threshold: 10,
      no_results_text: __.oops_nothing_found,
    });

    $('.sluggable').change(function () {
      var target = $($(this).data('slugify-target'));
      target.val(slugify($(this).val(), {
        lower: true,
        strict: true
      }));
    });

    $('.multilingual-selector').change(async function () {
      let block = $(this).closest('.multilingual-input, .multilingual-textarea');
      block.find('input, textarea, .trumbowyg-box').each(function () {
        $(this).removeClass('d-block');
        $(this).addClass('d-none');
      });

      let input = block.find('[name="' + $(this).val() + '"]');
      input.removeClass('d-none');
      input.addClass('d-block');
      let wysiwyg = input.closest('.trumbowyg-box');
      if (wysiwyg) {
        wysiwyg.removeClass('d-none');
        wysiwyg.addClass('d-block');
      }
    });

    $('.check-td input[type="checkbox"]').change(function () {
      if ($(this).attr('name') == 'all-checker') {
        var is_checked = $(this).prop('checked');
        $(this).closest('table')
          .find('.check-td input[type="checkbox"]')
          .each(function () {
            $(this).prop('checked', is_checked);
          });
      }

      let block = $(this).closest('.block').find('.multiple-actions-block');
      if ($('.check-td input[type="checkbox"]:checked').length > 0) {
        block.show();
      } else {
        block.hide();
      }
    });

    $('.multiple-actions-block a').click(function (event) {
      event.preventDefault();

      var type = $(this).data('request_type');
      var url = $(this).attr('href');
      var data = $(this).closest('.block').find('form').serialize();
      url = url + "&" + data;

      if ($(this).hasClass('with-confirmation')) {
        Swal.fire({
          title: __.are_you_sure,
          text: __.you_wont_be_able_to_revert,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: __.yes,
          cancelButtonText: __.cancel,
        }).then((result) => {
          if (result.value) {
            functions.request(type, url);
          }
        })
      } else {
        functions.request(type, url);
      }
    });

    $('.custom-file-input:not(.multiple)').off('change').change(function () {
      if (this.files && this.files[0]) {
        var image = $(this).data('image-id');
        var reader = new FileReader();

        reader.onload = function (e) {
          $(image).attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
      }
    });

    $('.custom-file-input.multiple').off('change').change(function () {
      if (this.files && this.files.length) {
        var image_block = $(this).data('image-block-id');
        $(image_block).html("");

        for (let i = 0; i < this.files.length; i++) {
          const file = this.files[i];
          var reader = new FileReader();

          reader.onload = function (event) {
            $(image_block).append(`<div class="col-1 pb-3"><img src="${event.target.result}" alt=""></div>`);
          }

          reader.readAsDataURL(file);
        }
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

    moment.locale(document.querySelector('html').lang);
    $('input.date').daterangepicker({
      locale: {
        format: 'YYYY-MM-DD'
      },
      singleDatePicker: true,
    });
    $('input.datetime').daterangepicker({
      locale: {
        format: 'YYYY-MM-DD HH:mm'
      },
      singleDatePicker: true,
      timePicker: true,
      timePicker24Hour: true,
    });
    $('input.daterange').daterangepicker({
      locale: {
        format: 'YYYY-MM-DD'
      },
    });
    $('input.datetimerange').daterangepicker({
      locale: {
        format: 'YYYY-MM-DD HH:mm'
      },
      timePicker: true,
      timePicker24Hour: true,
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
        title: __.are_you_sure,
        text: __.you_wont_be_able_to_revert,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: __.yes_delete_it,
        cancelButtonText: __.cancel,
      }).then((result) => {
        if (result.value) {
          functions.request('delete', url);
        }
      })
    });
  }

  static initializeDropdowns() {
    $(document).on("click", function (event) {
      if (!$(event.target).closest("[data-dropdown]").length && !$(event.target).closest(".dropdown-menu").length) {
        $('[data-dropdown]').removeClass('dropped');
        $(".dropdown-menu").slideUp("fast");
      }
    });

    $('[data-dropdown]').click(function (event) {
      event.preventDefault();
      let dropdown = $($(this).data('dropdown'));
      $(".dropdown-menu:not(#" + dropdown.attr("id") + ")").slideUp("fast");
      if (dropdown.css('display') == 'block') {
        dropdown.slideUp('fast');
        $(this).removeClass('dropped');
        return false;
      }

      let offsetLeft = 0;
      if (dropdown.hasClass('dropdown-align-left')) {
        offsetLeft = $(this).offset().left;
      } else if (dropdown.hasClass('dropdown-align-right')) {
        offsetLeft = $(this).offset().left + $(this).outerWidth() - dropdown.outerWidth();
      } else {
        offsetLeft = $(this).offset().left + $(this).outerWidth() / 2 - dropdown.outerWidth() / 2;
      }

      if ((offsetLeft + dropdown.outerWidth() / 2) > $(document).width()) {
        offsetLeft = $(document).width() - dropdown.outerWidth();
      }

      if (offsetLeft < 0) {
        offsetLeft = 0;
      }

      dropdown.css('position', 'absolute');
      dropdown.css('top', $(this).offset().top + $(this).outerHeight()
        + (dropdown.hasClass('no-margin') ? 0 : 5));
      dropdown.css('left', offsetLeft);
      $(this).addClass('dropped');
      dropdown.slideDown("fast");

      return true;
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
            // someactions
          },
          function (xhr, status, error) {
            if (xhr.status == 422) {
              $.each(xhr.responseJSON.errors, function (index, value) {

                if (index.indexOf('.') !== -1) {
                  let parts = index.split('.');
                  index = parts[0];
                  for (let i = 0; i < parts.length; i++) {
                    let part = parts[i];
                    index += i !== 0 ? `[${part}]` : "";
                  }
                }

                let element = form.find(`[name="${index}"]`);
                if (!element || !element.length) {
                  element = form.find(`[name="${index}[]"]`);
                }
                
                element
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

  static async openDynamicModal(link) {
    await $.get(link, function (response) {
      $('#modals').html(response);
      $('#dynamic-modal').modal();
      functions.initialize();
      functions.initializeSubmitter();
    });
  }

  static request(type, url, data = null, success = function () {}, error = function () {}) {
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
          xhr.responseJSON.message ?
          xhr.responseJSON.message :
          __.an_error_has_occured,
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
            x: {
              500: 0,
              delay: 0,
              duration: 500,
              easing: 'elastic.out'
            },
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
            x: {
              [150]: -150
            },
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
            angle: {
              [-90]: 40
            },
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
            radius: {
              0: 100
            },
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
            x: {
              0: 500,
              delay: 10,
              duration: 500,
              easing: 'cubic.out'
            },
            skewY: {
              0: 10,
              delay: 10,
              duration: 500,
              easing: 'cubic.out'
            },
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
