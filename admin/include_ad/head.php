<head>
	<title>THCS Nguyễn Kim Nha</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--bootstrap-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

	<!--Xuất file excel -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
	<script src="https://cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>

	<!--Trang giới thiệu-->
	<script src="js/wow.min.js"></script>
	<link rel="stylesheet" href="css/animate.min.css">
	<link rel="stylesheet" href="../../css/layout.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

	<!-- Phân trang -->
	<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
	<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
	
	<!--Biểu đồ -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<script>
	$(document).ready(function() {
		$('#table2excel').DataTable({
			'language': {
				'sProcessing': 'Đang xử lý...',
				'sLengthMenu': 'Hiển thị _MENU_ dòng',
				'sZeroRecords': 'Không tìm thấy dòng nào phù hợp',
				'sInfo': 'Đang xem _START_ đến _END_ trong tổng số _TOTAL_ dòng',
				'sInfoEmpty': 'Đang xem 0 đến 0 trong tổng số 0 dòng',
				'sInfoFiltered': '(được lọc từ _MAX_ dòng)',
				'sInfoPostFix': '',
				'sSearch': 'Tìm kiếm:',
				'sUrl': '',
				'oPaginate': {
					'sFirst': '<i class="fas fa-step-backward"></i>',
					'sPrevious': '<i class="fas fa-angle-double-left"></i>',
					'sNext': '<i class="fas fa-angle-double-right"></i>',
					'sLast': '<i class="fas fa-step-forward"></i>'
				}
			}
		});
	});
</script>