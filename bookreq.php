<?php
    session_start();
    if (!$_SESSION['logged_in'])
    {
        header('Location: http://localhost/ALMS/loginform.php');
    }
?><!DOCTYPE html>
<html lang="en">

<head>
  <?php include('admininclude/head.php'); ?>
  <link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" type="text/css" href="src/plugins/datatables/media/css/responsive.dataTables.css">
</head>

<body>
    <?php include('admininclude/header.php'); ?>
      <?php include('admininclude/sidebar.php'); ?>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <!--overview start-->
        <div class="row">

        </div>

<!--Put your contents here -->
<!-- Export Datatable start -->
				<div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
					<div class="row">
						<table class="stripe hover multiple-select-row data-table-export nowrap" id="user_data">
							<thead>
								<tr>
									<th>Land Id</th>
									<th>Name</th>
									<th>Email</th>
                  <th>Contact</th>
                  <th>District</th>
                  <th>Taluk</th>
									<th>Village Office</th>
                  <th>Booked From</th>
                  <th>Booked To</th>
									<th class="table-plus datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$sql = 'SELECT * FROM booking WHERE STATUS IS NULL';
									$stmt = $pdo -> prepare($sql);
									$stmt -> execute();
									while ( $rows = $stmt -> fetch(PDO::FETCH_ASSOC)) {
										echo '
										    <tr>
										        <td>'.$rows['LANDID'].'</td>
										        <td>'.$rows['NAME'].'</td>
										        <td>'.$rows['EMAIL'].'</td>
                            <td>'.$rows['CONTACT'].'</td>
                            <td>'.$rows['DISTRICT'].'</td>
                            <td>'.$rows['TALUK'].'</td>
										        <td>'.$rows['VILLAGE'].'</td>
                            <td>'.$rows['FROMDATE'].'</td>
                            <td>'.$rows['TODATE'].'</td>
										        <td>
										        	<div class="dropdown">
										        		<a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
										        					<i class="fa fa-ellipsis-h"></i>
										        		</a>
                                <div class="dropdown-menu dropdown-menu-right">
                                  <a class="dropdown-item" href="booked.php?landid='.$rows['LANDID'].'"><i class="fa fa-eye"></i> Booked</a>
                                </div>
										        	</div>
										        </td>
										    </tr>
										';
									};
                  //<a class="dropdown-item" href="voverify/reject.php?villageid='.$rows['VILLAGE_ID'].'"><i class="fa fa-pencil"></i> Reject</a>

                        		?>
							</tbody>
						</table>
					</div>
				</div>
				<!-- Export Datatable End -->


<!-- END of Contents-->

                </div>
                <div class="widget-foot">
                  <!-- Footer goes here -->
                </div>
              </div>
            </div>

          </div>

        </div>
        <!-- project team & activity end -->

      </section>

    </section>
    <!--main content end-->
  </section>
  <!-- container section start -->

  <!-- javascripts -->
  <script src="js/jquery.js"></script>
  <script src="js/jquery-ui-1.10.4.min.js"></script>
  <script src="js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="js/jquery-ui-1.9.2.custom.min.js"></script>
  <!-- bootstrap -->
  <script src="js/bootstrap.min.js"></script>

  <script src="assets/jquery-knob/js/jquery.knob.js"></script>
  <script src="js/jquery.sparkline.js" type="text/javascript"></script>
  <script src="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
  <script src="js/owl.carousel.js"></script>
  <!-- jQuery full calendar -->
  <<script src="js/fullcalendar.min.js"></script>
    <!-- Full Google Calendar - Calendar -->
    <script src="assets/fullcalendar/fullcalendar/fullcalendar.js"></script>
    <!--script for this page only-->
    <script src="js/calendar-custom.js"></script>
    <script src="js/jquery.rateit.min.js"></script>
    <!-- custom select -->
    <script src="js/jquery.customSelect.min.js"></script>
    <script src="assets/chart-master/Chart.js"></script>

    <!--custome script for all page-->
    <script src="js/scripts.js"></script>
    <!-- custom script for this page-->
    <script src="js/sparkline-chart.js"></script>
    <script src="js/easy-pie-chart.js"></script>
    <script src="js/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="js/jquery-jvectormap-world-mill-en.js"></script>

    <script src="js/jquery.autosize.min.js"></script>
    <script src="js/jquery.placeholder.min.js"></script>
    <script src="js/gdp-data.js"></script>
    <script src="js/morris.min.js"></script>
    <script src="js/sparklines.js"></script>

    <script src="js/jquery.slimscroll.min.js"></script>
    <script>
      //knob
      $(function() {
        $(".knob").knob({
          'draw': function() {
            $(this.i).val(this.cv + '%')
          }
        })
      });

      //carousel
      $(document).ready(function() {
        $("#owl-slider").owlCarousel({
          navigation: true,
          slideSpeed: 300,
          paginationSpeed: 400,
          singleItem: true

        });
      });

      //custom select box

      $(function() {
        $('select.styled').customSelect();
      });

      /* ---------- Map ---------- */
      $(function() {
        $('#map').vectorMap({
          map: 'world_mill_en',
          series: {
            regions: [{
              values: gdpData,
              scale: ['#000', '#000'],
              normalizeFunction: 'polynomial'
            }]
          },
          backgroundColor: '#eef3f7',
          onLabelShow: function(e, el, code) {
            el.html(el.html() + ' (GDP - ' + gdpData[code] + ')');
          }
        });
      });
    </script>
    <script src="vendors/scripts/script.js"></script>
    	<script src="src/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
    	<script src="src/plugins/datatables/media/js/dataTables.bootstrap4.js"></script>
    	<script src="src/plugins/datatables/media/js/dataTables.responsive.js"></script>
    	<script src="src/plugins/datatables/media/js/responsive.bootstrap4.js"></script>
    	<!-- buttons for Export datatable -->
    	<script src="src/plugins/datatables/media/js/button/dataTables.buttons.js"></script>
    	<script src="src/plugins/datatables/media/js/button/buttons.bootstrap4.js"></script>
    	<script src="src/plugins/datatables/media/js/button/buttons.print.js"></script>
    	<script src="src/plugins/datatables/media/js/button/buttons.html5.js"></script>
    	<script src="src/plugins/datatables/media/js/button/buttons.flash.js"></script>
    	<script src="src/plugins/datatables/media/js/button/pdfmake.min.js"></script>
    	<script src="src/plugins/datatables/media/js/button/vfs_fonts.js"></script>
    	<script>
    		$('document').ready(function(){
    			$('.data-table').DataTable({
    				scrollCollapse: true,
    				autoWidth: false,
    				responsive: true,
    				columnDefs: [{
    					targets: "datatable-nosort",
    					orderable: false,
    				}],
    				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    				"language": {
    					"info": "_START_-_END_ of _TOTAL_ entries",
    					searchPlaceholder: "Search"
    				},
    			});
    			$('.data-table-export').DataTable({
    				scrollCollapse: true,
    				autoWidth: false,
    				responsive: true,
    				columnDefs: [{
    					targets: "datatable-nosort",
    					orderable: false,
    				}],
    				"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
    				"language": {
    					"info": "_START_-_END_ of _TOTAL_ entries",
    					searchPlaceholder: "Search"
    				},
    				dom: 'Bfrtip',
    				buttons: [
    				'copy', 'csv', 'pdf', 'print'
    				]
    			});
    			var table = $('.select-row').DataTable();
    			$('.select-row tbody').on('click', 'tr', function () {
    				if ($(this).hasClass('selected')) {
    					$(this).removeClass('selected');
    				}
    				else {
    					table.$('tr.selected').removeClass('selected');
    					$(this).addClass('selected');
    				}
    			});
    			var multipletable = $('.multiple-select-row').DataTable();
    			$('.multiple-select-row tbody').on('click', 'tr', function () {
    				$(this).toggleClass('selected');
    			});
    		});
    	</script>
</body>

</html>
