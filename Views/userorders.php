
<?php




include '../Controllers/order_controller.php';
include 'layout.php';




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
      <!-- <th scope="col">Action</th> -->
      <th scope="col">Products</th>


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
          <?php foreach ($order['products'] as $product): ?>
            <div>
              <?php echo $product['quantity']; ?> x <?php echo $product['name']; ?> - <?php echo $product['price']; ?>
              <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" width="50">
            </div>
          <?php endforeach; ?>
        </td>
 

      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</div>
