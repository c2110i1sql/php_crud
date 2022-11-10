<?php 
include 'header.php'; 
$products = mysqli_query($conn, "SELECT * FROM product Order By name ASC");

?>

<h1>Quản lý sản phẩm</h1>
<hr>
<form action="" method="POST" class="form-inline" role="form">

    <div class="form-group">
        <label class="sr-only" for="">label</label>
        <input type="email" class="form-control" id="" placeholder="Input field">
    </div>

    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
    <a href="product-create.php" class="btn btn-success ml-1">Thêm mới</a>
</form>
<hr>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-center">Id</th>
            <th>Name</th>
            <th>Price/ Sale</th>
            <th>Status</th>
            <th>Created Date</th>
            <th>Image</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($products as $pro) : ?>
        <tr>
            <td class="text-center"><?=$pro['id'];?></td>
            <td>
                <a href="#" data-toggle="tooltip" data-placement="top" title="Edit this item"><?=$pro['name'];?></a>
                <br>
                <b>Category: </b> <?=$pro['category_id'];?>
            </td>
            <td>
            <?= number_format($pro['price']);?> / <span class="badge badge-success"><?=$pro['sale'];?>%</span>
            </td>
            <td><span>Ản</span></td>
            <td><?=$pro['created_at'];?></td>
            <td>
                <img width="60" src="images/<?=$pro['image'];?>" alt="">
            </td>
            <td class="text-right">
                <a href="" class="btn btn-sm btn-primary">Edit</a>
                <a href="" class="btn btn-sm btn-danger">Delete</a>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<?php include 'footer.php'; ?>