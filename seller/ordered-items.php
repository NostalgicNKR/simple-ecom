<?php $titleOfPage = "Orders of My Products"; ?>

<link href="https://cdn.datatables.net/1.13.2/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<div class="container p-5 scrollarea">
<table id="orders" class="table table-striped border" style="width:100%">
        <thead>
            <tr>
                <th>Order ID</th>
				<th>Date</th>
                <th>Product Name</th>
                <th>Customer Name</th>
                <th>Total Price</th>
                <th>Status</th>
				<th>Actions</th>
            </tr>
        </thead>
        <tbody>
		<?php foreach($ordersOfMyProducts as $order) { ?>
            <tr>
                <td>#<?= $order['order_id'] ?></td>
				<td><?= getDateFromStamp($order['ordered_date']) ?></td>
                <td><?= $order['product_name'] ?></td>
                <td><?= $order['customer_name'] ?></td>
                <td><?= $order['total_amount'] ?></td>
				<td><?= $orderStatus[$order['order_status']] ?></th>
				<td>
				<?php if(($order['order_status'] == 4) || ($order['order_status'] == 5)) { ?>
				<?php } else { ?>
				<a href="?page=view-order.php&unique-order-id=<?= $order['id'] ?>" class="">Manage</a>
				<?php } ?>
				</td>
            </tr>
		<?php } ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/dataTables.bootstrap5.min.js"></script>
<script>
$(document).ready(function () {
    $('#orders').DataTable({
        order: [[1, 'desc']],
    });
});
</script>