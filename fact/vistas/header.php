<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistema de Facturación de Luz</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen flex flex-col bg-[#1E293B] text-[#F1F5F9]">

  <header class="fixed top-0 left-0 w-full bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 text-white p-4 shadow-lg border-b border-indigo-700 backdrop-blur-sm z-50">
    <div class="container mx-auto flex flex-col md:flex-row md:justify-between md:items-center gap-4">
      <div class="flex items-center justify-between w-full">
        <a href="index.php" class="hover:text-blue-300 active:text-white visited:text-white transition duration-300 ease-in-out">
          <h1 class="text-2xl font-bold text-white drop-shadow-lg text-center md:text-left">Mi Sitio Web</h1>
        </a>
        <button id="menuButton" class="md:hidden text-white text-3xl focus:outline-none" aria-label="Abrir menú">☰</button>
      </div>

      <nav id="menu" class="hidden md:flex md:flex-row md:items-center space-x-16 text-base font-normal">
        <a href="index.php?ruta=registrar" class="text-white hover:text-blue-300 px-3 py-1 rounded whitespace-nowrap">Registrarse</a>
        <a href="index.php?ruta=iniciar" class="text-white hover:text-blue-300 px-3 py-1 rounded whitespace-nowrap">Iniciar Sesión</a>
        <a href="index.php?ruta=soporte" class="text-white hover:text-blue-300 px-3 py-1 rounded whitespace-nowrap">Soporte</a>
      </nav>

    </div>
  </header>

  <script>
    const menuButton = document.getElementById('menuButton');
    const menu = document.getElementById('menu');
    menuButton?.addEventListener('click', () => {
      menu.classList.toggle('hidden');
    });
  </script>

  <div class="h-20"></div>