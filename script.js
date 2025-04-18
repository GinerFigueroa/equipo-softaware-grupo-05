document.addEventListener('DOMContentLoaded', function() {
    console.log('Blog cargado');
    
    // Menú toggle para móviles
    const sidebar = document.querySelector('.sidebar');
    const menuToggle = document.createElement('button');
    menuToggle.textContent = '☰ Menú';
    menuToggle.classList.add('menu-toggle');
    
    menuToggle.addEventListener('click', function() {
        sidebar.classList.toggle('active');
    });
    
    document.body.insertBefore(menuToggle, document.querySelector('.container'));
    
    // Estilos para el menú toggle
    const style = document.createElement('style');
    style.textContent = `
        .menu-toggle {
            display: none;
            padding: 10px 15px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 10px;
            font-size: 1rem;
            z-index: 1000;
            position: fixed;
            top: 10px;
            left: 10px;
        }
        
        @media (max-width: 768px) {
            .menu-toggle {
                display: block;
            }
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            .sidebar.active {
                transform: translateX(0);
            }
        }
    `;
    document.head.appendChild(style);
    
    // Efecto de carga para los posts
    const posts = document.querySelectorAll('.post');
    posts.forEach((post, index) => {
        setTimeout(() => {
            post.style.opacity = '1';
            post.style.transform = 'translateY(0)';
        }, index * 100);
    });
});


// Fuerza la altura de las imágenes después de cargar la página
document.addEventListener('DOMContentLoaded', function() {
    const postImages = document.querySelectorAll('.post img');
    postImages.forEach(img => {
        img.style.height = '500px';
        console.log('Altura de imagen ajustada a 500px'); // Para verificar en consola
    });
});