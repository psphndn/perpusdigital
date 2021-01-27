
<div class="clear"></div>
</div>
<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
<script type="text/javascript">
	/*--This JavaScript method for Print command--*/
	function PrintDoc() {
		var toPrint = document.getElementById('tabel');
		var popupWin = window.open('');
		popupWin.document.open();
		popupWin.document.write('<html><title>::Print Data::</title><link rel="stylesheet" type="text/css" href="print.css" /></head><body onload="window.print()">')
		popupWin.document.write(toPrint.outerHTML);
		popupWin.document.write('</html>');
		popupWin.document.close();
	}
	/*--This JavaScript method for Print Preview command--*/
	function PrintPreview() {
		var toPrint = document.getElementById('tabel');
		var popupWin = window.open('');
		popupWin.document.open();
		popupWin.document.write('<html><title>::Printpreview Data::</title><link rel="stylesheet" type="text/css" href="print.css" media="screen"/></head><body">')
		popupWin.document.write(toPrint.outerHTML);
		popupWin.document.write('</html>');
		popupWin.document.close();
	}
</script>

<script type="text/javascript">
  $(document).ready(function($) {
    $('#accordion').find('.accordion-toggle').click(function(){

      //Expand or collapse this panel
      $(this).next().slideToggle('fast').addClass('animated bounceIn');

      //Hide the other panels
      $(".accordion-content").not($(this).next()).slideUp('fast');

    });
  });
</script>

</body>
</html>