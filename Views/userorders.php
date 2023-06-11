<?php

session_start();


ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);
include '../layout.php';
include '../Controllers/order_controller.php';


// if (!isset($_SESSION['user_id'])) {
//   header('Location: login.html');
//   exit();
// }

$userId = $_SESSION['user_id'];

if (!isset($_POST['start_date']) && !isset($_POST['end_date'])) {
    $orders = usersorder($userId);
} else {
    $startDate = $_POST['start_date'];
    $endDate = $_POST['end_date'];
    $orders = filterorder($startDate, $endDate);
}


if (isset($_POST['cancel_order'])) {
    $orderId = $_POST['cancel_order'];
    $order = getById($orderId);
    if ($order['status'] == 'pending') {
        try {
          $stmt = $conn->prepare('UPDATE orders SET status = :status, deleted_at = :deleted_at WHERE id = :order_id');
          $status = 'canceled';
          $deleted_at = date('Y-m-d H:i:s');
          $stmt->bindParam(':status', $status);
          $stmt->bindParam(':deleted_at', $deleted_at);
          $stmt->bindParam(':order_id', $orderId);
          $stmt->execute();
            echo "<div class='alert alert-success' style='text-align: center' role='alert'>Order $orderId has been canceled.</div>";
        } catch(PDOException $e) {
            echo "<div class='alert alert-danger' style='text-align: center'role='alert'>Error canceling order $orderId.</div>";
        }
    } else {
        echo "<div class='alert alert-warning' style='text-align: center' role='alert'>Order $orderId cannot be canceled because it is not in 'pending' status.</div>";
    }
}
?>

<div class="container">
  <h2>View Orders</h2>
  <form method="post" action="">
    <div class="form-group">
      <label for="start_date">Start Date:</label>
      <input type="date" class="form-control" id="start_date" name="start_date">
    </div>
    <div class="form-group">
      <label for="end_date">End Date:</label>
      <input type="date" class="form-control" id="end_date" name="end_date">
    </div>
    <button type="submit" class="btn btn-primary">View Orders</button>
  </form>
  <br>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Total Price</th>
        <th scope="col">Status</th>
        <th scope="col">Created At</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($orders as $order): ?>
        <tr class="order-row" data-order-id="<?php echo $order['id']; ?>">
          <td scope="row"><?php echo $order['id']; ?></td>
          <td><?php echo $order['total_price']; ?></td>
          <td><?php echo $order['status']; ?></td>
          <td><?php echo $order['created_at']; ?></td>
          <td>

          <?php
          $disabled = '';
          if ($order['status'] !== 'pending') {
              $disabled = 'disabled';
          }
          ?>
                    <form method="post" action="" onclick="event.stopPropagation();">
                        <input type="hidden" name="cancel_order" value="<?php echo $order['id']; ?>">
                        <button type="submit" class="btn btn-danger" <?php echo $disabled; ?>>Cancel</button>
                    </form>
                </td>
        </tr>
        <tr class="products-container" id="products-<?php echo $order['id']; ?>" style="display:none;">
          <td colspan="4">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th scope="col">Product</th>
                  <th scope="col">Quantity</th>
                  <th scope="col">Price</th>

                </tr>
              </thead>
              <tbody>
                <?php foreach ($order['products'] as $product): ?>
                  <tr>
                    <td><?php echo $product['name']; ?></td>
                    <td><?php echo $product['quantity']; ?></td>
                    <td><?php echo $product['price']; ?></td>

                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>



<script>
  const orderRows = document.querySelectorAll('.order-row');

  orderRows.forEach(row => {
    const orderId = row.getAttribute('data-order-id');
    const productsContainer = document.querySelector(`#products-${orderId}`);

    row.addEventListener('click', () => {
      if (productsContainer.style.display === 'none') {
        productsContainer.style.display = 'table-row';
      } else {
        productsContainer.style.display = 'none';
      }
    });
  });
</script>