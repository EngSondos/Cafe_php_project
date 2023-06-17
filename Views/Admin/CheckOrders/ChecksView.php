<link rel="stylesheet" href = "../../../layout/CSS/orders.css">

<?php
include '../../../connection_credits.php';
include '../../../connection.php';
include "../../../Models/AdminOrder.php";
include "../../../Controllers/AdminController.php";
include "../../../layout/head.php";
include "../../../Validation/adminChecksValidation.php";
include "../../../MiddleWares/auth.php";
include "../../../MiddleWares/admin.php";


$users = getAllUser();
if (!empty($_GET['orders'])) {
  $orders =   filter($_GET['orders']);
}

if (!empty($_GET['details'])) {
  $orderdetails =  getDetalisOfOrder($_GET['details'], $_GET['user']);
}

if(!empty($_POST)){
  $orders = filterOrderByUserAndDate($_POST);
  // var_dump($orders);
}
?>
<main style="width:80%;margin-left:auto">
 <div class="container">
  <div class="row mt-5 ">
    <div class="col-6 my-auto checktext"><h2>Checks Orders</h2></div>
    <div class="col-6" >
      <form method ="post">
        <div class="d-flex">
          <div class="form-group me-3 w-25">
            <label for="start_date">Start Date</label>
            <input class="form-control " id="start_date" name="start_date" placeholder="Date From" type="date"
            value = "<?=$_POST['start_date'] ?? ""?>"
            />

          </div>
          <div class="form-group w-25">
          <label for="start_date">End Date</label>

            <input class="form-control" id="end_date" name="end_date" placeholder="Date To" type="date" 
            value = "<?=$_POST['end_date'] ?? ""?>"
            />

          </div>

        </div>
        <div class="form-group m-3 w-50 ">
        <label for="user">Choose User</label>

          <select class="form-control" name="user" placeholder="select user">
            <option></option>
            <?php foreach ($users as $user) { ?>
              <option value="<?= $user['id'] ?>"
             <?php 
             if(isset($_POST['user'])){
             if($user['id']==$_POST['user'])
             echo "selected";
             }
             ?>
              > <?= $user['username'] ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group "> <!-- Submit button -->
          <button class="colorbtn" name="submit" type="submit"><i class="fa fa-search"></i></button>
        </div>
      </form>
    </div>

  </div>

  <?php if (empty($_POST)) { ?>

    <div class="row mt-5">
      <?php if (empty($_GET['orders']) && empty($GET['user']) && empty($_GET['details'])) { ?>
        <table class="table table-striped border ">
          <tr>
            <th>show orders
            <th>User Name</th>
            <th>Total Amount</th>
          </tr>
          <?php foreach ($users as $user) { ?>
            <tr>
              <td>

                <form>
                  <button class="colorbtn" name="orders" value="<?= $user['id'] ?>"><i class="fa fa-eye"></i></button>
                </form>
              </td>
              <td><?= $user['username'] ?></td>
              <td><?= totalAmount($user['id'] )?></td>
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
      <?php } else {?>
     

        <div class="row mt-5">
      <?php  include "./checkordertable.php";
      ?>

        </div>

      <?php } ?>


    </div>
    </main>

    <?php
    include "../../../layout/footer.php";
    ?>