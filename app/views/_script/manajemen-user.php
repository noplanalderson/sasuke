    <!-- Page level plugins -->
    <script src="<?= site_url('assets/vendor/datatables/datatables.min.js');?>"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        'use strict';

        $('#tblUser').DataTable({
          	responsive: true,
          	"language": [{
	            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
	            "emptyTable": "Tidak ada User",
	            "lengthMenu": "_MENU_ &nbsp; user/halaman",
	            "search": "Cari: ",
	            "zeroRecords": "User tidak Ditemukan",
	            "paginate": {
	              "previous": "<i class='fas fa-chevron-left'></i>",
	              "next": "<i class='fas fa-chevron-right'></i>",
            	},
        	}],
        	ordering: true,
        	dom: '<"left"l><"right"fr>',
        });
     });
    </script>