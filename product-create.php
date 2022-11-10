<?php 
include 'header.php';
$cats = mysqli_query($conn, "SELECT id, name FROM category Order By name ASC");
$errors = [];
$image = '';

if (!empty($_FILES['iamge']['name'])) {
    $file = $_FILES['iamge'];
    $tmp_name = $file['tmp_name'];
    $image = $file['name'];
    move_uploaded_file($tmp_name, 'images/'.$image);
}

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sale = $_POST['sale'];
    $status = $_POST['status'];
    $content = $_POST['content'];
    $category_id = $_POST['category_id'];

    if (empty($name)) {
        $errors['name'] = 'Tên sản phẩm không được để trống';
    }

    if (empty($price)) {
        $errors['price'] = 'Giá sản phẩm không được để trống';
    }

    $sale = empty($sale) ? 0 : $sale;

    if (!is_numeric($sale)) {
        $errors['sale'] = 'Sale phải là giá trị số >= 0';
    }
    if ($sale < 0) {
        $errors['sale'] = 'Sale phải là giá trị >= 0';
    }

    if (!$errors) {
        // lệnh insert into
        $sql = "INSERT INTO product SET name='$name', price='$price', status='$status', category_id='$category_id',image = '$image', content='$content', sale='$sale'";

        if (mysqli_query($conn, $sql)) {
            header('location: index.php');
        } else {
            $errors['error'] = 'Thêm mới không thành công, vui lòng thử lại';
        }
    }

    // echo '<pre>';
    // print_r($errors);
    // echo '</pre>';
}
?>
<h1>THÊM MỚI SẢN PHẨM</h1>
<hr>
<form action="" method="POST" enctype="multipart/form-data">
    <?php if ($errors) : ?>
    <div class="alert alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <?php foreach($errors as $er) :?>
        <li><?= $er;?></li>
        <?php endforeach;?>
    </div>
    <?php endif;?>
    <div class="row">
        <div class="col-md-8">
            <div class="card text-left">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Tên sản phẩm</label>
                        <input type="text" class="form-control" name="name" placeholder="Tên sản phẩm">
                    </div>

                    <div class="form-group">
                        <label for="">Mô tả</label>
                        <textarea name="content" class="form-control" rows="10"
                            placeholder="Mô tả nội dung chi tiết..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu vào</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-left">
                <div class="card-body">

                    <div class="form-group">
                        <label for="">Danh mục</label>
                        <select name="category_id" class="form-control" required="required">
                            <option value="">Chọn danh mục</option>
                           <?php foreach($cats as $cat)  : ?>
                            <option value="<?=$cat['id'];?>"><?=$cat['name'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Giá sản phẩm</label>
                        <input type="text" class="form-control" name="price" placeholder="VD: 10000000">
                    </div>

                    <div class="form-group">
                        <label for="">Giảm giá</label>
                        <input type="text" class="form-control" name="sale" placeholder="VD: 10">
                    </div>

                    <div class="form-group">
                        <label for="">Trạng thái</label>

                        <div class="radio">
                            <label>
                                <input type="radio" name="status" value="1" checked>
                                Hiển thị
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="status" value="0">
                                Tạm ẩn
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Ảnh đại diện</label>
                        <input type="file" class="form-control" name="iamge">
                    </div>
                </div>
            </div>

        </div>
    </div>


</form>

<?php include 'footer.php';?>