$(document).ready(function() {

    $('.loader').hide();

    $('#search').on('keyup', function() {
        // Memunculkan Loader
        $('.loader').show();

        // Eksekusi jQuery menggunakan load
        // $('#table').load('js/sumber.php?search=' + $('#search').val() );

        // Eksekusi jQuery menggunakan get
        $.get('js/sumber.php?search=' + $('#search').val(), function(data) {
            $('table').html(data);
            
            // Menghilangkan Loader
            $('.loader').hide();
        });
    });

});
