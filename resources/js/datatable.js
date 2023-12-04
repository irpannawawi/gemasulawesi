import { data } from "autoprefixer";
import '../AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css';
// import DataTable from "datatables.net-dt";
import '../AdminLTE/plugins/datatables/jquery.dataTables.js';
import '../AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js';
let table = new DataTable('.datatable', {
    ajax: '/api/articles',
    serverSide: true,
    processing: true,
    columns: [
        {
            data: 'post_id',
            name: 'post_id'
        }, {
            data: 'title',
            name: 'title'
        }, {
            data: 'rubrik.rubrik_name',
            name: 'rubrik.rubrik_name'
        }, {
            data: 'author.display_name',
            name: 'author.display_name'
        }, {
            data: 'editor.display_name',
            name: 'editor.display_name'
        }, {
            data: 'published_at',
            name: 'published_at'
        }, {
            data: 'post_id',
            name: 'post_data'
        }
    ],
    // Menambahkan tombol di kolom terakhir
    columnDefs: [
        {
            targets: -1,
            data: '',
            render: function (data, type, row) {
                return '<div class="btn-group"><button type="button" onclick="fill_form(' + row.post_id + ', \'' + row.title + '\')" class="btn btn-sm btn-default" data-dismiss="modal">Choose</a> </div>';
            },
        },
    ],
});
