<h4> orders by <?= $user['username'] ?></h4>
          <table class="table table-stripped">
            <tr>
            <!-- <th> Detalis</th> -->
              <th>Order Id</th>
              <th>Date</th>
              <!-- <th>Total Amount</th> -->
            </tr>
            <?php foreach ( $orderdetails as $order) { ?>
              <tr>
                <!-- <td>
                  <a class="btn btn-primary" href="/Cafe_Project/Views/Admin/ChecksView.php?details=<?= $order['id'] ?>&&user=<?= $user['id'] ?>">Detalis of Order</a>
                </td> -->
                <td><?= $order['order_id'] ?></td>
                <td><?= $order['total_price'] ?></td>
              </tr>
             
            <?php } ?>
          </table>
     