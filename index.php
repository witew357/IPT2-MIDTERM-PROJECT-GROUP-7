<?php
  include('partials\header.php');
  include('partials\sidebar.php');


  // Your PHP BACK CODE HERE

?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>iPhone DBMS</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.php">Home</a></li>
          <li class="breadcrumb-item">Tables</li>
          <li class="breadcrumb-item active">General</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between">
                <div>
                  <h5 class="card-title">iPhone List</h5>
                </div>
                <div>
                  <button class="btn btn-primary btn-sm mt-4 mx-3">Add List</button>
                </div>
              </div>

              <!-- Default Table -->
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Variants</th>
                    <th scope="col">Colors</th>
                    <th scope="col">Storage</th>
                    <th scope="col">Price</th>
                    <th scope="col" class="text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
    <?php if ($result->num_rows > 0): ?>
      <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $row['ID'] ?></td>
          <td><?= $row['Variants'] ?></td>
          <td><?= $row['Colors'] ?></td>
          <td><?= $row['Storage'] ?></td>
          <td><?= $row['Price'] ?></td>
          <td class="text-center">
            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#viewIphoneModal" 
                    data-id="<?= $row['ID'] ?>"
                    data-Variants="<?= $row['Variants'] ?>"
                    data-Colors="<?= $row['Colors'] ?>"
                    data-Storage="<?= $row['Storage'] ?>"
                    data-Price="<?= $row['Price'] ?>">View</button>
            <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editIphoneModal" 
                    data-id="<?= $row['ID'] ?>"
                    data-Variants="<?= $row['Variants'] ?>"
                    data-Colors="<?= $row['Colors'] ?>"
                    data-Storage="<?= $row['Storage'] ?>"
                    data-Price="<?= $row['Price'] ?>">Edit</button>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteIphoneModal" data-id="<?= $row['ID'] ?>">Delete</button>
          </td>
        </tr>
      <?php endwhile; ?>
    <?php else: ?>
      <tr>
        <td colspan="6" class="text-center">No record found</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>
              <!-- End Default Table Example -->
            </div>
            <div class="mx-4">
              <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </nav>
            </div>
          </div>

        </div>

        
      </div>

      <!-- Modal -->
      <div class="modal fade" id="editInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editInfoLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="editInfoLabel">iPhone Information</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              ...
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->
<?php
include('partials\footer.php');
?>