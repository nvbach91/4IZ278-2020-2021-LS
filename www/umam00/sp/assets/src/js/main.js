tinymce.init({
  selector: '#mytextarea',
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste code help wordcount',
    'image'

  ],
  toolbar: 'undo redo | formatselect | ' +
    'bold italic backcolor | alignleft aligncenter ' +
    'alignright alignjustify | bullist numlist outdent indent | ' +
    'removeformat | help |'
});

$('.burger-menu').on('click', function() {
  if ($(this).hasClass('on') || $(this).hasClass('off')) {
    $(this).toggleClass('on');
    $(this).toggleClass('off');
    $('.side-bar').toggleClass('slide-in');
    $('.side-bar').toggleClass('slide-out');
  }
  else {
    $(this).addClass('on');
    $('.side-bar').addClass('slide-in');
  }
});