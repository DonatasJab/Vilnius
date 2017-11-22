    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="template/js/bootstrap.min.js"></script>
    <script src="js/delete.js"></script>
    <script src="js/select2.min.js"></script>
    <script>
		$("#street").select2({
			placeholder: 'Gatvė',
  			allowClear: true,
		    minimumInputLength: 3
		});
	</script>
    <script>
	    var input = document.getElementById('page'),
	    button = document.getElementById('changePage'),
	    limit = <?php echo $pages; ?>;

	    button.addEventListener('click', function() {
	        var page = parseInt(input.value, 10) || 1;
	        location.href = 'index.php?page=' + (page <= limit ? page : limit);
	    });
	    $(document).ready(function(){
		    $('.filterable .filters input:not(:checkbox), select').on('input change', function(e) {
		        var code = e.keyCode || e.which;
		        if (code == '9') return;
		        var $input = $(this),
		        inputContent = $input.val().toLowerCase(),
		        $panel = $input.parents('.filterable'),
		        column = $panel.find('.filters th').index($input.parents('th')),
		        $table = $panel.find('.table'),
		        $rows = $table.find('tbody tr');
		        var $filteredRows = $rows.filter(function(){
		            var value = $(this).find('td').eq(column).text().toLowerCase();
		            return value.indexOf(inputContent) === -1;
		        });
		        $table.find('tbody .no-result').remove();
		        $rows.show();
		        $filteredRows.hide();
		        if ($filteredRows.length === $rows.length) {
		            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">Deja, bet rezultatų nepavyko rasti</td></tr>'));
		        }
		    });
		});
    </script>