document.addEventListener('DOMContentLoaded', function() {
    try {
        const indexItems = document.querySelectorAll('.index-item');
        
        if (indexItems.length === 0) {
            console.warn('No se encontraron elementos con clase .index-item');
            return;
        }
        
        indexItems.forEach(item => {
            item.addEventListener('click', function() {
                // Remover clase active de todos los items
                indexItems.forEach(i => i.classList.remove('active'));
                
                // Añadir clase active al item seleccionado
                this.classList.add('active');
                
                // Ocultar todas las secciones de contenido
                document.querySelectorAll('.content-section').forEach(section => {
                    section.classList.remove('active-section');
                });
                
                // Mostrar la sección correspondiente
                const targetId = this.getAttribute('data-target');
                const targetSection = document.getElementById(targetId);
                
                if (targetSection) {
                    targetSection.classList.add('active-section');
                } else {
                    console.error(`No se encontró la sección con ID: ${targetId}`);
                }
            });
        });
        
        // Activar el primer item por defecto
        indexItems[0].click();
    } catch (error) {
        console.error('Error al inicializar el índice interactivo:', error);
    }
});