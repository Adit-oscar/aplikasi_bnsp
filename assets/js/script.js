$(document).ready(function() {
  const flashData = $('.flash-data').data('flashdata');

  if (flashData !== '' & flashData !== undefined){
    Swal.fire({
      icon: 'success',
      title: 'Data Mahasiswa ' + flashData,
      text: '',
    })
  }
});