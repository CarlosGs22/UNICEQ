function readURL(input) {

  if (input.files && input.files[0]) {



    var reader = new FileReader();



    reader.onload = function(e) {

      $('.image-upload-wrap').hide();



      $('.file-upload-image').attr('src', e.target.result);

      $('.file-upload-content').show();



      $('.image-title').html(input.files[0].name);

    };



    reader.readAsDataURL(input.files[0]);



  } else {

    removeUpload();

  }

}



function removeUpload() {

  $('.file-upload-input').replaceWith($('.file-upload-input').clone());

  $('.file-upload-content').hide();

  $('.image-upload-wrap').show();

}

$('.image-upload-wrap').bind('dragover', function () {

  $('.image-upload-wrap').addClass('image-dropping');

});

$('.image-upload-wrap').bind('dragleave', function () {

  $('.image-upload-wrap').removeClass('image-dropping');

});







var validacionInput = function(form) {
  var res = true;
  $('#' + form + ' input:text:visible').each(function() {
    if ($(this).val().trim().length === 0) {
      Swal.fire({
        icon: 'error',
        title: '',
        text: '' + $(this).attr("id") + ' no puede estar vacio',
      });
      res = false;
      return res;
    }
  });
  return res;
};



var validacionSelect = function(form) {

  var res = true;

  $('#' + form + ' select:visible').each(function() {

    if ($(this).val() === "0") {

      Swal.fire({

        icon: 'error',

        title: '',

        text: '' + $(this).attr("id") + ' no puede estar vacio',

      });

      res = false;

      return res;

    }

  });

  return res;

};


var validacionLenght = function(form) {
  var res = true;
  $('#' + form + ' input:text:visible').each(function() {
    if ($(this).val().trim().length > 254) {
      Swal.fire({
        icon: 'error',
        title: '',
        text: '' + $(this).attr("id") + ' no puede pasar de 255 caracteres',
      });
      res = false;
      return res;
    }
  });
  return res;
};



