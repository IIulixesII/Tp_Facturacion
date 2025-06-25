<?php
require_once 'includes/sesion.php';

$usuario = $_SESSION['usuario'] ?? null;
$rol = $usuario->rol ?? null;

// Si hay sesión activa y no hay ruta especificada, forzar cierre de sesión
if ($usuario && !isset($_GET['ruta'])) {
    header('Location: index.php?ruta=cerrar_sesion');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sistema de Facturación de Luz</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
  <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body class="min-h-screen flex flex-col bg-[#1E293B] text-[#F1F5F9]">

  <header class="fixed top-0 left-0 w-full bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 text-white p-4 shadow-lg z-50">
    <div class="container mx-auto flex flex-col md:flex-row md:justify-between md:items-center gap-4">
      <div class="flex items-center justify-between w-full">
        <a href="index.php" class="hover:text-blue-300 transition duration-300 ease-in-out">
          <h1 class="text-2xl font-bold text-white drop-shadow-lg text-center md:text-left">Fact Luz</h1>
        </a>
        <button id="menuButton" class="md:hidden text-white text-3xl focus:outline-none" aria-label="Abrir menú">☰</button>
      </div>

      <!-- Menú móvil -->
      <nav id="menu-mobile"
        class="md:hidden fixed top-[60px] left-0 right-0 bg-gradient-to-b from-slate-900 via-indigo-900 to-purple-900
                  p-4 max-h-[70vh] overflow-auto rounded-b-md z-50 flex flex-col space-y-2 hidden">
        <?php if (!$usuario): ?>
           <!-- Menú para visitantes -->
          <a href="index.php?ruta=registrar" class="block py-2 px-3 rounded hover:bg-indigo-700 transition text-white">
            <lottie-player src="/Tp_Facturacion/fact/icon/icon2.json" background="transparent" speed="1" style="width:24px; height:24px;" loop></lottie-player>
            Registrar
          </a>
          <a href="index.php?ruta=iniciar" class="block py-2 px-3 rounded hover:bg-indigo-700 transition text-white">
            <lottie-player src="/Tp_Facturacion/fact/icon/icon.json" background="transparent" speed="1" style="width:24px; height:24px;" loop></lottie-player>
            Iniciar Sesión
          </a>
          <a href="index.php?ruta=soporte" class="block py-2 px-3 rounded hover:bg-indigo-700 transition text-white">
            <lottie-player src="/Tp_Facturacion/fact/icon/icon3.json" background="transparent" speed="1" style="width:24px; height:24px;" loop></lottie-player>
            Soporte
          </a>
        <?php elseif ($rol === 'admin'): ?>
          <!-- Menú para admin -->
          <a href="index.php?ruta=administrar" class="block py-2 px-3 rounded hover:bg-indigo-700 transition text-white">Listas usuarios</a>
          <a href="index.php?ruta=agregar_usuario" class="block py-2 px-3 rounded hover:bg-indigo-700 transition text-white">Agregar usuario</a>
          <a href="index.php?ruta=ticket" class="block py-2 px-3 rounded hover:bg-indigo-700 transition text-white">Ticket</a>
          <a href="index.php?ruta=cerrar_sesion" class="block py-2 px-4 rounded-full bg-blue-800 hover:bg-blue-900 text-white font-semibold transition duration-200 text-center">Cerrar Sesión</a>
        <?php elseif ($rol === 'cajero'): ?>
          <!-- Menú para cajero -->
          <a href="#" class="block py-2 px-3 rounded hover:bg-indigo-700 transition text-white">Caja</a>
          <a href="index.php?ruta=cerrar_sesion" class="block py-2 px-4 rounded-full bg-blue-800 hover:bg-blue-900 text-white font-semibold transition duration-200 text-center">Cerrar Sesión</a>
        <?php elseif ($rol === 'cliente'): ?>
          <!-- Menú para cliente -->
          <a href="#" class="block py-2 px-3 rounded hover:bg-indigo-700 transition text-white">Inicio</a>
          <a href="#" class="block py-2 px-3 rounded hover:bg-indigo-700 transition text-white">Mi Perfil</a>
          <a href="index.php?ruta=cerrar_sesion" class="block py-2 px-4 rounded-full bg-blue-800 hover:bg-blue-900 text-white font-semibold transition duration-200 text-center">Cerrar Sesión</a>
        <?php endif; ?>
      </nav>

      <!-- Menú desktop -->
      <nav id="menu-desktop" class="hidden md:flex md:items-center md:space-x-6 text-base font-normal mt-4 md:mt-0 whitespace-nowrap">
        <?php if (!$usuario): ?>
          <!-- Menú para visitantes -->
          <a href="index.php?ruta=registrar" class="text-white hover:text-blue-300 px-3 py-1 rounded inline-flex flex-col items-center">
            <lottie-player src="/Tp_Facturacion/fact/icon/icon2.json" background="transparent" speed="1" style="width:24px; height:24px;" loop></lottie-player>
            Registrar
          </a>
          <a href="index.php?ruta=iniciar" class="text-white hover:text-blue-300 px-3 py-1 rounded inline-flex flex-col items-center">
            <lottie-player src="/Tp_Facturacion/fact/icon/icon.json" background="transparent" speed="1" style="width:24px; height:24px;" loop></lottie-player>
            Iniciar Sesión
          </a>
          <a href="index.php?ruta=soporte" class="text-white hover:text-blue-300 px-3 py-1 rounded inline-flex flex-col items-center">
            <lottie-player src="/Tp_Facturacion/fact/icon/icon3.json" background="transparent" speed="1" style="width:24px; height:24px;" loop></lottie-player>
            Soporte
          </a>
        <?php elseif ($rol === 'admin'): ?>
          <!-- Menú para admin -->
          <a href="index.php?ruta=administrar" class="text-white hover:text-blue-300 px-3 py-1 rounded">Listas usuarios</a>
          <a href="index.php?ruta=agregar_usuario" class="text-white hover:text-blue-300 px-3 py-1 rounded">Agregar usuario</a>
          <a href="index.php?ruta=ticket" class="text-white hover:text-blue-300 px-3 py-1 rounded">Ticket</a>
          <a href="index.php?ruta=cerrar_sesion" class="bg-blue-800 hover:bg-blue-900 text-white font-semibold px-4 py-2 rounded-lg transition duration-200">Cerrar Sesión</a>
        <?php elseif ($rol === 'cajero'): ?>
          <!-- Menú para cajero -->
          <a href="#" class="text-white hover:text-blue-300 px-3 py-1 rounded">Caja</a>
          <a href="index.php?ruta=cerrar_sesion" class="bg-blue-800 hover:bg-blue-900 text-white font-semibold px-4 py-2 rounded-lg transition duration-200">Cerrar Sesión</a>
        <?php elseif ($rol === 'cliente'): ?>
          <!-- Menú para cliente -->
          <a href="#" class="text-white hover:text-blue-300 px-3 py-1 rounded">Inicio</a>
          <a href="#" class="text-white hover:text-blue-300 px-3 py-1 rounded">Mi Perfil</a>
          <a href="index.php?ruta=cerrar_sesion" class="bg-blue-800 hover:bg-blue-900 text-white font-semibold px-4 py-2 rounded-lg transition duration-200">Cerrar Sesión</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>

  <script>
    const menuButton = document.getElementById("menuButton");
    const menuMobile = document.getElementById("menu-mobile");

    menuButton.addEventListener("click", () => {
      menuMobile.classList.toggle("hidden");
    });

    // Control animación Lottie solo en menú desktop
    const links = document.querySelectorAll('#menu-desktop a.inline-flex');
    links.forEach(link => {
      const icon = link.querySelector('lottie-player');
      if (!icon) return;
      link.addEventListener('mouseenter', () => icon.play());
      link.addEventListener('mouseleave', () => icon.stop());
    });
  </script>
