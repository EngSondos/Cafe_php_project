<?php
    $pageTitle = 'Edit Users';
    include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/config/connectToDB.php';
    include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/head.php';
    session_start();

    $do = $_GET['do'];
        if ($do == 'edit') { 
            // check if request userid is numeric & get the integer value of it
            $userid = isset($_GET['id']) && is_numeric($_GET['id']) ? intval($_GET['id']) : 0;
        }
            $conn = connect();
            // To Get All Data From DataBase
            $stmt = $conn->prepare("SELECT * FROM users WHERE id = ? LIMIT 1");
            // Execute query
            $stmt->execute(array($userid));
            // fetch the data
            $row = $stmt->fetch();
            // the row count
            $count = $stmt->rowCount();
            // if there's such id show the form
            if ($stmt->rowCount() > 0) { ?>
                <h1 class="text-center">Edit User</h1>
                <div class="container">
                    <form class="form-horizontal" action="" method="POST">
                        <!-- <input type="hidden" name="userid" value="<?php echo $userid ?>" /> -->
                        <!-- Start Username Field -->
                        <div class="form-group">
                            <lable class="col-sm-2 control-lable">Username</lable>
                            <div class="col-sm-10 col-md-5">
                                <input type="text" name="username" value="<?php echo $row['username'] ?>" class="form-control" autocomplete="off" />
                            </div>
                        </div>
                        <!-- End Username Field -->
                        <!-- Start Password Field -->
                        <div class="form-group">
                            <lable class="col-sm-2 control-lable">Password</lable>
                            <div class="col-sm-10 col-md-5">
                                <input type="hidden" name="oldpassword" value="<?php echo $row['password'] ?>" />
                                <input type="password" name="newpassword" class="form-control" autocomplete="off" placeholder="If You Don't need to Change The Password Take This Empty" />
                            </div>
                        </div>
                        <!-- End Password Field -->
                        <!-- Start Email Field -->
                        <div class="form-group">
                            <lable class="col-sm-2 control-lable">Email</lable>
                            <div class="col-sm-10 col-md-5">
                                <input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>" autocomplete="off" />
                            </div>
                        </div>
                        <!-- End Email Field -->
                        <!-- Start Fullname Field -->
                        <div class="form-group form-group-lg">
                            <lable class="col-sm-2 control-lable">Role</lable>
                            <div class="col-sm-10 col-md-5">
                                <select name="role" id="" class="form-control">
                                    <option value="<?php echo $row['role'] ?>"><?php echo $row['role'] == 0 ? 'Normal User' : 'Admin' ?></option>
                                    <option value="0">Normal User</option>
                                    <option value="1">Admin</option>
                                </select>
                            </div>
                        </div>
                        <!-- End Fullname Field -->
                        <!-- Image -->
                        <div class="form-group">
                            <lable class="col-sm-2 control-lable">Image</lable>
                            <div class="col-sm-10 col-md-5">
                                <input type="file" name="image" class="form-control" value="<?php echo $row['image'] ?>" autocomplete="off" />
                            </div>
                        </div>
                        <!-- Start Button Field -->
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <input type="submit" value="Save" class="btn btn-primary">
                            </div>
                        </div>
                        <!-- End Button Field -->
                    </form>
                </div>
    <?php
    }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                include 'update.php';
                updateUser($_POST, $_FILES);
        }
    else {
            
            echo '<div class="container">'; 
            
            $theMsg = '<div class="alert alert-danger">Error: Theres No Such ID</div>';

            // header('Location:listAllUsers.php');
            
            echo '</div>';
        }
    
    include $_SERVER["DOCUMENT_ROOT"].'/Cafe_php_project/layout/footer.php';
 ?>