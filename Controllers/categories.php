<?php 
// session_start();
// include_once '../Views/categories.php';
// $category_id;
// var_dump($_SESSION["category_id"]);
function getCategoryId ($id){
    ?> <script>
    alert($id);
</script>


<?php 
global $category_id;
global $row;

$categories = DisplayCategory();
foreach ($categories as $category){
if($category['id'] == $id){
    // $category_id = $category['id'];
$_SESSION['category_id'] = $category['id'];
// echo $_SESSION['category_id'];
    // return $category['id'];
    echo $category['id'];
}
}


}
?>

