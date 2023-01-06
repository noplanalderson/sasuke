
    $('.cetak-surat').on('click',function() {
      var restorepage = document.body.innerHTML;
      var printcontent = document.getElementById('cetak').innerHTML;
      document.body.innerHTML = printcontent;
      window.print();
      document.body.innerHTML = restorepage;
      document.close();
      document.location.reload(true);
    })

    //Create PDf from HTML...
    $('.export-pdf').on('click',function(e) {
        e.preventDefault();
        
        $('.export-pdf').html('<i class="fas fa-circle-notch fa-spin"></i> Mengunduh...');
        $('.export-pdf').prop('disabled', true);

        var filename = $('#no-surat').text();
        var HTML_Width = 59/100 * document.querySelector('#cetak').offsetWidth;
        var HTML_Height = 59/100 * document.querySelector('#cetak').offsetHeight;
        var top_left_margin = 2;
        var top_right_margin = 2;
        var PDF_Width = 2550;
        var PDF_Height = 4200;
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;

        var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

        html2canvas($("#cetak")[0]).then(function (canvas) {
            var imgData = canvas.toDataURL("image/png");
            var pdf = new jsPDF('p', 'pt', 'legal', [PDF_Width, PDF_Height]);
            pdf.addImage(imgData, 'PNG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
            for (var i = 1; i <= totalPDFPages; i++) { 
                pdf.addPage(PDF_Width, PDF_Height);
                pdf.addImage(imgData, 'PNG', top_left_margin, -(PDF_Height*i)+(top_left_margin*1),canvas_image_width,canvas_image_height);
            }
            pdf.save(filename + ".pdf");
            $('.export-pdf').html('<i class="fa fa-file-pdf"></i> Unduh PDF');
            $('.export-pdf').prop('disabled', false);
        });

    })