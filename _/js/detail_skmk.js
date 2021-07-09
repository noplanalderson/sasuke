
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
    $('.export-pdf').on('click',function() {
        var filename = $('#no-surat').text();
        var HTML_Width = 2480;
        var HTML_Height = 3898;
        var top_left_margin = 2;
        var top_right_margin = 2;
        var PDF_Width = 2550;
        var PDF_Height = 4000;
        var canvas_image_width = HTML_Width;
        var canvas_image_height = HTML_Height;

        var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

        html2canvas($("#cetak")[0]).then(function (canvas) {
            var imgData = canvas.toDataURL("image/png");
            var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
            pdf.addImage(imgData, 'PNG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
            for (var i = 1; i <= totalPDFPages; i++) { 
                pdf.addPage(PDF_Width, PDF_Height);
                pdf.addImage(imgData, 'PNG', top_left_margin, -(PDF_Height*i)+(top_left_margin*1),canvas_image_width,canvas_image_height);
            }
            pdf.save(filename + ".pdf");
            // $("#cetak").hide();
        });
    })