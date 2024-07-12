document.addEventListener('DOMContentLoaded', function() {
    const dashboardContainer = document.querySelector('.dashboard-container');
    const routes = JSON.parse(dashboardContainer.getAttribute('data-routes'));
    const menuToggleButton = document.getElementById('menu_toggle_button');
    const aside = document.querySelector('aside');
    const mainContent = document.querySelector('.main');
    const h5Elements = document.querySelectorAll('.sidebar a h5'); // Selecciona todos los h5 
                                                                   // dentro de los enlaces del sidebar

    // Función para obtener el estado guardado del sidebar
    function getSidebarState() {
        return localStorage.getItem('sidebarState') === 'closed';
    }

    // Función para guardar el estado del sidebar
    function saveSidebarState(state) {
        localStorage.setItem('sidebarState', state ? 'closed' : 'open');
    }

    // Inicializa el estado del sidebar según lo guardado en localStorage
    function initializeSidebarState() {
        const isClosed = getSidebarState();
        aside.classList.toggle('closed', isClosed);
        mainContent.classList.toggle('expanded', !isClosed);

        // Oculta los h5 si el sidebar está cerrado al inicio
        if (isClosed) {
            h5Elements.forEach(function(h5) {
                h5.classList.add('hidden');
            });
        }
    }

    // Carga el estado del sidebar al cargar la página
    initializeSidebarState();

    // Manejar el enlace de logout
    document.getElementById('logoutLink').addEventListener('click', function(event) {
        event.preventDefault(); // Prevenir la acción predeterminada del enlace
        document.getElementById('logoutForm').submit(); // Enviar el formulario
    });

    // Manejar la lista de opciones desplegable de Admin
    // Función para cerrar la lista desplegable si se hace clic fuera de ella
    document.addEventListener('click', function(event) {
        var userList = document.getElementById('userList');
        var idUserDivList = document.getElementById('idUserDivList');
        var isClickInsideOptions = userList.contains(event.target);
        var isClickInsideSelect = idUserDivList.contains(event.target);
    
        if (!isClickInsideOptions && !isClickInsideSelect) {
            userList.style.display = 'none';
        }
    });

    // Mostrar opciones de la lista con el id correspondiente
    window.toggleOptionsUser = function(id) {
        var options = document.getElementById(id);
        options.style.display = (options.style.display === 'block') ? 'none' : 'block';
    }

    // Colocar el valor de la opción en el input
    /*window.selectOptionDashboard = function(value) {
        var input = document.getElementById('idUserDivList').getElementsByTagName('input')[0];
        input.value = value;
        toggleOptionsUser('userList');
    }*/

    // Ir al enlace de la opción de la lista
    window.linkOption = function(value) {
        const route = routes[value];

        if (route) {
            window.location.href = route;
        } else {
            console.error('Ruta no encontrada para la opción:', value);
        }
    }

    // Manejar el botón de menú para abrir/cerrar el sidebar
    menuToggleButton.addEventListener('click', () => {
        const isClosed = aside.classList.toggle('closed');
        mainContent.classList.toggle('expanded', !isClosed);
        
        // Guarda el estado actual del sidebar en localStorage
        saveSidebarState(isClosed);
    
        // Cambia el ícono del botón de menú según el estado del sidebar
        if (isClosed) {
            menuToggleButton.innerHTML = '<span class="material-symbols-outlined">arrow_forward_ios</span>';
        } else {
            menuToggleButton.innerHTML = '<span class="material-symbols-outlined">arrow_back_ios</span>';
        }
    
        // Toggle para ocultar los h5 cuando se cierra el sidebar
        h5Elements.forEach(function(h5) {
            h5.classList.toggle('hidden', isClosed); // Agrega o quita la clase 'hidden'
        });
    });
});
