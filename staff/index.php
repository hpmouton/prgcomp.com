<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>


<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="../vendors/images/home.png" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>

	<?php include('includes/navbar.php')?>

	<?php include('includes/right_sidebar.php')?>

	<?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4 user-icon">
						<img src="../vendors/images/login.png" alt="">
					</div>
					<div class="col-md-8">

						<?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
								$row = mysqli_fetch_array($query);
						?>

						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Welcome back <div class="weight-600 font-30 text-blue"><?php echo $row['FirstName']. " " .$row['LastName']; ?>,</div>
						</h4>
						<p class="font-18 max-width-600">To the Workload Management System</p>
					</div>
				</div>
			</div>
			<div class="title pb-20">
				<h2 class="h3 mb-0">My Workloads</h2>
			</div>
			

			<div class="row">
				<div class="col-lg-4 col-md-6 mb-20">
					<div class="card-box height-100-p pd-20 min-height-200px">
						<div class="d-flex justify-content-between pb-10">
							<div class="h5 mb-0">My Courses</div>
							<div class="table-actions">
								<a title="VIEW" href="mycourses.php"><i class="icon-copy ion-disc" data-color="#1f2d55"></i></a>	
							</div>
						</div>
						<div class="user-list">
							<ul>
								<?php
		                         $query = mysqli_query($conn,"select * from mycourses where mycourses.emp_id = '$session_id' ORDER BY mycourses.emp_id desc limit 4") or die(mysqli_error());
		                         while ($row = mysqli_fetch_array($query)) {
		                             ?>

								<li class="d-flex align-items-center justify-content-between">
									<div class="name-avatar d-flex align-items-center pr-2">
									
										<div class="txt">
											<div class="font-14 weight-600"><?php echo $row['course'] ; ?></div>
										</div>

									</div>
									<div class="font-12 weight-500" data-color="#1f2d55"></div>

								</li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
				
				<div class="col-lg-4 col-md-6 mb-20">
					<div class="card-box height-100-p pd-20 min-height-200px">
						<div class="d-flex justify-content-between">
							<div class="h5 mb-0">My Students</div>
							<div class="table-actions">
								<a title="VIEW" href="staff.php"><i class="icon-copy ion-disc" data-color="#1f2d55"></i></a>	
							</div>
						</div>

						<div class="user-list">
							<ul>
								<?php
		                         $query = mysqli_query($conn,"select * from students where students.SupervisorId = '$session_id' ORDER BY students.SupervisorId desc limit 4") or die(mysqli_error());
		                         while ($row = mysqli_fetch_array($query)) {
		                         $id = $row['studentNo'];
		                             ?>

								<li class="d-flex align-items-center justify-content-between">
									<div class="name-avatar d-flex align-items-center pr-2">
										
										<div class="txt">
											<div class="font-14 weight-600"><?php echo $row['StudentName'] . " " . $row['StudentSurname']; ?></div>
										</div>
									</div>
									<div class="font-12 weight-500" data-color="#1f2d55"><?php echo $row['Type']; ?></div>
								</li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-20">
					<div class="card-box height-100-p pd-20 min-height-200px">
						<div class="d-flex justify-content-between">
							<div class="h5 mb-0">My Projects</div>
							<div class="table-actions">
								<a title="VIEW" href="research.php"><i class="icon-copy ion-disc" data-color="#1f2d55"></i></a>	
							</div>
						</div>

						<div class="user-list">
							<ul>
								<?php
		                         $query = mysqli_query($conn,"select * from myresearch where myresearch.emp_id = '$session_id' ORDER BY myresearch.emp_id desc limit 4") or die(mysqli_error());
		                         while ($row = mysqli_fetch_array($query)) {
		                         $id = $row['emp_id'];
		                             ?>

								<li class="d-flex align-items-center justify-content-between">
									<div class="name-avatar d-flex align-items-center pr-2">
									
										<div class="txt">
											<div class="font-14 weight-600"><?php echo $row['Name'] ; ?></div>
										</div>
									</div>
								</li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
				
			</div>

			<div class="card-box mb-30">
				<div class="pd-20">
						<h2 class="text-blue h4">MY ADMINISTRATIVE TASKS</h2>
					</div>
				<div class="pb-20">
					<table class="data-table table stripe hover nowrap">
						<thead>
							<tr>
								<th class="table-plus datatable-nosort">TASK NAME</th>
								<th>TASK DESCRIPTION</th>
								<th>STATUS</th>

								<th class="datatable-nosort">ACTION</th>
							</tr>
						</thead>
						<tbody>
							<tr>

								<?php $sql = "SELECT mytasks.id as lid,mytasks.name,mytasks.description,mytasks.status from mytasks where mytasks.emp_id = '$session_id' order by lid desc limit 5";
									$query = $dbh -> prepare($sql);
									$query->execute();
									$results=$query->fetchAll(PDO::FETCH_OBJ);
									$cnt=1;
									if($query->rowCount() > 0)
									{
									foreach($results as $result)
									{         
								 ?>  

								
								<td><?php echo htmlentities($result->name);?></td>
	                            <td><?php echo htmlentities($result->description);?></td>
								<td><?php $stats=$result->status;
	                             if($stats==1){
	                              ?>
	                                  <span style="color: green">Validated</span>
	                                  <?php } if($stats==0)  { ?>
	                             <span style="color: blue">Not Validated</span>
	                             <?php } ?>
	                            </td>
								<td>
									<div class="dropdown">
										<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
											<i class="dw dw-more"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
											<a class="dropdown-item" href="leave_details.php?leaveid=<?php echo htmlentities($result->lid);?>"><i class="dw dw-eye"></i> View</a>
											<a class="dropdown-item" href="admin_dashboard.php?leaveid=<?php echo htmlentities($result->lid);?>"><i class="dw dw-delete-3"></i> Delete</a>
										</div>
									</div>
								</td>
							</tr>
							<?php $cnt++;} }?>
						</tbody>
					</table>
			   </div>
			</div>
			<div class="card-box mb-30">
				<div class="pd-20">
						<h2 class="text-blue h4">MY COMMUNITY PROJECTS</h2>
					</div>
				<div class="pb-20">
					<table class="data-table table stripe hover nowrap">
						<thead>
							<tr>
								<th class="table-plus datatable-nosort">PROJECT NAME</th>
								<th>DESCRIPTION</th>
														<th class="datatable-nosort">ACTION</th>
							</tr>
						</thead>
						<tbody>
							<tr>

								<?php $sql = "SELECT mycommunity.id as lid,mycommunity.name,mycommunity.description from mycommunity where mycommunity.emp_id = '$session_id' order by lid desc limit 5";
									$query = $dbh -> prepare($sql);
									$query->execute();
									$results=$query->fetchAll(PDO::FETCH_OBJ);
									$cnt=1;
									if($query->rowCount() > 0)
									{
									foreach($results as $result)
									{         
								 ?>  

								
								<td><?php echo htmlentities($result->name);?></td>
	                            <td><?php echo htmlentities($result->description);?></td>
								
								<td>
									<div class="dropdown">
										<a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
											<i class="dw dw-more"></i>
										</a>
										<div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
											<a class="dropdown-item" href="leave_details.php?leaveid=<?php echo htmlentities($result->lid);?>"><i class="dw dw-eye"></i> View</a>
											<a class="dropdown-item" href="admin_dashboard.php?leaveid=<?php echo htmlentities($result->lid);?>"><i class="dw dw-delete-3"></i> Delete</a>
										</div>
									</div>
								</td>
							</tr>
							<?php $cnt++;} }?>
						</tbody>
					</table>
			   </div>
			</div>

			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->

	<?php include('includes/scripts.php')?>
</body>
</html>