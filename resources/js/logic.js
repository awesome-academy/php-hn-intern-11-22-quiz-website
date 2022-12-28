$(document).ready(function() {  
  // will replace .form-g class when referenced
  var material = 
    '<div class="input-g row mb-3 mt-3"> '+
      '<div class="input-field col s12">' +
          '<label for="option_name">Answer</label>' +
          '<input class="form-control mb-3 mt-3" name="option_name" id="option_name" type="text">' +
          '<span class="delete btn btn-sm btn-primary">Delete</span>' +
      '</div>'
    '</div>';

  var add_btn =
    '<span class="add-option btn btn-sm btn-primary">Add New Answer</span>';

  var material_text = 
  '<div class="row mb-3 mt-3"> '+
    '<div class="input-field col input-g s12">' +
        '<label for="option_name">Answer</label>' +
        '<input class="form-control" name="option_name" id="option_name" type="text">' +
    '</div>'+
  '</div>';

  // for adding new option
  $(document).on('click',".add-option", function() {
    $(".form-g").append(material);
  });
  // for adding new option
  $(document).on('click',".delete", function() {
    $(".input-g:last").remove();
  });
  // allow for more options if radio or checkbox is enabled
  $(".question_type").on('change', function() {
    var selected_option = $('#question_type').find(":selected").val();
    if (selected_option === "checkbox" || selected_option === "radio") {
      $(".form-g").html(add_btn);
      $(".form-g").append(material);
    } else {
      $(".form-g").html(material_text);
    }
  });
});
