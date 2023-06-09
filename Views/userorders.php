<?php
include '../layout.php';
include '../Controllers/order_controller.php';

if (!isset($_POST['start_date']) && !isset($_POST['end_date'])) {
  $orders = all();
} else {
  $startDate = $_POST['start_date'];
  $endDate = $_POST['end_date'];
  $orders = filterorder( $startDate, $endDate);
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
        <tr>
          <td scope="row"><?php echo $order['id']; ?></td>
          <td><?php echo $order['total_price']; ?></td>
          <td><?php echo $order['status']; ?></td>
          <td><?php echo $order['created_at']; ?></td>
          <td>
            <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#order-<?php echo $order['id']; ?>">View Products</button>
          </td>
        </tr>
        <tr id="order-<?php echo $order['id']; ?>" class="collapse">
          <td colspan="5">
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