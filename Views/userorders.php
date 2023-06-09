
<?php



include '../layout.php';
include '../Controllers/order_controller.php';




ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);


// Get all orders
$orders = all();



?>


<div class="container">
  

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
