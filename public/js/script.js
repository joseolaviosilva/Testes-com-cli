document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const itemName = this.getAttribute('data-item-name');
            const confirmation = confirm(`Tem certeza que deseja excluir o item "${itemName}"?`);
            if (!confirmation) {
                event.preventDefault();
            }
        });
    });
});
