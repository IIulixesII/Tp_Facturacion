      <footer class="w-full bg-gradient-to-r from-slate-900 via-indigo-900 to-purple-900 text-white px-4 py-3 flex flex-wrap justify-between items-center text-xs shadow-inner backdrop-blur-sm">
        <div class="flex-shrink-0">
          <h2 class="font-bold text-sm">Luz y Servicios</h2>
          <p class="max-w-[180px] truncate">gestión de servicios eléctricos.</p>
        </div>
        <nav class="flex flex-wrap justify-center gap-x-3 gap-y-1 flex-grow text-white/80">
          <a href="mailto:contacto@luzyservicios.com" class="hover:text-green-300 transition-colors">Correo: <span class="font-semibold">contacto@luzyservicios.com</span></a>
          <a href="#" class="hover:text-pink-300 transition-colors">Contacto</a>
          <a href="#" class="hover:text-indigo-300 transition-colors">Acerca de</a>
          <a href="#" class="hover:text-blue-300 transition-colors">Términos y Condiciones</a>
          <a href="#" class="hover:text-purple-300 transition-colors">Política de Privacidad</a>
        </nav>
        <div class="text-white/70 text-[10px] whitespace-nowrap">
          © 2025 Luz y Servicios. Todos los derechos reservados.
        </div>
      </footer>

      <script>
        function handleCredentialResponse(response) {
          const base64Url = response.credential.split('.')[1];
          const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
          const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
          }).join(''));

          const userObject = JSON.parse(jsonPayload);

          // Rellenar email
          const emailInput = document.querySelector('input[name="email"]');
          if (emailInput) {
            emailInput.value = userObject.email;
          }

          // Rellenar nombreUsuario con la parte antes de @ del email
          const usernameInput = document.querySelector('input[name="nombreUsuario"]');
          if (usernameInput && userObject.email) {
            usernameInput.value = userObject.email.split('@')[0];
          }

          // Poner foco en contraseña
          const passwordInput = document.querySelector('input[name="password"]');
          if (passwordInput) {
            passwordInput.focus();
          }

          // Mostrar mensaje para que ingrese contraseña
          let pwdMsg = document.getElementById('pwd-message');
          if (!pwdMsg) {
            pwdMsg = document.createElement('p');
            pwdMsg.id = 'pwd-message';
            pwdMsg.className = 'text-sm text-red-600 mt-1';
            passwordInput.parentNode.appendChild(pwdMsg);
          }
          pwdMsg.textContent = 'Por favor ingrese su contraseña';
        }
      </script>

      </body>

      </html>