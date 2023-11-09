$(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();

    function cb(start, end) {
        $('#reportrange span').html(start.format('DD MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
        $('#selectedStartDate').val(start.format('YYYY-MM-DD'));
        $('#selectedEndDate').val(end.format('YYYY-MM-DD'));
        fetchData(); // Panggil fungsi fetchData saat tanggal berubah
    }

    $('#reportrange').daterangepicker({
        startDate: start,
        endDate: end,
        ranges: {
            'Hari ini': [moment(), moment()],
            'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            '7 Hari yang lalu': [moment().subtract(6, 'days'), moment()],
            'Bulan ini': [moment().startOf('month'), moment().endOf('month')],
            'Sebulan yang lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(
                1, 'month').endOf('month')]
        }
    }, cb);

    cb(start, end);

    // Fungsi untuk mengirim permintaan AJAX
    function fetchData() {
        var startDate = $('#selectedStartDate').val();
        var endDate = $('#selectedEndDate').val();

        $.ajax({
            url: '/indeks-berita',
            method: 'GET',
            data: {
                start_date: startDate,
                end_date: endDate
            },
            success: function(data) {
                console.log(data);
            },
            error: function(xhr, status, error) {
                console.log("Terjadi kesalahan: " + error);
            }
        });
    }
});
