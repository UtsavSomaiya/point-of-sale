<?php
session_start();
include '../layout/header.php';
require '../layout/db_connect.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $fetch = $pdo->prepare("select * from product where id='$id'");
    $fetch->execute();
    $result = $fetch->fetchAll();
    foreach ($result as $r) {
        $name = $r['name'];
        $price = $r['price'];
        $category = $r['category'];
        $text = $r['text'];
        if (empty($_FILES['image']['name'])) {
            $fname = $r['image'];
        } else {
            $fname = $_FILES['image']['name'];
        }
    }
}
if (isset($_POST['submit'])) {
    if (!empty($_POST['pname']) && !empty($_POST['price'])) {
        if (is_numeric($_POST['price'])) {
            $pname = $_POST['pname'];
            $price = $_POST['price'];
            $category = $_POST['category'];
            $text = $_POST['text'];
            $fetch = $pdo->prepare("update product set name='$pname', price='$price', category=$category, text='$text',image='$fname' where id='$id'");
            $result = $fetch->execute();
            if (isset($result)) {
                $_SESSION['msg'] = "Update Successfully";
                header('location:../product/show_product.php');
            } else {
                $_SESSION['msg'] = 'No';
                header('location:../product/edit_product.php');
            }
        } else {
            $price_alert = "Enter Only Numeric Value";
        }
    } else {
        $alert = "Please enter the data..";
    }
}
if (isset($_POST['cancel'])) {
    header('location:/admin/product/show_product.php');
}
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Product</h4>
                        <form class="forms-sample" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="hidden" name="id" value="<?= $id; ?>">
                                <label for="exampleInputUsername1">Product Name</label>
                                <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Product Name" name="pname" value="<?= $name; ?>">
                                <label style="color:red;">
                                    <?php
                                    if (isset($alert)) {
                                        echo $alert;
                                    }
                                    ?>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Product Price</label>
                                <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Product Price" name="price" value="<?= $price; ?>">
                                <label style="color:red;">
                                    <?php
                                    if (isset($price_alert)) {
                                        echo $price_alert;
                                    }
                                    ?>
                                </label>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Select Category</label>
                                <select class="form-control" id="exampleSelectGender" name="category">
                                    <option value="">--Select Category--</option>
                                    <?php
                                    $fetch = $pdo->prepare("select * from category");
                                    $fetch->execute();
                                    $res = $fetch->fetchAll();
                                    foreach ($res as $category) {
                                    ?>
                                        <option value="<?= $category['name'] ?>" <?php
                                                                                    if ($category == $category['name']) {
                                                                                        echo "selected='selected'";
                                                                                    } ?>><?= $category['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleSelectGender">Select Product Text</label>
                                <select class="form-control" id="exampleSelectGender" name="text">
                                    <option value="">--Select Text--</option>
                                    <option value="5" <?php if ($text == "5") echo 'selected="selected"'; ?>>5%</option>
                                    <option value="10" <?php if ($text == "10") echo 'selected="selected"'; ?>>10%</option>
                                    <option value="15" <?php if ($text == "15") echo 'selected="selected"'; ?>>15%</option>
                                    <option value="20" <?php if ($text == "20") echo 'selected="selected"'; ?>>20%</option>
                                    <option value="25" <?php if ($text == "25") echo 'selected="selected"'; ?>>25%</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1" style="margin-right: 20px;">Image</label>
                                <img class="img-xs rounded-circle" src="<?= '/admin/images/' . $fname ?>"><br><br>
                                <input type="file" class="form-control" accept="" name="image">
                            </div>
                            <button type="submit" class="btn btn-primary me-2" name="submit" onclick="toast()">Submit</button>
                            <button class="btn btn-light" name="cancel">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../layout/footer.php'; ?>