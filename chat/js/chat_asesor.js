$(document).ready(function () {
  const idSesion = $("#id_conv").text().replace("ID: ", "");
  const idUsuario = $("#id_usuario").val();
  let chatFinalizado = false;
  let intervaloCarga = null;

  function actualizarListaConsultas() {
    $.ajax({
      url: "check_nuevos_pacientes.php",
      method: "GET",
      dataType: "json",
      success: function (data) {
        if (!data.nuevos) {
          $("#lista-consultas").html("<p>No hay consultas nuevas.</p>");
          return;
        }

        let html = "";
        data.pacientes.forEach(function (paciente) {
          html += `<div class="consulta-item" data-id="${paciente.id_sesion}">
                     Consulta #${paciente.id_sesion} - ${paciente.paciente}
                   </div>`;
        });
        $("#lista-consultas").html(html);
      },
      error: function () {
        $("#lista-consultas").html("<p>Error cargando consultas</p>");
      },
    });
  }

  function cargarMensajes() {
    if (chatFinalizado) return;

    $.ajax({
      url: "obtener_mensajes.php",
      method: "GET",
      data: { id_sesion: idSesion },
      dataType: "json",
      success: function (data) {
        if (data.chat_finalizado) {
          finalizarVista();
          return;
        }

        if (Array.isArray(data)) {
          $("#chat-panel").empty();
          data.forEach((mensaje) => {
            const claseMensaje =
              mensaje.fk_id_remitente == idUsuario
                ? "mensaje-propio"
                : "mensaje-otro";
            $("#chat-panel").append(
              `<div class="${claseMensaje}">
                <span class="nombre">${mensaje.nombre}:</span>
                <span class="texto">${mensaje.mensaje}</span>
                <span class="fecha">${mensaje.fecha_registro}</span>
              </div>`
            );
          });

          $("#chat-panel").animate(
            {
              scrollTop: $("#chat-panel")[0].scrollHeight,
            },
            400
          );
        } else {
          console.error("Respuesta inesperada del servidor:", data);
        }
      },
      error: function (err) {
        console.error("Error al obtener mensajes:", err);
      },
    });
  }

  function enviarMensaje() {
    if (chatFinalizado) return;

    const mensaje = $("#mensaje").val().trim();
    if (mensaje === "") return;

    $.post(
      "enviar_mensaje.php",
      {
        id_sesion: idSesion,
        id_remitente: idUsuario,
        mensaje: mensaje,
      },
      function () {
        $("#mensaje").val("");
        cargarMensajes();
      }
    );
  }

  function finalizarChat() {
    if (!confirm("¿Estás seguro de finalizar el chat?")) return;

    $.post("finalizar_chat.php", { id_sesion: idSesion }, function (respuesta) {
      if (respuesta.trim() === "ok") {
        alert("Chat finalizado.");
        finalizarVista();
        actualizarListaConsultas();
      } else {
        alert("Error al finalizar el chat: " + respuesta);
      }
    });
  }

  function finalizarVista() {
    chatFinalizado = true;
    clearInterval(intervaloCarga);

    $("#mensaje").prop("disabled", true);
    $("#enviar").prop("disabled", true);
    $("#finalizar-chat").prop("disabled", true);

    $("#chat-panel").append(
      `<div class="chat-finalizado">
        <span class="icono">&#x1F512;</span>
        <span>Este chat ha sido finalizado por el asesor.</span>
      </div>`
    );
  }

  $("#enviar").click(enviarMensaje);

  $("#mensaje").keypress(function (e) {
    if (e.which === 13 && !e.shiftKey) {
      e.preventDefault();
      enviarMensaje();
    }
  });

  $("#finalizar-chat").click(finalizarChat);

  cargarMensajes();
  intervaloCarga = setInterval(cargarMensajes, 3000);

  actualizarListaConsultas();

  $("#lista-consultas").on("click", ".consulta-item", function () {
    const nuevaSesionId = $(this).data("id");
    window.location.href = `chat_asesor.php?id=${nuevaSesionId}`;
  });
});
