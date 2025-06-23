<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Sistema de Facturación de Luz</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
</head>
<body class="min-h-screen flex flex-col bg-slate-700 text-[#F1F5F9]">
<header class="fixed top-0 left-0 w-full bg-gradient-to-r from-blue-800 via-indigo-500 to-purple-400 text-white p-4 shadow-lg border-b border-indigo-700 backdrop-blur-sm z-50">
  <div class="container mx-auto flex flex-col md:flex-row md:justify-between md:items-center gap-4">
    <div class="flex items-center justify-between w-full">
      <a href="index.php" class="hover:text-blue-300 active:text-white visited:text-white transition duration-300 ease-in-out">
        <h1 class="text-2xl font-bold text-white drop-shadow-lg text-center md:text-left">Mi Sitio Web</h1>
      </a>
      <button id="menuButton" class="md:hidden text-white text-3xl focus:outline-none" aria-label="Abrir menú">☰</button>
    </div>

    <nav id="menu" class="hidden md:flex md:flex-row md:items-center space-x-16 text-base font-normal">
      <a href="index.php?ruta=registrar"
         class="text-white hover:text-blue-300 px-3 py-1 rounded whitespace-nowrap inline-flex flex-col items-center">
        <lottie-player
          src="/Tp_Facturacion-main/fact/icon/icon2.json"
          background="transparent"
          speed="1"
          style="width:24px; height:24px;"
          loop>
        </lottie-player>
        Registrar
      </a>

      <a href="index.php?ruta=iniciar"
         class="text-white hover:text-blue-300 px-3 py-1 rounded whitespace-nowrap inline-flex flex-col items-center">
        <lottie-player
          src="/Tp_Facturacion-main/fact/icon/icon.json"
          background="transparent"
          speed="1"
          style="width:24px; height:24px;"
          loop>
        </lottie-player>
        Factura
      </a>

      <a href="index.php?ruta=soporte"
         class="text-white hover:text-blue-300 px-3 py-1 rounded whitespace-nowrap inline-flex flex-col items-center">
        <lottie-player
          src="/Tp_Facturacion-main/fact/icon/icon3.json"
          background="transparent"
          speed="1"
          style="width:24px; height:24px;"
          loop>
        </lottie-player>
        Soporte
      </a>
    </nav>
  </div>
</header>

  <div class="h-20"></div>

  <script>
    const links = document.querySelectorAll('a.inline-flex');
    links.forEach(link => {
      const icon = link.querySelector('lottie-player');
      link.addEventListener('mouseenter', () => {
        icon.play();
      });
      link.addEventListener('mouseleave', () => {
        icon.stop();
      });
    });
  </script>

  <script>
    const menuButton = document.getElementById('menuButton');
    const menu = document.getElementById('menu');
    menuButton?.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>

</body>
</html>
