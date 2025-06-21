<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Gracias por tu consulta</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(to right, rgb(215, 185, 229), #f0fdf4);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .estrella {
            font-size: 2.5rem;
            color: #e5e7eb;
            cursor: pointer;
        }

        .estrella.seleccionada {
            color: #facc15;
        }
    </style>
</head>

<body>

    <div class="bg-white p-10 rounded-xl shadow-xl text-center max-w-xl w-full">
        <h2 class="text-2xl font-bold text-green-700 mb-4"> Consulta enviada con éxito, aguarde a ser atendido. </h2>
        <p class="text-gray-700 mb-6 text-lg">¡Gracias por contactarte con el sector de Soporte! Por favor, calificá tu
            experiencia:</p>

        
        <div id="estrellas" class="flex justify-center gap-2 mb-4">
            <span class="estrella" data-value="1">&#9733;</span>
            <span class="estrella" data-value="2">&#9733;</span>
            <span class="estrella" data-value="3">&#9733;</span>
            <span class="estrella" data-value="4">&#9733;</span>
            <span class="estrella" data-value="5">&#9733;</span>
        </div>

        <p id="valoracion" class="text-sm text-gray-600 mb-6"></p>

        <p class="text-gray-500 text-sm mb-6">Tu opinión es muy importante para nosotros.</p>
         <!-- ruta correspondiente a soporte- form -->
        <a href="../../index.php?ruta=soporte"
            class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-lg shadow-md transition">
            Volver al formulario
        </a>
    </div>

    <script>
        const estrellas = document.querySelectorAll('.estrella');
        const resultado = document.getElementById('valoracion');

        estrellas.forEach((estrella, index) => {
            estrella.addEventListener('click', () => {
                estrellas.forEach((e, i) => {
                    e.classList.toggle('seleccionada', i <= index);
                });
                resultado.textContent = `Valoraste con ${index + 1} estrella${index + 1 > 1 ? 's' : ''}.`;
            });
        });
    </script>

</body>

</html>