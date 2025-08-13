$(document).ready(function () {
  const id_sesion = $("#id_sesion").val();
  const id_usuario = $("#id_usuario").val();

  // Función para cargar mensajes
  function cargarMensajes() {
    $.post(
      "consultachat.php",
      {
        id_conv: id_sesion,
      },
      function (data) {
        $("#chat-panel").html(data);
        // Scroll automático al final
        $("#chat-panel").scrollTop($("#chat-panel")[0].scrollHeight);
      }
    ).fail(function () {
      console.error("Error al cargar mensajes");
    });
  }

  // Enviar mensaje
  $("#enviar").click(enviarMensaje);
  $("#mensaje").keypress(function (e) {
    if (e.which == 13) {
      // Tecla Enter
      enviarMensaje();
    }
  });

  function enviarMensaje() {
    const mensaje = $("#mensaje").val().trim();

    if (mensaje === "") return;

    $.post(
      "enviar_mensaje_s.php",
      {
        id_sesion: id_sesion,
        id_remitente: id_usuario,
        mensaje: mensaje,
      },
      function (response) {
        if (response.success) {
          $("#mensaje").val("");
          cargarMensajes();
        } else {
          console.error("Error al enviar:", response.error);
        }
      },
      "json"
    ).fail(function () {
      console.error("Error de conexión");
    });
  }

  // Actualizar mensajes cada 2 segundos
  setInterval(cargarMensajes, 2000);

  // Cargar mensajes al iniciar
  cargarMensajes();
});
