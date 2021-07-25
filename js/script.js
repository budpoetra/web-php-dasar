// Ambil element's
let search = document.getElementById('search');
let table = document.getElementById('table');

// Event
search.addEventListener('keyup', function() {
    // Create AJaX Object
    let ajax = new XMLHttpRequest();

    // Cek Kesiapan AJaX
    ajax.onreadystatechange = function() {
        if ( ajax.readyState == 4 && ajax.status == 200 ) {
            table.innerHTML = ajax.responseText;
        }
    }

    // Execute AJaX
    ajax.open('GET', 'js/ajax/sumber.php?search=' + search.value, true);
    ajax.send();
});
