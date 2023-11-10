$(function() {
    var start = moment().subtract(29, 'days');
    var end = moment();
    // init date
    $('#reportrange span').html(start.format('DD MMMM, YYYY') + ' - ' + end.format('D MMMM, YYYY'));
    $('#selectedStartDate').val(start.format('YYYY-MM-DD'));
    $('#selectedEndDate').val(end.format('YYYY-MM-DD'));
    
    function getParameterByName(name, url = window.location.href) {
        name = name.replace(/[\[\]]/g, '\\$&');
        var regex = new RegExp('[?&]' + name + '(=([^&#]*)|&|#|$)'),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, ' '));
    }

    if(getParameterByName('start_date')!=null)
    {
        console.log('has date')
        $('#reportrange span').html(moment(getParameterByName('start_date')).format('DD MMMM, YYYY') + ' - ' + moment(getParameterByName('end_date')).format('D MMMM, YYYY'));
        $('#selectedStartDate').val(getParameterByName('start_date'));
        $('#selectedEndDate').val(getParameterByName('end_date'));
    }
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

    // Fungsi untuk mengirim permintaan AJAX
    function fetchData() {
        var startDate = $('#selectedStartDate').val();
        var endDate = $('#selectedEndDate').val();
        window.location.replace(window.location.origin+'/indeks-berita?start_date='+startDate+'&end_date='+endDate)
    }
});
