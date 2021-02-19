$(document).ready(function () {
  $(".solutions__slider").owlCarousel({
    nav: true,
    loop: true,
    dots: true,
    responsive: {
      0: {
        items: 1
      },
      768: {
        items: 3
      }
    }
  });

  let inputs = document.querySelectorAll('.montage-form__input--file');
  Array.prototype.forEach.call(inputs, function (input) {
    let label = input.nextElementSibling,
      labelVal = label.querySelector('.montage-form__file-button-text').innerText;

    input.addEventListener('change', function (e) {
      let countFiles = '';
      if (this.files && this.files.length >= 1)
        countFiles = this.files.length;

      if (countFiles)
        label.querySelector('.montage-form__file-button-text').innerText = 'Файл выбран';
      else
        label.querySelector('.montage-form__file-button-text').innerText = labelVal;
    });
  });

  let callbackBtn = document.getElementsByClassName('callback-btn');
  callbackBtn = Array.prototype.slice.call(callbackBtn);

  let callbackBtnHeader = document.getElementsByClassName('callback-btn-header');
  callbackBtnHeader = Array.prototype.slice.call(callbackBtnHeader);

  let popup = document.getElementsByClassName('popup')
  popup = Array.prototype.slice.call(popup);

  let closeBtn = document.getElementsByClassName('close-btn');
  closeBtn = Array.prototype.slice.call(closeBtn);

  let popupCallbackMain = document.getElementsByClassName('popup-callback--main');
  let popupCallbackHeader = document.getElementsByClassName('popup-callback--header');
  let popupSuccess = document.getElementsByClassName('popup-success');

  let overlay = document.getElementsByClassName('overlay');

  callbackBtnHeader.forEach(function (item, i) {
    $(item).click(function () {
      $(overlay).fadeIn(300);
      setTimeout(function () {
        $(popupCallbackHeader).fadeIn(300);
      }, 300);
    });
  });

  callbackBtn.forEach(function (item, i) {
    $(item).click(function () {
      $(overlay).fadeIn(300);
      setTimeout(function () {
        $(popupCallbackMain).fadeIn(300);
      }, 300);
    });
  });

  closeBtn.forEach(function (item, i) {
    $(item).click(function () {
      $(popup).fadeOut(300);
      setTimeout(function () {
        $(overlay).fadeOut(300);
      }, 300);
    });
  })

  /*montage-form*/
  let montageForm = $('#montage-form-id');

  let telephoneMontageInput = document.getElementById('montage-form-tel-id');

  $(telephoneMontageInput).inputmask("+X (999) 999-9999", {
    definitions: {
      "X": {
        validator: "[7-9]",
      }
    },
    oncomplete: function(){
      $(this).val('+7' + $(this).val().substring(2));
    }
  });

  let nameMontageInput = document.getElementById('montage-form-name-id');

  montageForm.submit(function (ev) {
    let formData = new FormData();
    formData.append('file', document.getElementById('montage-form-file-id').files[0]);
    formData.append('d-name', document.getElementById('montage-form-name-id').value);
    formData.append('d-tel', document.getElementById('montage-form-tel-id').value);
    $.ajax({
      type: montageForm.attr('method'),
      url: montageForm.attr('action'),
      data: formData,
      processData: false,  // tell jQuery not to process the data
      contentType: false,  // tell jQuery not to set contentType
      success: function (data) {
        $(overlay).fadeIn(300);
        setTimeout(function () {
          $(popupSuccess).fadeIn(300);
          setTimeout(function () {
            $(popupSuccess).fadeOut(300);
            setTimeout(function () {
              $(overlay).fadeOut(300);
            }, 300);
          }, 2000);
        },300);
        $(telephoneMontageInput).val('');
        $(nameMontageInput).val('');
        ym(70924222,'reachGoal','order');
      }
    });
    ev.preventDefault();
  });
  /*/montage-form*/

  /*schema-form*/
  let schemaForm = $('#schema-form-id');

  let telephoneSchemaInput = document.getElementById('schema-form-tel-id');

  $(telephoneSchemaInput).inputmask("+X (999) 999-9999", {
    definitions: {
      "X": {
        validator: "[7-9]",
      }
    },
    oncomplete: function(){
      $(this).val('+7' + $(this).val().substring(2));
    }
  });

  let nameSchemaInput = document.getElementById('schema-form-name-id');
  let mailSchemaInput = document.getElementById('schema-form-mail-id');

  schemaForm.submit(function (ev) {
    $.ajax({
      type: schemaForm.attr('method'),
      url: schemaForm.attr('action'),
      data: schemaForm.serialize(),
      success: function (data) {
        $(overlay).fadeIn(300);
        setTimeout(function () {
          $(popupSuccess).fadeIn(300);
          setTimeout(function () {
            $(popupSuccess).fadeOut(300);
            setTimeout(function () {
              $(overlay).fadeOut(300);
            }, 300);
          }, 2000);
        },300);
        $(nameSchemaInput).val('');
        $(telephoneSchemaInput).val('');
        $(mailSchemaInput).val('');
        ym(70924222,'reachGoal','order');
      }
    });
    ev.preventDefault();
  });
  /*/schema-form*/

  /*question-form*/
  let questionForm = $('#question-form-id');

  let telephoneQuestionInput = document.getElementById('question-form-tel-id');

  $(telephoneQuestionInput).inputmask("+X (999) 999-9999", {
    definitions: {
      "X": {
        validator: "[7-9]",
      }
    },
    oncomplete: function(){
      $(this).val('+7' + $(this).val().substring(2));
    }
  });

  let nameQuestionInput = document.getElementById('question-form-name-id');

  questionForm.submit(function (ev) {
    $.ajax({
      type: questionForm.attr('method'),
      url: questionForm.attr('action'),
      data: questionForm.serialize(),
      success: function (data) {
        $(overlay).fadeIn(300);
        setTimeout(function () {
          $(popupSuccess).fadeIn(300);
          setTimeout(function () {
            $(popupSuccess).fadeOut(300);
            setTimeout(function () {
              $(overlay).fadeOut(300);
            }, 300);
          }, 2000);
        },300);
        $(nameQuestionInput).val('');
        $(telephoneQuestionInput).val('');
        ym(70924222,'reachGoal','order');
      }
    });
    ev.preventDefault();
  });
  /*/question-form*/

  /*popup-callback main*/
  let popupCallbackForm = $('#popup-callback-form-id');

  let telephonePopupInput = document.getElementById('popup-callback-tel-id');

  $(telephonePopupInput).inputmask("+X (999) 999-9999", {
    definitions: {
      "X": {
        validator: "[7-9]",
      }
    },
    oncomplete: function(){
      $(this).val('+7' + $(this).val().substring(2));
    }
  });

  let namePopupInput = document.getElementById('popup-callback-name-id');

  popupCallbackForm.submit(function (ev) {
    $.ajax({
      type: popupCallbackForm.attr('method'),
      url: popupCallbackForm.attr('action'),
      data: popupCallbackForm.serialize(),
      success: function (data) {
        $(popup).fadeOut(300);
        setTimeout(function () {
          $(popupSuccess).fadeIn(300);
          setTimeout(function () {
            $(popupSuccess).fadeOut(300);
            setTimeout(function () {
              $(overlay).fadeOut(300);
            }, 300);
          }, 2000);
        },300);
        $(namePopupInput).val('');
        $(telephonePopupInput).val('');
        ym(70924222,'reachGoal','order');
      }
    });
    ev.preventDefault();
  });
  /*/popup-callback main*/

  /*popup-callback header*/
  let popupCallbackFormHeader = $('#popup-callback-form-id--header');

  let telephonePopupInputHeader = document.getElementById('popup-callback-tel-id--header');

  $(telephonePopupInputHeader).inputmask("+X (999) 999-9999", {
    definitions: {
      "X": {
        validator: "[7-9]",
      }
    },
    oncomplete: function(){
      $(this).val('+7' + $(this).val().substring(2));
    }
  });

  let namePopupInputHeader = document.getElementById('popup-callback-name-id--header');

  popupCallbackFormHeader.submit(function (ev) {
    $.ajax({
      type: popupCallbackFormHeader.attr('method'),
      url: popupCallbackFormHeader.attr('action'),
      data: popupCallbackFormHeader.serialize(),
      success: function (data) {
        $(popup).fadeOut(300);
        setTimeout(function () {
          $(popupSuccess).fadeIn(300);
          setTimeout(function () {
            $(popupSuccess).fadeOut(300);
            setTimeout(function () {
              $(overlay).fadeOut(300);
            }, 300);
          }, 2000);
        },300);
        $(namePopupInputHeader).val('');
        $(telephonePopupInputHeader).val('');
        ym(70924222,'reachGoal','order');
      }
    });
    ev.preventDefault();
  });
  /*/popup-callback header*/

  /*form-calculate*/
  let allInfo = {
    floors: "не указано",
    width: "не указано",
    length: "не указано",
    fundament: "да",
    field: "не указан",
    city: "не указан"
  }
  /*stage-1*/
  let stage1Floors = document.getElementById('stage-1-floors-id');
  let stage1Width = document.getElementById('stage-1-width-id');
  let stage1Length = document.getElementById('stage-1-length-id')

  $('.stage-1__next-btn').click(function () {
    if ($(stage1Floors).val() !== '') {
      allInfo.floors = $(stage1Floors).val()
    } else {
      allInfo.floors = "не указано";
    }

    if ($(stage1Width).val() !== '') {
      allInfo.width = $(stage1Width).val()
    } else {
      allInfo.width = "не указано";
    }

    if ($(stage1Length).val() !== '') {
      allInfo.length = $(stage1Length).val()
    } else {
      allInfo.length = "не указано";
    }

    $('.stage-1').addClass('disable');
    $('.stage-2').removeClass('disable');
  });
  /*/stage-1*/

  /*stage-2*/
  $('.stage-2__mobile-container').click(function () {
    $('.stage-2__mobile-toggle').toggleClass('off');
    $('.stage-2__mobile-container').toggleClass('off');
    if (allInfo.fundament === "да") {
      allInfo.fundament = "нет";
    } else {
      allInfo.fundament = "да";
    }
  });

  $('.stage-2__radio-label--yes').click(function () {
    allInfo.fundament = "да";
  });

  $('.stage-2__radio-label--no').click(function () {
    allInfo.fundament = "нет";
  });

  let stage2Field = document.getElementById('stage-2-field-id');
  let stage2City = document.getElementById('stage-2-city-id');

  $('.stage-2__next-btn').click(function () {
    if ($(stage2Field).val() !== '') {
      allInfo.field = $(stage2Field).val()
    } else {
      allInfo.field = "не указан";
    }

    if ($(stage2City).val() !== '') {
      allInfo.city = $(stage2City).val()
    } else {
      allInfo.city = "не указан";
    }

    $('#hidden-floors-id').val(allInfo.floors);
    $('#hidden-width-id').val(allInfo.width);
    $('#hidden-length-id').val(allInfo.length);
    $('#hidden-fundament-id').val(allInfo.fundament);
    $('#hidden-field-id').val(allInfo.field);
    $('#hidden-city-id').val(allInfo.city);

    $('.stage-2').addClass('disable');
    $('.stage-3').removeClass('disable');
  });

  let stage3Form = $('#stage-3-form-id');

  let telephoneStage3Input = document.getElementById('stage-3-form-tel-id');

  $(telephoneStage3Input).inputmask("+X (999) 999-9999", {
    definitions: {
      "X": {
        validator: "[7-9]",
      }
    },
    oncomplete: function(){
      $(this).val('+7' + $(this).val().substring(2));
    }
  });

  stage3Form.submit(function (ev) {
    $.ajax({
      type: stage3Form.attr('method'),
      url: stage3Form.attr('action'),
      data: stage3Form.serialize(),
      success: function (data) {
        $(overlay).fadeIn(300);
        setTimeout(function () {
          $(popupSuccess).fadeIn(300);
          setTimeout(function () {
            $(popupSuccess).fadeOut(300);
            setTimeout(function () {
              $(overlay).fadeOut(300);
            }, 300);
          }, 2000);
        },300);
        $('#stage-3-form-name-id').val('');
        $('#stage-3-form-tel-id').val('');
        $('#hidden-floors-id').val('');
        $('#hidden-width-id').val('');
        $('#hidden-length-id').val('');
        $('#hidden-fundament-id').val('');
        $('#hidden-field-id').val('');
        $('#hidden-city-id').val('');
        $('.stage-3').addClass('disable');
        $('.stage-1').removeClass('disable');
        ym(70924222,'reachGoal','order');
      }
    });
    ev.preventDefault();
  });
  /*/stage-2*/
  /*открываем попап, если БС = оставить заявку*/
  let currentUrl = decodeURI(document.location.search);

  if (~(currentUrl.indexOf('callback-order'))) {
    $(overlay).fadeIn(300);
    setTimeout(function () {
      $(popupCallbackMain).fadeIn(300);
    }, 300);
  }
  /*/открываем попап, если БС = оставить заявку*/
});