import Chart from 'chart.js/auto';
import Pusher from 'pusher-js';

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

$(document).ready(function () {
  var ctx = document.getElementById('barChart');
  const data = ctx.getAttribute('chart-data');
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          datasets: [{
              label: 'Quiz Created',
              data: JSON.parse(data),
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(255, 159, 64, 0.2)',
                  'rgba(255, 205, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(201, 203, 207, 0.2)',
                  'rgba(255, 205, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(201, 203, 207, 0.2)'
              ],
              borderColor: [
                  'rgb(255, 99, 132)',
                  'rgb(255, 159, 64)',
                  'rgb(255, 205, 86)',
                  'rgb(75, 192, 192)',
                  'rgb(54, 162, 235)',
                  'rgb(153, 102, 255)',
                  'rgb(201, 203, 207)',
                  'rgb(255, 205, 86)',
                  'rgb(75, 192, 192)',
                  'rgb(54, 162, 235)',
                  'rgb(153, 102, 255)',
                  'rgb(201, 203, 207)'
              ],
              borderWidth: 1
          }]
      },
      options: {
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
            y: {
                beginAtZero: false
            }
        }
    },
  });
});


$(document).ready(function () {
    Pusher.logToConsole = true;

    var pusher = new Pusher('b1c8b5fe5e36b86a8029', {
      cluster: 'ap1'
    });
    var channel = pusher.subscribe("my-channel-" + window.user);
    channel.bind("my-event", async function (data) {
        let pending = parseInt($("#notification").find(".pending").html());

        if (Number.isNaN(pending)) {
            $("#notification").append(
                '<span class="pending badge bg-primary badge-number">1</span>'
            );
        } else {
            $(".pending")
                .html(pending + 1);
        }
        let notificationBox = ` 
        <a href="/users/${data.id}">
        <li class="notification-box list" data-id="${data.notification_id}">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-12 box-noti">
                    <div>
                        ${translate('temp.creacc')} ${data.status}
                    </div>
                    <small class="box">${translate('temp.creacc')}</small>
                </div>
            </div>
        </li>
        </a>`;

        $(".show-notification").prepend(notificationBox);
    });

    $(document).on('click', '.show-notification', function () {
        let id = $('.notification-box').attr('data-id');
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: "/notification/read/" + id,
            success: function () {
                let pending = parseInt($("#notification").find(".pending").html());
                $("#notification")
                    .find(".pending")
                    .html(pending - 1);
            }
        });
    });
});
