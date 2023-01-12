$(document).ready(function() {  
  // will replace .form-g class when referenced
  var material = 
    '<div class="input-g row mb-3 mt-3"> '+
      '<div class="input-field col s12">' +
          '<label for="answer">Answer</label>' +
          '<input class="form-control mb-2 mt-2" name="answer[]" id="answer[]" type="text"/>' +
          '<input type="checkbox" name="checkbox[]" id="checkbox[]" class="mb-3 mt-3 mr-1"/>' +
          '<label for="checkbox" class="mr-3">Correct</label>' +
          '<span class="delete btn btn-sm btn-primary">Delete</span>' +
      '</div>'
    '</div>';

  var add_btn =
    '<span class="add-option btn btn-sm btn-primary">Add New Answer</span>';

  var material_text = 
  '<div class="row mb-3 mt-3"> '+
    '<div class="input-field col input-g s12">' +
        '<label for="answer">Answer</label>' +
        '<input class="form-control" name="answer[]" id="answer[]" type="text">' +
        '<input type="hidden" name="checkbox[]" id="checkbox[]" value="checked"'+
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

  $('.js-btn-delete').on("click", function(){
    confirm('Are you sure?');
  });
});
