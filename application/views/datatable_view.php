<!DOCTYPE html>
<html lang="en">
<head>
	<title>Book Display</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.css"/>
	<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.13/datatables.min.js"></script> 
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#book-table').DataTable({
				"ajax": {
					url : "<?php echo site_url("datalist/student_page") ?>",
					type : 'GET'
				},
			});
		});
	</script>
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h1>Student List</h1>

				<table id="book-table" class="table table-bordered table-striped table-hover">
					<thead>
						<tr><td>Book Title</td><td>Book Price</td><td>Book Author</td><td>Rating</td><td>Publisher</td></tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>