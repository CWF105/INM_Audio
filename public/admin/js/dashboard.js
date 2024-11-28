document.querySelector('.dropdown-button').addEventListener('click', function () {
    const menu = document.querySelector('.dropdown-menu');
    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
});

function updateSales(option) {
    document.getElementById('sales-display').innerText = option;
    document.querySelector('.dropdown-menu').style.display = 'none'; // Close menu
}


