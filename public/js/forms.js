function handleFormErrors(json, form) {
  $('#' +form + ' .form-control').removeClass('is-invalid').addClass('is-valid');
  $('.error-tooltip').remove();
  $.each(json.errors, function (key, value) {
      if($('[name="' + key + '"]').parent().closest('div').attr('id')) {
          $('#'+key).append('<div id="' + key + '-error" class="error-tooltip text-danger">' + value + '</div>');
      } else {
          $('[name="' + key + '"]').removeClass('is-valid').addClass('is-invalid').parent().closest('div').append('<div id="' + key + '-error" class="error-tooltip invalid-feedback">' + value + '</div>');
      }

  });
  toastr.error('No ha completado algunos de los campos de manera correcta', 'Error');
}



function deleteRecord(texto, url, aditionals) {
  Swal.fire({
    title: "Eliminar registro",
    text: texto,
    type: "warning",
    showCancelButton: true,
    confirmButtonText: "Si, eliminar"
  }).then(function (result) {
    if (result.value) {
      var token = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        type: "POST",
        url: url,
        data: {
          _method: "delete",
          _token: token
        },
        success: function success(data) {
          if (aditionals) {
            if (aditionals === 'reload') {
              tableReload();
            } else {
              if (aditionals === 'removeFile') {
                $('#tr-' + id).remove();
                closeModal();
              } else {
                $('#tr-' + id).remove();
              }
            }

            toastr.success("Registro eliminado correctamente.");
            Swal.close();
          } else {
            location.reload();
          }
        },
        error: function error(data) {
          console.log(data.responseText);
          var obj = jQuery.parseJSON(data.responseText);

          if (obj.error) {
            toastr.error(obj.error);
            Swal.close();
          }
        }
      });
    } else {
      Swal.close();
    }
  });
}

function closeModal() {
  $('#remoteModal').modal('toggle');
}

function logout() {
  location.href = '/logout';
}

function getView(url, element) {
  $.get(url, function (data) {
    $(element).html(data);
  });
}

function loadModal(url) {
  $.get(url, function (data) {
    $('#remoteModal .modal-content').html(data);
  });
}
