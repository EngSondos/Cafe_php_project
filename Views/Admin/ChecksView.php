<?php
include "../../connection.php";
include "../../Models/AdminOrder.php";
include "../../Controllers/AdminController.php";
include "../../layout/head.php";
include "../../Validation/adminChecksValidation.php";


$users = getAllUser();
if (!empty($_GET['orders'])) {
  $orders =   filter($_GET['orders']);
}

if (!empty($_GET['details'])) {
  $orderdetails =  getDetalisOfOrder($_GET['details'], $_GET['user']);
}

if(!empty($_POST)){
  $error = filterOrderByUserAndDate($_POST);
}
?>
 <div class="container">
  <div class="row mt-5">
    <div class="col-6 w-50">
      <form method ="post">
        <div class="d-flex">
          <div class="form-group mx-3">
            <input class="form-control" id="date" name="start_date" placeholder="Date From" type="date" />
            <div class="text-danger"><?= $error['Date From'] ?? ""?></div>

          </div>
          <div class="form-group">
            <input class="form-control" id="date" name="end_date" placeholder="Date To" type="date" />
            <div class="text-danger"><?= $error['Date To'] ?? ""?></div>

          </div>

        </div>
        <div class="form-group mx-3">

          <select class="form-control" name="user" placeholder="select user">
            <option></option>
            <?php foreach ($users as $user) { ?>
              <option value="<?= $user['id'] ?>"> <?= $user['username'] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group"> <!-- Submit button -->
          <button class="btn btn-primary " name="submit" type="submit">Submit</button>
        </div>
      </form>
    </div>

  </div>

  <?php if (empty($_POST)) { ?>

    <div class="row mt-5">
      <?php if (empty($_GET['orders']) && empty($GET['user']) && empty($_GET['details'])) { ?>
        <table class="table table-stripped">
          <tr>
            <th>show orders
            <th>
            <th>User Name</th>
            <th>Total Amount</th>
          </tr>
          <?php foreach ($users as $user) { ?>
            <tr>
              <td>

                <form>
                  <button class="btn btn-primary" name="orders" value="<?= $user['id'] ?>" data-bs-toggle="collapse" data-bs-target="#userorders">show</button>
                </form>
              </td>
              <td><?= $user['username'] ?></td>
              <td>10000</td>
            </tr>
          <?php } ?>
        </table>
      <?php } else if(empty($GET['user']) && empty($_GET['details'])) {
        include "./checkordertable.php";
         } if(!empty($_GET['details'])){
          include "./orderdetails.php"
          ?>

        <?php } ?>
        </div>
      <?php } else {  ?>

        <div class="row mt-5">


        </div>

      <?php } ?>


    </div>


    <?php
    include "../../layout/footer.php";
    ?>