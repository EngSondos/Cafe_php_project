
          <table class="table table-stripped">
            <tr>
            <th> Detalis</th>
              <th>Order Id</th>
              <th>Date</th>
              <!-- <th>Total Amount</th> -->
            </tr>

            <?php
            if(isset($orders)){
            foreach ($orders as $order) { ?>
              <tr>
                <td>
                  <a class="btn btn-primary" href="/Cafe_Project/Views/Admin/CheckOrders/ChecksView.php?details=<?= $order['id'] ?>&&user=<?= $user['id'] ?>">Detalis of Order</a>
                </td>
                <td><?= $order['id'] ?></td>
                <td><?= $order['created_at'] ?></td>
              </tr>
             
            <?php } }?>
          </table>
     