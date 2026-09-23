const currentUrl = window.location.href.split("/").pop();
const menuOpciones = document.querySelector("#menuOpciones");

function activarMenu(menuElement) {
    if (!menuElement) return;
    const links = menuElement.querySelectorAll('a[href]');

    links.forEach(link => {
        const linkHref = link.getAttribute('href');
        const li = link.closest("li");

        // Si el enlace corresponde a la URL actual, lo activamos
        if (linkHref === currentUrl) {
            // Activamos el enlace actual
            if (li) {
                li.classList.add("active");
            }

            // Abrimos todos los ancestros hasta el menú principal
            let parent = li?.parentElement;
            while (parent && parent !== menuOpciones) {
                if (parent.classList.contains("menu-sub")) {
                    const parentItem = parent.closest("li.menu-item");
                    if (parentItem) {
                        // Verificar si el submenú ya está abierto, si no, lo abrimos
                        if (!parentItem.classList.contains("open")) {
                            parentItem.classList.add("open"); // Se agrega la clase para abrir el submenú
                        }
                    }
                }
                parent = parent.parentElement;
            }
        } else {
            // Aseguramos que el ítem que no corresponde a la URL actual se cierre correctamente
            const subMenu = li.querySelector('.menu-sub');
            if (subMenu) {
                li.classList.remove('open'); // Se cierra el submenú
            }
        }
    });
}

activarMenu(menuOpciones);

