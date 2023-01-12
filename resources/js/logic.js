function translate(key, replace = {}) {
  let translation = key.split('.').reduce((t, i) => t[i] || null, window.translations);

  for (var placeholder in replace) {
      translation = translation.replace(`:${placeholder}`, replace[placeholder]);
  }

  return translation;
}

$(document).ready(function() {  
  // will replace .form-g class when referenced
  var material_checkbox_with_delete = 
    '<div class="input-g row mb-3 mt-3"> '+
      '<div class="input-field col s12">' +
      `<label for="answer">${translate('temp.ans')}</label>` +
          '<input class="form-control mb-2 mt-2" name="answer[]" id="answer[]" type="text"/>' +
          '<input type="checkbox" name="checkbox[]" id="checkbox[]" class="mb-3 mt-3 mr-1 val"/>' +
          `<label for="checkbox" class="mr-3">${translate('temp.cor')}</label>` +
          `<span class="delete btn btn-sm btn-primary">${translate('temp.delete')}</span>` +
      '</div>'
    '</div>';

  var material_checkbox_without_delete = 
    '<div class="input-g row mb-3 mt-3"> '+
      '<div class="input-field col s12">' +
      `<label for="answer">${translate('temp.ans')}</label>` +
          '<input class="form-control mb-2 mt-2" name="answer[]" id="answer[]" type="text"/>' +
          '<input type="checkbox" name="checkbox[]" id="checkbox[]" class="mb-3 mt-3 mr-1 val"/>' +
          `<label for="checkbox" class="mr-3">${translate('temp.cor')}</label>` +
      '</div>'
    '</div>';

  var material_radio_with_delete = 
    '<div class="input-g row mb-3 mt-3"> '+
      '<div class="input-field col s12">' +
      `<label for="answer">${translate('temp.ans')}</label>` +
          '<input class="form-control mb-2 mt-2" name="answer[]" id="answer[]" type="text"/>' +
          '<input type="radio" name="checkbox[]" id="checkbox[]" class="mb-3 mt-3 mr-1 val"/>' +
          `<label for="checkbox" class="mr-3">${translate('temp.cor')}</label>` +
          `<span class="delete btn btn-sm btn-primary">${translate('temp.delete')}</span>` +
      '</div>'
    '</div>';

  var material_radio_without_delete = 
    '<div class="input-g row mb-3 mt-3"> '+
      '<div class="input-field col s12">' +
      `<label for="answer">${translate('temp.ans')}</label>` +
          '<input class="form-control mb-2 mt-2" name="answer[]" id="answer[]" type="text"/>' +
          '<input type="radio" name="checkbox[]" id="checkbox[]" class="mb-3 mt-3 mr-1 val"/>' +
          `<label for="checkbox" class="mr-3">${translate('temp.cor')}</label>` +
      '</div>'
    '</div>';

  var add_btn =
    `<span class="add-option btn btn-sm btn-primary">${translate('temp.newans')}</span>`;

  var material_text = 
  '<div class="row mb-3 mt-3"> '+
    '<div class="input-field col input-g s12">' +
        `<label for="answer">${translate('temp.ans')}</label>` +
        '<input class="form-control" name="answer[]" id="answer[]" type="text">' +
        '<input type="hidden" name="checkbox[]" id="checkbox[]" checked>'+
    '</div>'+
  '</div>';
  var cnt=-1;

  // for adding new option
  $(document).on('click',".add-option", function() {
    var selected_option = $('#question_type').find(":selected").val();
    if (selected_option === "checkbox") {
      $(".form-g").append(material_checkbox_with_delete);
      $(".val:last").prop('value', ++cnt);
    }
    if (selected_option === "radio") {
      $(".form-g").append(material_radio_with_delete);
      $(".val:last").prop('value', ++cnt);
    }
  });
  // for adding new option
  $(document).on('click',".delete", function() {
    $(".input-g:last").remove();
    cnt--;
  });
  // allow for more options if radio or checkbox is enabled
  $(".question_type").on('change', function() {
    var selected_option = $('#question_type').find(":selected").val();
    cnt = -1;
    if (selected_option === "checkbox") {
      $(".form-g").html(add_btn);
      $(".form-g").append(material_checkbox_without_delete);
      $(".val:last").prop('value', ++cnt);
      $(".form-g").append(material_checkbox_without_delete);
      $(".val:last").prop('value', ++cnt);
    } else if (selected_option === "radio") {
      $(".form-g").html(add_btn);
      $(".form-g").append(material_radio_without_delete);
      $(".val:last").prop('value', ++cnt);
      $(".form-g").append(material_radio_without_delete);
      $(".val:last").prop('value', ++cnt);
    } else {
      $(".form-g").html(material_text);
    }
  });

  $('.js-btn-delete').on("click", function(){
    confirm(translate('temp.message.sure'));
  })
});
