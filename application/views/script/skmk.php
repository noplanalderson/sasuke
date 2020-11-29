    <!-- Page level plugins -->
    <script src="<?= site_url('assets/vendor/datatables/datatables.min.js');?>"></script>
    <script type="text/javascript">
    	$(document).ready(function(){
        'use strict';

        $('#tabelSkmk').DataTable({
          responsive: true,
          "language": [{
            "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            "emptyTable": "Tidak ada Surat",
            "lengthMenu": "_MENU_ &nbsp; surat/halaman",
            "search": "Cari: ",
            "zeroRecords": "Surat tidak Ditemukan",
            "paginate": {
              "previous": "<i class='fas fa-chevron-left'></i>",
              "next": "<i class='fas fa-chevron-right'></i>",
            },
          }],
          ordering: false,
              dom: '<"left"l><"right"fr>Btip',
              buttons: [
              {
                extend: 'excelHtml5',
                pageSize: 'Legal',
                orientation: 'landscape',
                title: "Daftar Surat Kematian",
                messageTop: "Puskesmas Kecamatan Kalideres \n\n",
                  exportOptions: {
                    columns: [0,1,2,3,4]
                  }
              },
              {
                extend: 'pdfHtml5',
                pageSize: 'Legal',
                orientation: 'landscape',
                title: "Daftar Surat Kematian",
                  customize : function(doc) {
                    doc.content.splice(0, 1, {
                      text: [
                        {
                        text: "Daftar Surat Kematian \n",
                        fontSize: 14,
                        alignment: 'center'
                        },
                        {
                        text: "Puskesmas Kecamatan Kalideres \n\n\n",
                        fontSize: 12,
                        alignment: 'center'
                        }
                      ]
                    });
                    doc.content[1].margin = [ 10, 0, 10, 0 ];
                    doc.content[1].table.widths = [150,200,200,150,150];
                  },
                exportOptions: {
                  columns: [0,1,2,3,4]
                }
              }
            ]
        });
      });
    </script>