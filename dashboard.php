<!DOCTYPE html>
<html>

<?php include('header.php');
session_start();
if (isset($_SESSION['name'])) {

?>

	<body>
		<ul>
			<li><a href="#home">Home</a></li>
			<li><a href="#home"><?php if ($_SESSION['role'] == "1") {
									echo "Super Admin";
								} else if ($_SESSION['role'] == "2") {
									echo "Admin";
								} else {
									echo "User";
								} ?></a></li>
			<li style="float:right"><a type="button" id="logout" class="active" href="#">Logout</a></li>
		</ul>

		<div class="container">
			<?php if ($_SESSION['status'] == 0) { ?>

				<div class="alert alert-warning" role="alert">
					Needs Admin Approval..
				</div>

				<div class="row">
				<?php } else if ($_SESSION['role'] == 1 ||  $_SESSION['role'] == 3) { ?>
					<div class="col-lg-12 margin-tb">
						<div class="pull-left">
							<div class="input-group">
								<div class="form-outline">
								<label class="control-label" for="title">Search:</label><input type="search" id="search" style="width:'100%'" placeholder="Search by Name or email or address" name="search" class="search form-control" required />
									
									</label>
								</div>

							</div>
						</div>
						<?php if ($_SESSION['role'] == 1 ||  $_SESSION['role'] == 2) { ?>
							<div class="pull-right">
								<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
									Create New Record
								</button>
							</div>
						<?php } ?>
					</div>
				</div>
				<br />
				<div id="totalPages">
				</div>
				<table id="records" class="table table-bordered">
					<thead>
						<tr>
							<th>Id</th>
							<th>Name</th>
							<th>role</th>
							<th>email</th>
							<th>Mobile</th>
							<th>Address</th>
							<th>Profile</th>
							<th width="200px">Date of Birth</th>
							<th>Status</th>
							<th>Sign</th>
							<th width="200px">Creation Date</th>
							<th>Updated By</th>
							<th width="200px">Action</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			<?php } ?>

			<div id="norecords" class="alert alert-warning" role="alert">
				<p>no records</p>
			</div>
			<ul id="pagination" class="pagination-sm">

			</ul>
			<ul id="searchPagination" class="pagination-sm">

			</ul>
			<!-- <ul id="loader">
				<img src="./assests/images/loading.gif"/>
			</ul> -->


			<input type="text" id="userrole" value="<?= $_SESSION['role']; ?>" hidden />
			<!-- Create Item Modal -->
			<div class="modal fade" id="create-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
							<h4 class="modal-title" id="myModalLabel"></h4>
						</div>
						<div class="modal-body">
							<div class="alert alert-success alert-dismissible" id="success">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
							</div>
							<div class="alert alert-danger alert-dismissible" id="error">
								<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
							</div>
							<form data-toggle="validator" action="api/create.php" method="POST">
								<div class="form-group">
									<label class="control-label" for="title">Name:</label>
									<input type="text" name="name" id="name" class="form-control" data-error="Please enter title." required />
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<label class="control-label" for="title">Mobile:</label>
									<input type="text" name="mobile" id="mobile" class="form-control" data-error="Please enter title." required />
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<label class="control-label" for="title">Email:</label>
									<input type="email" name="email" id="email" class="form-control" data-error="Please enter title." required />
									<div class="help-block with-errors"></div>
								</div>
								<!-- <div class="form-group">
									<label class="control-label" for="title">Password:</label>
									<input type="text" name="title" class="form-control" data-error="Please enter title." required />
									<div class="help-block with-errors"></div>
								</div> -->
								<label for="html" class=""><b>Profile Picture:</b><br />
									<div id="preview"></div>
									<input type="file" name="fileToUpload" id="fileToUpload" required>
									<!-- <input type="button" id="upload" name="upload"> -->
								</label>
								<div class="form-group">
									<label class="control-label" for="title">Date of Birth:</label>
									<input type="date" name="dateofbirth" id="dateofbirth" class="form-control" data-error="Please enter title." required />
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<label class="control-label" for="title">Address:</label>
									<input type="text" name="address" id="address" class="form-control" data-error="Please enter title." required />
									<div class="help-block with-errors"></div>
								</div>
								<div class="form-group">
									<label class="control-label" for="title">Gender:</label>
									<label for="one">
										  <label for="css">Male</label>
										<input type="radio" id="gender" name="gender" class="radio-inline" value="Male" required>
										  <input type="radio" id="gender" name="gender" class="radio-inline" value="Female" required>
										<label for="css">Female</label>
										<div class="help-block with-errors"></div>
									</label>
								</div>
								<!-- <div class="form-group">
									<label class="control-label" for="title">Description:</label>
									<textarea name="description" class="form-control" data-error="Please enter description." required></textarea>
									<div class="help-block with-errors"></div>
								</div> -->
								<div class="form-group">
									<button type="submit" class="btn crud-submit btn-success">Submit</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<!-- Edit Item Modal -->
			<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
								<h4 class="modal-title" id="myModalLabel"></h4>
							</div>
							<div class="modal-body">

								<div class="alert alert-success alert-dismissible" id="success">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
								</div>
								<div class="alert alert-danger alert-dismissible" id="error">
									<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
								</div>
								<form data-toggle="validator" action="api/update.php" method="POST">
									<div class="form-group">
										<label class="control-label" for="title">Name:</label>
										<input type="text" name="id" id="id" class="form-control" data-error="Please enter title." hidden />

										<input type="text" name="name" id="name" class="form-control" data-error="Please enter title." required />
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group">
										<label class="control-label" for="title">Mobile:</label>
										<input type="text" name="mobile" id="mobile" class="form-control" data-error="Please enter title." required />
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group">
										<label class="control-label" for="title">Email:</label>
										<input type="email" name="email" id="email" class="form-control" data-error="Please enter title." required disabled />
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group">
										<label class="control-label" for="title">Role:</label>
										<select name="role" id="role" class="fourth">
											<option value="3">User </option>
											<option value="2">Admin</option>
											<option value="1">Super Admin</option>
										</select>
									</div>
									<!-- <div class="form-group">
									<label class="control-label" for="title">Password:</label>
									<input type="text" name="title" class="form-control" data-error="Please enter title." required />
									<div class="help-block with-errors"></div>
								</div> -->
									<label for="html" class=""><b>Profile Picture:</b><br />
										<div id="preview1"></div>

										<input type="file" name="fileToUpload-edit" id="fileToUpload-edit">
										<!-- <input type="button" id="upload" name="upload"> -->
										<img name="profile" id="profile" width="200px" height="100px" />
									</label>
									
									<div class="form-group">
										<label class="control-label" for="title">Date of Birth:</label>
										<input type="date" name="dateofbirth" id="dateofbirth" class="form-control" data-error="Please enter title." required />
										<div class="help-block with-errors"></div>
									</div>
									<div class="form-group">
										<label class="control-label" for="title">Address:</label>
										<input type="text" name="address" id="address" class="form-control" data-error="Please enter title." required />
										<div class="help-block with-errors"></div>
									</div>
									<label for="html" class=" fourth">Signature:
										<div id="preview2"></div>
										<img id="previewSignature" alt="" style="border: 1px solid #ccc" width="200px" height="100px" />
										<div class="tools">
											<a href="#colors_sketch" data-tool="marker">Marker</a> 
											<a href="#colors_sketch"  data-tool="eraser">
											<a href='#colors_sketch' id="eraser" data-clear='true'>Clear</a>

												Eraser
											</a>
										</div>
										<br />
										<div id="signdiv">
										<canvas id="colors_sketch" width="400" id="board" height="150" style="border-style: groove;"></canvas>
										<br />
										<br />
										<input type="button" id="btnSave" class="btn btn-success" value="Save as Signature" /><br />
										<br />
										</div>

										<input id="saveimg" alt="" style="display: none; border: 1px solid #ccc" hidden/>

									</label>

									<div class="form-group">
										<button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
									</div>


								</form>


							</div>
						</div>
					</div>
				</div>


			</div>
		<?php } else {
		header("Location:http://localhost/SystemTask/index.php");
	} ?>
	</body>
	<?php include('footer.php'); ?>

</html>