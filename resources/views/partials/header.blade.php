<!-- Header -->
<header class="bg-gray-900 text-white p-4 flex justify-between items-center">
    <!-- Logo -->
    <div class="flex items-center space-x-4" >
        <a href="/">
        <span class="font-bold text-lg">InnovaSoft</span>
        </a>
    </div>

    <!-- Menú de hamburguesa -->
    <button id="menu-toggle" class="md:hidden text-white focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
        </svg>
    </button>

    <!-- Menú (solo visible en pantallas grandes) -->
    <nav class="hidden md:flex items-center space-x-4">
        <!-- Barra de búsqueda -->
        <div class="relative text-black ">
            <!-- Campo de búsqueda -->
            <input 
                type="text" 
                id="search-input"
                placeholder="Buscar Tema..." 
                class="w-full p-2 border border-gray-300 rounded-lg pl-10"
                onkeyup="searchTheme()"
            >
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-3 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l-2 2m2-2a6 6 0 1112 0 6 6 0 01-12 0zm2-4h.01" />
            </svg>
        </div>
        
        <!-- Div para mostrar los resultados de la búsqueda -->
        <div id="search-results"></div>
        

        <!-- Botones -->
        <a href="/admin" class="bg-gray-800 text-white py-2 px-4 rounded-lg">Iniciar Sesión</a>
        <a href="/register" class="bg-gray-700 text-white py-2 px-4 rounded-lg">Registrarse</a>
    </nav>
</header>

<!-- Navbar que cubre toda la pantalla -->
<div id="fullscreen-menu" class="fixed inset-0 bg-gray-800 bg-opacity-130 z-50 hidden flex flex-col items-center pt-10">

    
    <div class="flex items-center space-x-4 mb-6">
        <span class="font-bold text-white text-lg">InnovaSoft</span>
    </div>

    <!-- Cerrar menú -->
    <button id="close-menu" class="absolute top-4 right-4 text-white text-3xl focus:outline-none">
        &times;
    </button>

    <!-- Contenido del menú -->
    <div class="text-center space-y-8 text-white">
        <!-- Barra de búsqueda -->
        <div class="relative">
            <input type="text" placeholder="Buscar Tema..." class="w-80 p-3 border border-gray-300 rounded-lg pl-10 text-black">
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-3 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l-2 2m2-2a6 6 0 1112 0 6 6 0 01-12 0zm2-4h.01" />
            </svg>
        </div>

        <!-- Botones -->
        <div class="flex justify-center space-x-4">
            <a href="/admin" class="bg-gray-700 py-3 px-6 rounded-lg text-white text-center">Iniciar Sesión</a>
            <a href="/register" class="bg-gray-600 py-3 px-6 rounded-lg text-white text-center">Registrarse</a>
        </div>
        
    </div>
</div>

<!-- Script -->
<script>
    const menuToggle = document.getElementById('menu-toggle');
    const fullscreenMenu = document.getElementById('fullscreen-menu');
    const closeMenu = document.getElementById('close-menu');

    // Mostrar menú
    menuToggle.addEventListener('click', () => {
        fullscreenMenu.classList.remove('hidden');
        fullscreenMenu.classList.add('flex');
    });

    // Ocultar menú
    closeMenu.addEventListener('click', () => {
        fullscreenMenu.classList.add('hidden');
        fullscreenMenu.classList.remove('flex');
    });

    function searchTheme() {
        const query = document.getElementById('search-input').value;

        // Realizar la solicitud AJAX para buscar los temas y subtemas
        fetch(`/search-temas?query=${query}`)
            .then(response => response.json())
            .then(data => {
                // Mostrar los resultados en el div
                const resultsDiv = document.getElementById('search-results');
                resultsDiv.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(result => {
                        const resultDiv = document.createElement('div');
                        resultDiv.classList.add('p-2', 'border', 'border-gray-300', 'mt-2', 'hover:bg-gray-100', 'cursor-pointer');

                        // Mostrar el nombre del tema o subtema
                        resultDiv.textContent = result.titulo;

                        // Enlace o acción para redirigir a la vista correspondiente
                        resultDiv.addEventListener('click', () => {
                            // Redirigir según si es un tema o un subtema
                            if (result.tema_id) {
                                window.location.href = `/temas/${result.tema_id}?subtema_id=${result.id}`;
                            } else {
                                window.location.href = `/temas/${result.id}`; // URL para tema
                            }
                        });

                        resultsDiv.appendChild(resultDiv);
                    });
                } else {
                    resultsDiv.innerHTML = '<p>No se encontraron temas ni subtemas.</p>';
                }
            })
            .catch(error => console.error('Error al buscar temas y subtemas:', error));
    }

</script>
