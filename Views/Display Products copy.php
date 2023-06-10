<?php
include "../layout/head.php";

include "../Controllers/categories.php";
include "../Models/products.php";
include "../Models/categories.php";
include "../connection_credits.php";
include "../connection.php";
include "../validation.php";
$error_add;
$error_update;
if (isset($_GET['delete_id']) && !empty($_GET['delete_id'])) {
    DeleteCategory($_GET['delete_id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'  && !empty($_POST)) {
    
    if ($_GET['action'] === 'add') {
        // AddProductQuery($_POST);
      // Handle add form data here
      $error_add= $error['name'];

    } else if ($_GET['action'] === 'update') {
        $category_id = $_GET['category_id'];
        UpdateCategory($category_id, $_POST);
        // $error_update= $error['name'];
      // Handle update form data here
    }
  }
?>

<div class="container ">
    <h1 class="text-primary mx-auto w-50">Products</h1>
    <!-- <table class="table table-striped table-dark border-light  text-center table-bordered">
        <thead>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>price</th>
                <th>Category Name</th>
                <th>quantity</th>
                <th>image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
       <tbody>
            <?php
            $Products = DisplayProductsQuery();
            // var_dump(   $Products );
            foreach ($Products as $row) {
            ?>
            <tr>
               
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['price'] ?></td>
                <td><?= SelectCategoryByIdQuery( $row['category_id'] )   ?></td>
                <td><?= $row['quantity'] ?></td>
                <td> <img height="100"  width="100" src="../uploads/<?= $row['image'] ?>" alt=""> </td>
              
                <td><a href="" class="btn btn-warning edit-category" data-toggle="modal" data-target="#modelId"
                        data-category-id="<?= $row['id'] ?>">Edit</a></td>
                <td><a href="?delete_id=<?= $row['id'] ?>" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this category?')">Delete</a></td>
                        <?php     }   ?>
            </tr>
        </tbody>  
    </table> -->
    <div class="row ">
        <?php
            $Products = DisplayProductsQuery();
            // var_dump(   $Products );
            foreach ($Products as $row) {
            ?>
        <div class="col-3 mb-4">
            <div class="card h-100">
                <img height="300" src="../uploads/<?= $row['image'] ?>"
                    class="card-img-top border border-secondary rounded" alt="...">
                <div class="card-body">
                    <div class="top d-flex justify-content-between align-items-center">
                        <h5 class="card-title text-left "><?= $row['name'] ?></h5>
                        <h5 class="card-title text-right btn-primary p-2 rounded ">Stock : <?= $row['quantity'] ?></h5>
                    </div>
                    <div class="bottom d-flex justify-content-between align-items-center ">
                        <p class="card-text m-0">Category :<b> <?= SelectCategoryByIdQuery( $row['category_id'] )   ?> </b>
                        </p>
                        <p class="card-text btn-warning p-2 rounded ">Price : <b><?= $row['price'] ?> </b>
                        </p>

                    </div>
                </div>
            </div>
        </div>
        <?php     }   ?>

    </div>
</div>





</div>

<!-- Optional: Place to the bottom of scripts -->
<script>
    const editButtons = document.querySelectorAll('.edit-category');
    editButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            const categoryId = event.target.dataset.categoryId;
            const editUrl = `?action=update&category_id=${categoryId}`;
            document.querySelector('#modelId form').setAttribute('action', editUrl);
        });
    });

    // const myModal = new bootstrap.Modal(document.getElementById('modalId'), options)
</script>

<?php
include "../layout/footer.php"
?>