<?php
require_once 'controlador/controlador_usuario.php';

$mensaje = '';
$exito = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resultado = UsuarioControlador::registrarUsuario($_POST);
    $mensaje = $resultado['mensaje'];
    $exito = $resultado['exito'];
}
?>

<!-- FORMULARIO DE REGISTRO -->

<div class="pt-9">
  <main>
    <div class="flex justify-center items-center px-4 py-16 min-h-screen">
      <div class="bg-white bg-opacity-95 rounded-3xl shadow-2xl max-w-3xl w-full p-10 md:p-16">
        <h2 class="text-3xl font-semibold text-gray-800 mb-10 text-center tracking-tight">
          Registrarse
        </h2>

        <?php if (!$exito && $mensaje): ?>
          <div class="mb-6"><?= $mensaje ?></div>
        <?php endif; ?>

        <div id="g_id_onload"
          data-client_id="928046862111-m56n0kkc7b6q0c4tl2ugeomsht4v1ca4.apps.googleusercontent.com"
          data-callback="handleCredentialResponse"
          data-auto_prompt="false">
        </div>

        <div class="g_id_signin mb-6"
          data-type="standard"
          data-shape="rectangular"
          data-theme="outline"
          data-text="signin_with"
          data-size="large"
          data-logo_alignment="left">
        </div>

        <form method="post" action="" class="grid grid-cols-1 md:grid-cols-2 gap-8 text-gray-800" id="formRegistro">
          <div>
            <label class="block mb-2 font-medium">Nombre de Usuario</label>
            <input type="text" name="nombreUsuario" pattern="[a-zA-Z0-9_]+" title="Solo letras, números y guiones bajos." required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
          </div>
          <div>
            <label class="block mb-2 font-medium">Nombre</label>
            <input type="text" name="nombre" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo letras y espacios." required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
          </div>
          <div>
            <label class="block mb-2 font-medium">Apellido</label>
            <input type="text" name="apellido" pattern="[A-Za-zÁÉÍÓÚáéíóúÑñ ]+" title="Solo letras y espacios." required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
          </div>
          <div>
            <label class="block mb-2 font-medium">Email</label>
            <input type="email" name="email" id="inputEmail" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
          </div>
          <div class="relative">
            <label class="block mb-2 font-medium">Contraseña</label>
            <input type="password" name="password" id="inputPassword" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
            <button type="button" id="togglePassword" class="absolute top-11 right-3 text-gray-500 hover:text-gray-700 focus:outline-none" aria-label="Mostrar u ocultar contraseña">
              <svg id="iconEyeClosed" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9-4-9-7s4-7 9-7a8.96 8.96 0 014.5 1.185M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3l18 18" />
              </svg>
              <svg id="iconEyeOpen" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
            </button>
          </div>
          <div>
            <label class="block mb-2 font-medium">Teléfono</label>
            <input type="tel" name="telefono" pattern="[0-9 +]+" title="Solo números, espacios o +" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
          </div>
          <div>
            <label class="block mb-2 font-medium">Fecha de Nacimiento</label>
            <input type="date" name="fecha_nacimiento" required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
          </div>
          <div>
            <label class="block mb-2 font-medium">DNI</label>
            <input type="text" name="dni" pattern="\d+" title="Solo números." required class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
          </div>
          <div class="md:col-span-2 text-center mt-6">
            <button type="submit" class="bg-indigo-600 text-white font-semibold px-12 py-3 rounded-lg shadow-md hover:bg-indigo-700">
              Continuar
            </button>
          </div>
        </form>
      </div>
    </div>
  </main>
</div>

<?php if ($exito): ?>
<!-- Modal éxito -->
<div id="modalExito" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
  <div class="bg-white rounded-lg p-6 max-w-sm w-full text-center shadow-lg">
    <div class="text-green-600 mb-4">
      <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
      </svg>
    </div>
    <p class="mb-6 font-semibold text-lg text-black"><?= htmlspecialchars($mensaje) ?></p>
    <button id="btnAceptar" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg">
      Aceptar
    </button>
  </div>
</div>
<?php endif; ?>

<script>
  const togglePassword = document.getElementById('togglePassword');
  const passwordInput = document.getElementById('inputPassword');
  const iconEyeClosed = document.getElementById('iconEyeClosed');
  const iconEyeOpen = document.getElementById('iconEyeOpen');

  togglePassword.addEventListener('click', () => {
    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);
    iconEyeClosed.classList.toggle('hidden', type !== 'password');
    iconEyeOpen.classList.toggle('hidden', type === 'password');
  });

  function handleCredentialResponse(response) {
    const base64Url = response.credential.split('.')[1];
    const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    const jsonPayload = decodeURIComponent(atob(base64).split('').map(c =>
      '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2)
    ).join(''));
    const userObject = JSON.parse(jsonPayload);

    const emailInput = document.querySelector('input[name="email"]');
    if (emailInput) emailInput.value = userObject.email;

    const usernameInput = document.querySelector('input[name="nombreUsuario"]');
    if (usernameInput && userObject.email) {
      usernameInput.value = userObject.email.split('@')[0];
    }

    passwordInput.focus();
  }

  <?php if ($exito): ?>
  document.getElementById('btnAceptar').addEventListener('click', () => {
    window.location.href = 'index.php?ruta=iniciar';
  });
  <?php endif; ?>
</script>
