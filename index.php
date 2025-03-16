<?php
  include('partials\header.php');
  include('partials\sidebar.php');
  include('database\database.php');

  // Pagination variables
  $limit = 5; // Number of records per page
  $page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page
  $offset = ($page - 1) * $limit; // Offset for SQL query

  // Your PHP BACK CODE HERE

  // Search functionality
  $search = "";
if (isset($_GET['search'])) {
    $search = $_GET['search'];    
    $sql = "SELECT * FROM iphone 
            WHERE Variants LIKE '%$search%' 
            OR Colors LIKE '%$search%' 
            OR Storage LIKE '%$search%' 
            OR Price LIKE '%$search%'
            LIMIT $offset, $limit";
} else {
    $sql = "SELECT * FROM iphone LIMIT $offset, $limit";
}    

// Debugging: Print the SQL query
echo $sql; // This will help you see the actual query being executed

$result = $conn->query($sql);

// Check for errors in the query execution
if (!$result) {
  die("Query failed: " . $conn->error);
}


?>

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Ordered iPhone</h1>
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
                  <h5 class="card-title">Ordered List</h5>
                </div>
                <div>
                  <button class="btn btn-primary btn-sm mt-4 mx-3">Add Order</button>
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

<!-- Pagination Links -->
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item <?= ($page <= 1) ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">Previous</a>
        </li>
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
            </li>
        <?php endfor; ?>
        <li class="page-item <?= ($page >= $total_pages) ? 'disabled' : '' ?>">
            <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next</a>
        </li>
    </ul>
</nav>

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

  <!-- Modal For Create -->
<div class="modal fade" id="addIphoneModal"  tabindex="-1" aria-labelledby="addIphoneModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addIphoneModalLabel">Add New Order</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="database/create.php">
          <div class="form-group">
          <label for="Variants">Variants:</label>
            <select class="form-control" id="Variants" name="Variants" required>
              <option value="iPhone16">iPhone 16</option>
              <option value="iPhone16Pro">iPhone 16 Pro</option>
              <option value="iPhone16ProMax">iPhone 16 Pro Max</option>
            </select>
          </div>
          <div class="form-group">
            <label for="Colors">Colors:</label>
            <select class="form-control" id="Colors" name="Colors" required>
            <option value="Black">iPhone16-Black</option>
              <option value="White">iPhone16-White</option>
              <option value="Teal">iPhone16-Teal</option>
              <option value="Pink">iPhone16-Pink</option>
              <option value="Ultramarine">iPhone16-Ultramarine</option>
              <option value="Black Titanium">iPhone16Pro-Black Titanium</option>
              <option value="White Titanium">iPhone16Pro-White Titanium</option>
              <option value="Desert Titanium">iPhone16Pro-Desert Titanium</option>
              <option value="Natural Titanium">iPhone16Pro-Natural Titanium</option>
              <option value="Black Titanium">iPhone16ProMax-Black Titanium</option>
              <option value="White Titanium">iPhone16ProMax-White Titanium</option>
              <option value="Desert Titanium">iPhone16ProMax-Desert Titanium</option>
              <option value="Natural Titanium">iPhone16ProMax-Natural Titanium</option>
            </select>
          </div>

          <div class="form-group">
            <label for="Storage">Storage:</label>
            <select class="form-control" id="Storage" name="Storage" required>
              <option value="128GB">iPhone16 128GB</option>
              <option value="256GB">iPhone16 256GB</option>
              <option value="512GB">iPhone16 512GB</option>
              <option value="128GB">iPhone16Pro 128GB</option>
              <option value="256B">iPhone16Pro 256B</option>
              <option value="512GB">iPhone16Pro 512GB</option>
              <option value="1TB">iPhone16Pro 1TB</option>
              <option value="256B">iPhone16ProMax 256B</option>
              <option value="512GB">iPhone16ProMax 512GB</option>
              <option value="1TB">iPhone16ProMax 1TB</option>
            </select>
          </div>

          <div class="form-group">
            <label for="Price">Price:</label>
            <select class="form-control" class="form-control" id="Price" name="Price" required>
              <option value="₱45,265">iPhone16 128GB-₱45,265</option>
              <option value="₱50,970">iPhone16 256GB-₱50,970</option>
              <option value="₱62,260">iPhone16 512GB-₱62,260</option>
              <option value="₱56,749">iPhone16Pro 128GB-₱56,749</option>
              <option value="₱62,260">iPhone16Pro 256B-₱62,260</option>
              <option value="₱73,550">iPhone16Pro 512GB-₱73,550</option>
              <option value="₱84,840">iPhone16Pro 1TB-₱84,840</option>
              <option value="₱67,900">iPhone16ProMax 256B-₱67,900</option>
              <option value="₱79,190">iPhone16ProMax 512GB-₱79,190</option>
              <option value="₱90,480">iPhone16ProMax 1TB-₱90,480</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary mt-3">Add</button><br>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </form>
      </div>
    </div>
  </div>
</div>
 <!-- Modal for View -->
<div class="modal fade" id="viewIphoneModal" tabindex="-1" aria-labelledby="viewIphoneModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewIphoneModalLabel">View iPhone</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Information Fields -->
        <p><strong>ID:</strong> <span id="view-id"></span></p>
        <p><strong>Variants:</strong> <span id="view-Variants"></span></p>
        <p><strong>Colors:</strong> <span id="view-Colors"></span></p>
        <p><strong>Storage:</strong> <span id="view-Storage"></span></p>
        <p><strong>Price:</strong> <span id="view-Price"></span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<!--  Modal for Delete-->
<div class="modal fade" id="deleteIphoneModal" tabindex="-1" aria-labelledby="deleteIphoneModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteIphoneModalLabel">Delete Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this record?</p>
      </div>
      <div class="modal-footer">
        <form id="delete-iphone-form" method="post" action="database/delete.php">
          <input type="hidden" name="id" id="delete-id">
          <input type="hidden" name="current_page" value="<?= $page ?>">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- Include external JS file -->
<script src="assets/js/modal.js"></script>

<?php
include('partials\footer.php');
?>