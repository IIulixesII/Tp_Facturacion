$(document).ready(function () {
    $("#btnImprimir").on("click", function () {
        var hiddenPath = $("#hiddenPath").val() || '';
        var nombrePersona = $("#nombrePersona").val() || 'Nombre no disponible';

        var data = new FormData();
        data.append("nombrePersona", nombrePersona); // solo enviamos lo necesario

        $.ajax({
            url: hiddenPath + "/ajax/hola_ajax.php",
            method: "POST",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                try {
                    var res = JSON.parse(response);
                    console.log("Respuesta del servidor:", res);

                    if (res.turnoCreado) {
                        alert("Turno creado para " + res.nombrePersona + ". Número: " + res.numeroTurno);
                        window.print(); // imprimir si fue exitoso
                    } else {
                        alert("No se pudo crear el turno.");
                    }

                } catch (e) {
                    console.error("Error al parsear JSON:", e);
                    alert("Respuesta inesperada del servidor.");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error en AJAX:", error);
                alert("No se pudo enviar el mensaje.");
            }
        });
    });
});
