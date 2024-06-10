$(document).ready(function () {
  // hilangkan tombol cari
  $("#tombol-cari").hide();
  // event ketika keyword ditulis
  $("#keyword").on("keyup", function () {
    // munculkan icon loading
    $(".load").show();

    // ajax menggunakan load
    // $("#container").load("ajax/ajax_movie.php?keyword=" + $("#keyword").val());

    $.get("ajax/ajax_movie.php?keyword=" + $("#keyword").val(), function (data) {
      $("#container").html(data);
      $(".load").hide();
    });
  });
});
