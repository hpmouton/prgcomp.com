<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>

<!-- Delete a course -->
<?php 
	 if (isset($_GET['delete'])) {
		$course_id = $_GET['delete'];
		$sql = "DELETE FROM mycourses where id = ".$course_id;
		$result = mysqli_query($conn, $sql);
		if ($result) {
			echo "<script>alert('course deleted Successfully');</script>";
     		echo "<script type='text/javascript'> document.location = 'academic.php'; </script>";
			
		}
	}
?>

<!-- Add new Course -->
<?php
 if(isset($_POST['add']))
{
	 $deptname=$_POST['course'];
	$deptshortname=$_POST['coursecode'];
	$Samount=$_POST['NoOfStudents'];
	$Gamount=$_POST['NoOfGroups'];

     $query = mysqli_query($conn,"select * from mycourses where course = '$deptname'")or die(mysqli_error());
	 $count = mysqli_num_rows($query);
     
     if ($count > 0){ 
     	echo "<script>alert('course Already exist');</script>";
      }
      else{
        $query = mysqli_query($conn,"insert into mycourses(course, coursecode,NoOfStudents,NoOfGroups)
  		 values ('$deptname', '$deptshortname','$Samount','$Gamount')      
		") or die(mysqli_error()); 

		if ($query) {
			echo "<script>alert('course Added Successfully');</script>";
			echo "<script type='text/javascript'> document.location = 'academic.php'; </script>";
		}
    }

}

?>
<body>
	<!-- loading screen -->
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
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
					<div class="page-header">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Course List</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
										<li class="breadcrumb-item active" aria-current="page">course Module</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-lg-4 col-md-6 col-sm-12 mb-30">
							<div class="card-box pd-30 pt-10 height-100-p">
								<h2 class="mb-30 h4">New course</h2>
								<section>
									<form name="save" method="post">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label >course Name</label>
												<input name="course" type="text" class="form-control" required="true" autocomplete="off">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>course code</label>
												<input name="coursecode" type="text" class="form-control" required="true" autocomplete="off" style="text-transform:uppercase">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Students Enrolled</label>
												<input name="noofstudents" type="text" class="form-control" required="true" autocomplete="off" style="text-transform:uppercase">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>Groups</label>
												<input name="groups" type="text" class="form-control" required="true" autocomplete="off" style="text-transform:uppercase">
											</div>
										</div>
									</div>
									<div class="row">
									<div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
  <label class="form-check-label" for="flexCheckDefault">
    Theory
  </label>
</div>
</div>
<div class="row">
<div class="form-check">
  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" checked>
  <label class="form-check-label" for="flexCheckDefault">
    Practical
  </label>
</div>

									</div>
									<div class="col-sm-12 text-right">
										<div class="dropdown">
										   <input class="btn btn-primary" type="submit" value="REGISTER" name="add" id="add">
									    </div>
									</div>
								   </form>
							    </section>
							</div>
						</div>
						
						<div class="col-lg-8 col-md-6 col-sm-12 mb-30">
							<div class="card-box pd-30 pt-10 height-100-p">
								<h2 class="mb-30 h4">course List</h2>
								<div class="pb-20">
									<table class="data-table table stripe hover nowrap">
										<thead>
										<tr>
											<th>Course Id</th>
											<th class="table-plus">COURSE NAME</th>
											<th>COURSE CODE</th>
											<th>STUDENTS</th>
											<th>GROUPS</th>

											<th class="datatable-nosort">ACTION</th>
										</tr>
										</thead>
										<tbody>

											<?php $sql = "SELECT * from mycourses";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0)
											{
											foreach($results as $result)
											{               ?>  

											<tr>
												<td> <?php echo htmlentities($cnt);?></td>
	                                            <td><?php echo htmlentities($result->course);?></td>
	                                            <td><?php echo htmlentities($result->coursecode);?></td>
												<td><?php echo htmlentities($result->NoOfStudents);?></td>
	                                            <td><?php echo htmlentities($result->NoOfGroups);?></td>

												<td>
													<div class="table-actions">
														<a href="edit_courses.php?edit=<?php echo htmlentities($result->id);?>" data-color="#1f2d55"><i class="icon-copy dw dw-edit2"></i></a>
														<a href="academic.php?delete=<?php echo htmlentities($result->id);?>" data-color="#e95959"><i class="icon-copy dw dw-delete-3"></i></a>
													</div>
												</td>
											</tr>

											<?php $cnt++;} }?>  

										</tbody>
										
									</table>
								</div>
							</div>
						</div>
					</div>

				</div>

			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->

	<?php include('includes/scripts.php')?>
</body>
</html>