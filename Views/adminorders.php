<?php
// include '../layout.php';
include "../layout/head.php";
include '../Controllers/order_controller.php';
include "../Controllers/AdminController.php";
include "../Models/AdminOrder.php";
include "../connection_credits.php";
include "../connection.php";
include "../MiddleWares/auth.php";
include "../MiddleWares/admin.php";


    $orders = allorders();

    if(isset($_GET['status'])&&isset($_GET['id']))
    {
  
     ChangeOrderStatus($_GET['id'],$_GET['status']);
     header("location:/Cafe_php_project/Views/adminorders.php");
    }

?>

<div class="container">
  <h2>View Orders</h2>

  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Order ID</th>
        <th scope="col">Total Price</th>
        <th scope="col">Status</th>
        <th scope="col">User</th>
        <th scope="col">Created At</th>
        <th>Change Status</th>

      </tr>
    </thead>
    <tbody>
      <?php foreach ($orders as $order): ?>
        
        <tr class="order-row" data-order-id="<?php echo $order['id']; ?>">
          <td scope="row"><?php echo $order['id']; ?></td>
          <td><?php echo $order['total_price']; ?></td>
          <td><?php echo $order['status']; ?></td>
          <td><?php echo $order['username']; ?></td>
          <td><?php echo $order['created_at']; ?></td>
          <td>
            <?php if(($order['status'] != 'canceled')){?>
            <form onclick="event.stopPropagation();" >
              <select onchange="changeStatus(<?=$order['id']?>);" id="status<?=$order['id']?>" class="form-control">
                  <option  <?=($order['status'] == 'complete') ? 'selected' : ''?> value="complete" >Compolete</option>
                  <option <?=($order['status'] == 'delivered') ? 'selected' : ''?>  value="delivered" >Delivered</option>
                  <option <?=($order['status'] == 'pending') ? 'selected' : ''?>  value="pending">Pending</option>
              </select>
            </form>
        <?php }  ?>
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

  function changeStatus(orderId) {
    window.location.href = "/Cafe_Project/Views/adminorders.php?id=" + orderId + "&status=" + document.getElementById("status"+orderId).value;
}
</script>