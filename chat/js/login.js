$(document).ready(function () {
  $("#loguear").click(function (e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "login.php",
      data: {
        usuario: $("#usuario").val(),
        clave: $("#clave").val(),
        rol: $("#rol").val(),
      },
      success: function (data) {
        if (data.trim() === "Acceso permitido") {
          if ($("#rol").val() == 2) {
            window.location.href =
              "http://localhost/colectivo/PROYECTO INTEGRADOR/chat/create_sesion.php?paciente=" +
              $("#usuario").val();
          }
          if ($("#rol").val() == 1) {
            window.location.href =
              "http://localhost/colectivo/PROYECTO INTEGRADOR/chat/asesor.php?asesor=" +
              $("#usuario").val();
          }
          if ($("#rol").val() == 0) {
            window.location.href =
              "http://localhost/colectivo/PROYECTO INTEGRADOR/chat/admin.php?admin=" +
              $("#usuario").val();
          }
        } else {
          alert("Acceso dengado");
        }
      },
      error: function (xhr, status, error) {
        // Mostrar mensaje de error
        alert(xhr);
      },
    });
  });
});
