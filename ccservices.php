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
									<th>LAND ID</th>
									<th>NAME</th>
									<th>CONTACT</th>
									<th>REQUIREMENTS</th>
									<th class="table-plus datatable-nosort">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									$sql = 'SELECT * FROM customercare where STATUS IS NULL';
									$stmt = $pdo -> prepare($sql);
									$stmt -> execute();
									while ( $rows = $stmt -> fetch(PDO::FETCH_ASSOC)) {
										echo '
										    <tr>
										        <td>'.$rows['LANDID'].'</td>
										        <td>'.$rows['NAME'].'</td>
										        <td>'.$rows['CONTACT'].'</td>
										        <td>'.$rows['SERVICE_YOU_NEED'].'</td>
										        <td>
										        	<div class="dropdown">
										        		<a class="btn btn-outline-primary dropdown-toggle" href="#" role="button" data-toggle="dropdown">
										        					<i class="fa fa-ellipsis-h"></i>
										        		</a>
                                <div class="dropdown-menu dropdown-menu-right">
										        			<a class="dropdown-item" href="ccservices/approve.php?landid='.$rows['LANDID'].'"><i class="fa fa-eye"></i> Approve</a>
										        			<a class="dropdown-item" href="ccservices/reject.php?landid='.$rows['LANDID'].'"><i class="fa fa-pencil"></i> Reject</a>
										        		</div>
										        	</div>
										        </td>
										    </tr>
										';
									};
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

</body>

</html>
