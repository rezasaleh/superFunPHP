<?php 
	require ("includes/functions.php");

	// select the books from our DB
	// loop and display in the table
	// show total number of books in library
	
	$books = DB::query("SELECT * FROM books");

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>List Books</title>
  <!-- CSS dependencies -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
  <div class="py-2 text-center">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <?php include ("includes/nav_main.php"); ?>
        </div>
      </div>
    </div>
  </div>
  <div class="py-4">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2>List of books</h2>
          <hr>
                    <div class="table-responsive col-md-12">
            <table class="table table-hover table-striped table-bordered">
              <thead class="thead-dark">
                <tr>
                  <th>ID</th>
            			<th>Name</th>
            			<th>Author</th>
                  <th>Year</th>
                  <th>Editor</th>
                  <th>Description</th>
            			<th></th>
                </tr>
              </thead>
              <tbody>
								<?php foreach ($books as $book){ ?>
                   <tr>
            				<td><?php echo $book['id']; ?></td>
            				<td><?php echo $book['title']; ?></td>
            				<td><?php echo $book['author']; ?></td>
            				<td><?php echo $book['year']; ?></td>
            				<td><?php echo $book['editor']; ?></td>
            				<td><?php echo $book['description']; ?></td>
            				<td>
											<?php if ( is_logged_in() ) { ?>
												<a href="create_book.php?b_id=<?php echo $book['id']; ?>">Update</a>
												<?php if ( is_user_admin() ) { ?>
													&nbsp;|&nbsp 
													<a href="create_book.php?b_id=<?php echo $book['id']; ?>&delete=1">Delete</a>
												<?php } ?>
											<?php }?>
            				</td>
            			</tr>
								<?php } ?>
							</tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <p class="text-right">There are <?php echo DB::count();//count($books); ?> books in the library</p>
        </div>
      </div>
    </div>
  </div>

</body>




</html>
