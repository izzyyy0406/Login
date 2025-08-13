$(document).ready(function () {
  $("#enviar").click(function (e) {
    e.preventDefault();

    const clave = $("#clave").val();
    const confirmar = $("#confirmar").val();

    // Validar coincidencia de contraseñas
    if (clave !== confirmar) {
      alert("Las contraseñas no coinciden");
      $("#confirmar").addClass("error-input");
      return; // Detener el proceso
    }

    // Resto del código AJAX...

    $("#enviar").click(function (e) {
      e.preventDefault();
      var nick = $("#nick").val();
      var correo = $("#correo").val();
      var identificacion = $("#identificacion").val();
      var nombres = $("#nombres").val();
      var apellidos = $("#apellidos").val();
      var celular = $("#celular").val();
      var clave = $("#clave").val();
      var confirmar = $("#confirmar").val();

      $.ajax({
        type: "POST",
        url: "procesar_registro.php", // Página que procesará los datos
        data: {
          nick: nick,
          correo: correo,
          identificacion: identificacion,
          nombres: nombres,
          apellidos: apellidos,
          celular: celular,
          clave: clave,
          confirmar: confirmar,
        },
        success: function (data) {
          console.log(data);
          // Puedes mostrar un mensaje de éxito o redirigir a otra página
          alert(data);
        },
        error: function (xhr, status, error) {
          // Puedes mostrar un mensaje de error
          alert(xhr.responseText);
        },
      });
    });
  });
});
