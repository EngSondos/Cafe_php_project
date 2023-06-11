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
    var_dump($_GET['delete_id']);
    DeleteProductQuery($_GET['delete_id']);
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

<div class="container w-50">
    <h1 class="text-primary mx-auto w-50">Products</h1>
    <table class="table table-striped table-dark border-light  text-center table-bordered">
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
    </table>
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