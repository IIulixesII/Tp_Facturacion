<!-- Imagen grande con texto arriba de todo, solo en la página principal -->
<div class="relative w-full h-64 sm:h-96 bg-cover bg-center" style="background-image: url('fondo/larg.webp');">
  <div class="absolute inset-0 bg-[#0F172A]/70 flex items-center justify-center px-4">
    <h1 class="text-3xl sm:text-5xl font-extrabold font-serif text-white drop-shadow-md text-center leading-tight">
      Bienvenido al sistema de facturación de luz.
    </h1>
  </div>
</div>

<!-- Sección de Servicios -->
<div class="max-w-6xl mx-auto px-4 mt-12 grid grid-cols-2 md:grid-cols-4 gap-6">
  <!-- Atención al Cliente -->
  <div class="bg-[#0F172A] hover:bg-[#1E3A8A] text-[#F1F5F9] rounded-lg p-6 flex flex-col items-center text-center transition">
    <svg class="h-16 w-16 text-[#38BDF8] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M8 10h.01M12 10h.01M16 10h.01M9 16h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z" />
    </svg>
    <h3 class="text-xl font-semibold mb-2">Atención al Cliente</h3>
    <p class="text-gray-300">Estamos disponibles para ayudarte 24/7 con cualquier consulta.</p>
  </div>

  <!-- Pagos Rápidos -->
  <div class="bg-[#0F172A] hover:bg-[#1E3A8A] text-[#F1F5F9] rounded-lg p-6 flex flex-col items-center text-center transition">
    <svg class="h-16 w-16 text-[#FACC15] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M13 10V3L4 14h7v7l9-11h-7z" />
    </svg>
    <h3 class="text-xl font-semibold mb-2">Pagos Rápidos</h3>
    <p class="text-gray-300">Procesamos tus facturas al instante para mayor comodidad.</p>
  </div>

  <!-- Seguridad -->
  <div class="bg-[#0F172A] hover:bg-[#1E3A8A] text-[#F1F5F9] rounded-lg p-6 flex flex-col items-center text-center transition">
    <svg class="h-16 w-16 text-[#4ADE80] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M12 22s8-4 8-10V7l-8-4-8 4v5c0 6 8 10 8 10z" />
    </svg>
    <h3 class="text-xl font-semibold mb-2">Seguridad</h3>
    <p class="text-gray-300">Tus datos y pagos están protegidos con los mejores estándares.</p>
  </div>

  <!-- Reporte Detallado -->
  <div class="bg-[#0F172A] hover:bg-[#1E3A8A] text-[#F1F5F9] rounded-lg p-6 flex flex-col items-center text-center transition">
    <svg class="h-16 w-16 text-[#C084FC] mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M3 3v18h18M9 17v-6a2 2 0 014 0v6M13 9V7a2 2 0 014 0v2" />
    </svg>
    <h3 class="text-xl font-semibold mb-2">Reporte Detallado</h3>
    <p class="text-gray-300">Accede a informes claros y actualizados de tu consumo.</p>
  </div>
</div>

<!-- Sección de tarjetas informativas -->
<div class="max-w-5xl mx-auto px-4 mt-24 space-y-16">
  <!-- Tarjeta 1 -->
  <div class="flex flex-col md:flex-row bg-[#0F172A] hover:bg-[#1E3A8A] text-[#F1F5F9] shadow-xl rounded-xl overflow-hidden transform transition duration-700 ease-in-out hover:scale-[1.01] opacity-0 animate-fadeInUp">
    <img class="h-52 w-full object-cover md:w-56 md:h-auto" src="fondo/medidor.jpg" alt="Medidor eléctrico digital" />
    <div class="p-6">
      <div class="text-sm font-semibold tracking-wide text-[#7C3AED] uppercase">Tecnología moderna</div>
      <div class="mt-1 text-lg leading-tight font-medium">Medidores inteligentes de consumo</div>
      <p class="text-gray-300">Nuestros dispositivos permiten monitorear tu consumo en tiempo real, ayudándote a optimizar el uso de energía.</p>
    </div>
  </div>

  <!-- Tarjeta 3 -->
  <div class="flex flex-col md:flex-row bg-[#0F172A] hover:bg-[#1E3A8A] text-[#F1F5F9] shadow-xl rounded-xl overflow-hidden transform transition duration-700 ease-in-out hover:scale-[1.01] opacity-0 animate-fadeInUp delay-400">
    <img class="h-52 w-full object-cover md:w-56 md:h-auto" src="fondo/soporte.jpg" alt="Soporte técnico" />
    <div class="p-6">
      <div class="text-sm font-semibold tracking-wide text-[#7C3AED] uppercase">Soporte técnico</div>
      <div class="mt-1 text-lg leading-tight font-medium">Siempre listos para asistirte</div>
      <p class="text-gray-300">Nuestro equipo especializado te guía en cada paso, desde la instalación hasta la resolución de inconvenientes.</p>
    </div>
  </div>
  <!-- Tarjeta 2 -->
  <div class="flex flex-col md:flex-row bg-[#0F172A] hover:bg-[#1E3A8A] text-[#F1F5F9] shadow-xl rounded-xl overflow-hidden transform transition duration-700 ease-in-out hover:scale-[1.01] opacity-0 animate-fadeInUp delay-200">
    <img class="h-52 w-full object-cover md:w-56 md:h-auto" src="fondo/factura.webp" alt="Factura eléctrica" />
    <div class="p-6">
      <div class="text-sm font-semibold tracking-wide text-[#7C3AED] uppercase">Facturación transparente</div>
      <div class="mt-1 text-lg leading-tight font-medium">Detalles claros de tus consumos</div>
      <p class="text-gray-300">Cada factura incluye desglose detallado de cargos, tarifas y períodos de lectura para tu confianza.</p>
    </div>
  </div>

</div>

<!-- Espaciado final -->
<div class="h-20"></div>

<!-- Animación Tailwind personalizada -->
<style>
  @keyframes fadeInUp {
    0% {
      opacity: 0;
      transform: translateY(20px);
    }
    100% {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .animate-fadeInUp {
    animation: fadeInUp 1s ease forwards;
  }

  .delay-200 {
    animation-delay: 0.2s;
  }

  .delay-400 {
    animation-delay: 0.4s;

    
  }
 /* Si querés afectar todos los svg en la sección de servicios: */
.grid > div svg {
  height: 3rem;  /* 48px */
  width: 3rem;
}

/* Para que en móvil sean más chicos */
@media (max-width: 640px) {
  .grid > div svg {
    height: 2rem;
    width: 2rem;
  }
  .p{
       font-size: 1px;
  color: #333;
  margin-bottom: 1rem;
  }
}

  
  <style>
  @media (max-width: 640px) {
    /* Ajustar la altura de la imagen principal */
    .h-64 {
      height: 8rem;
    }

    /* Reducir el tamaño del texto del encabezado */
    .text-3xl {
      font-size: 1.25rem;
    }

    .sm\:text-5xl {
      font-size: 1.75rem !important;
    }

    /* Configurar la cuadrícula de servicios en una sola columna */
    .grid-cols-2 {
      grid-template-columns: 1fr !important;
    }

    /* Reducir el tamaño de los íconos */
    .h-16, .w-16 {
      height: 2rem;
      width: 2rem;
    }

    /* Ajustar el tamaño del título y la descripción */
    .text-xl {
      font-size: 0.9rem;
    }

    .text-gray-300 {
      font-size: 0.75rem;
    }

    /* Reducir el padding de los cuadros de servicios */
    .p-6 {
      padding: 0.75rem;
    }

    /* Ajustar las tarjetas informativas */
    .h-52 {
      height: 6rem;
    }

    .text-lg {
      font-size: 0.9rem;
    }

    .text-sm {
      font-size: 0.7rem;
    }

    .leading-tight {
      line-height: 1rem;
    }

    .md\:flex-row {
      flex-direction: column !important;
    }

    .md\:w-56 {
      width: 100% !important;
    }

    .md\:h-auto {
      height: auto !important;
    }
 

  }
</style>
