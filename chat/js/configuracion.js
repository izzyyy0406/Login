$(document).ready(function () {
  // Guardar configuración
  $("#config-form").on("submit", function (e) {
    e.preventDefault();
    const sesiones = $("#max_sesiones").val();
    const inactividad = $("#inactividad").val();

    alert(
      `Configuración guardada:\n- Máx sesiones: ${sesiones}\n- Inactividad: ${inactividad} min`
    );
    // Aquí podrías hacer un POST a un archivo PHP para guardar realmente en la BD si es necesario
  });

  // Activar / Suspender usuario
  $("#tabla-moderacion").on("click", ".suspender, .activar", function () {
    const row = $(this).closest("tr");
    const userId = row.data("userid");
    const accion = $(this).hasClass("suspender") ? "suspender" : "activar";

    $.ajax({
      url: "actualizar_estado.php",
      method: "POST",
      data: { id: userId, accion: accion },
      success: function (response) {
        alert(response);
        // Refrescar la tabla localmente
        const nuevoEstado = accion === "suspender" ? "inactivo" : "activo";
        row.find(".estado").text(nuevoEstado);
        row
          .find("button")
          .removeClass("suspender activar")
          .addClass(accion === "suspender" ? "activar" : "suspender")
          .text(accion === "suspender" ? "Reactivar" : "Suspender");
      },
      error: function (xhr) {
        alert("Error al actualizar: " + xhr.responseText);
      },
    });
  });
});
