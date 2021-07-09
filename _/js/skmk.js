$(document).ready(function(){
        'use strict';
        var instansi = $('.instansi').text();

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
                messageTop: instansi + " \n\n",
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
                        text: instansi + "\n\n\n",
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

    $("#tabelSkmk").on('click', '.delete-btn', function(e){
      e.preventDefault();

        Swal.fire({
            text: 'Anda yakin ingin menghapus surat?',
            showCancelButton: true,
            type: 'warning',
            confirmButtonText: 'Yes',
            reverseButtons: true
        }).then((result) => {

        if (result.value == true) {
            var $tr = $(this).closest('tr');
            const id_skmk = $(this).data('id');

            $.ajax({
                url: baseURI + '/hapus-skmk',
                data: { 
                id: id_skmk,
                sasuke_token: $('meta[name="X-CSRF-TOKEN"]').attr('content')
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {

                    $('.csrf_token').val(data.token);
                    $('meta[name="X-CSRF-TOKEN"]').attr('content', data.token);

                    if (data.result == 1) {
                      Swal.fire('Success!', data.msg, 'success');
                      $tr.find('td').fadeOut(1000,function(){ 
                        $tr.remove();                    
                      });
                    } 
                    else {
                      Swal.fire('Failed!', data.msg, 'error');
                    }
                }
            });
        }
        })
    });