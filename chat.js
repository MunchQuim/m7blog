//script obtenido exclusivamente por chatgpt porque no es parte per se del ejercicio

    // Obtener el contexto 2D del canvas
    const canvas = document.getElementById('miCanvas');
    const ctx = canvas.getContext('2d');

    // Tamaño de cada cuadrado
    const squareSize = 16;

    // Función para generar un color aleatorio
    function generarColorAleatorio() {
        const r = Math.floor(Math.random() * 256);
        const g = Math.floor(Math.random() * 256);
        const b = Math.floor(Math.random() * 256);
        return `rgb(${r}, ${g}, ${b})`;
    }
    function ajustarTamañoCanvas() {
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
    }

    // Dibujar en el canvas
    function pintarCanvas() {
        const width = canvas.width;
        const height = canvas.height;

        // Recorrer el canvas en filas y columnas
        for (let x = 0; x < width; x += squareSize) {
            for (let y = 0; y < height; y += squareSize) {
                // Generar un color aleatorio para cada cuadrado
                const color = generarColorAleatorio();
                // Establecer el color de relleno
                ctx.fillStyle = color;
                // Dibujar el cuadrado en la posición (x, y)
                ctx.fillRect(x, y, squareSize, squareSize);
            }
        }
    }

// Ajustar el tamaño del canvas y pintarlo al inicio
ajustarTamañoCanvas();
pintarCanvas();

// Redibujar cuando se cambia el tamaño de la ventana
window.addEventListener('resize', () => {
    ajustarTamañoCanvas();
    pintarCanvas();
});

// Actualizar el canvas periódicamente
setInterval(pintarCanvas, 100);
