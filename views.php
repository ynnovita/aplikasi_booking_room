<?php require_once('config.php') ?>
<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT b.*,r.room,r.description FROM `bookings` b inner join `room_list` r on r.id = b.room_id inner join users u on u.id = b.user_id where b.id = '{$_GET['id']}' ");   
    foreach($row = $qry->fetch_assoc() as $k => $v){
        $$k = $v;
    }
}
?>
<style>
    #uni_modal .modal-content>.modal-footer{
        display:none;
    }
</style>
<p><b>Order Date:</b> <?php echo $date_created ?></p>
<p><b>Room:</b> <?php echo $room ?></p>
<p><b>Details:</b> <span class="truncate"><?php echo strip_tags(stripslashes(html_entity_decode($description))) ?></span></p>
<p><b>Schedule:</b> <?php echo date("d F Y H:i",strtotime($date_in)).' - '.date("d F Y H:i",strtotime($date_out)) ?></p>
<p><b>Adults:</b> <?php echo ($adults) ?></p>
<p><b>Total Payment:</b> <?php echo $total_amount ?></p>
<p><b>Status:</b> 
    <?php if($row['status'] == 0): ?>
        <span class="badge badge-secondary">Pending</span>
    <?php elseif($row['status'] == 1): ?>
        <span class="badge badge-primary">Approved</span>
    <?php elseif($row['status'] == 2): ?>
        <span class="badge badge-danger">Cancelled</span>
    <?php elseif($row['status'] == 3): ?>
        <span class="badge badge-success">Done</span>
    <?php endif; ?>
</p>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
</div>

