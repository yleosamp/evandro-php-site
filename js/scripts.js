// Adicione aqui os scripts globais necessários
//console.log('Script carregado');

document.addEventListener('DOMContentLoaded', function() {
    //console.log('DOM carregado');
    const menuToggle = document.getElementById('menu-toggle');
    const nav = document.getElementById('nav');
    if (menuToggle && nav) {
        menuToggle.addEventListener('click', () => {
            nav.classList.toggle('active');
        });
    }

    // Adicione este novo código
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            const dropdownId = this.getAttribute('data-dropdown');
            const dropdown = document.getElementById(dropdownId);
            
            // Fecha todos os outros dropdowns
            document.querySelectorAll('.absolute').forEach(d => {
                if (d.id !== dropdownId) {
                    d.classList.add('hidden');
                }
            });
            
            // Alterna a visibilidade do dropdown clicado
            dropdown.classList.toggle('hidden');
        });
    });

    // Fecha os dropdowns quando clicar fora deles
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.relative')) {
            document.querySelectorAll('.absolute').forEach(dropdown => {
                dropdown.classList.add('hidden');
            });
        }
    });
});

// Adicione esta função para debug
function toggleDropdown(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    if (dropdown) {
        dropdown.classList.toggle('hidden');
    } else {
        console.error('Dropdown não encontrado:', dropdownId);
    }
}
