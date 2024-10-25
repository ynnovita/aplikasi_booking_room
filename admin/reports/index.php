<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Detailed of Transactions</h3>
		<div class="card-tools">
			<a href="cetak.php?act=print" class="btn btn-warning btn-primary"><span class="fas fa-print"></span>  Print</a>
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
        <div class="container-fluid">
            <table class="table table-stripped text-dark">
                <colgroup>
                    <col width="5%">
                    <col width="10">
                    <col width="15">
                    <col width="25">
                    <col width="20">
                    <col width="5">
                    <col width="5">
                </colgroup>
                <thead>
                <div class="col-6 text-right">
                            View:
                            <input type="radio" name="viewOption" value="confirmed">&nbsp;Confirmed&nbsp;
                            <input type="radio" name="viewOption" value="done">&nbsp;Done
                            <input type="radio" name="viewOption" value="pending">&nbsp;Pending
                            <input type="radio" name="viewOption" value="all">&nbsp;All
                        </div>
                    <tr>
                        <th>#</th>
                        <th>DateTime</th>
                        <th>User</th>
                        <th>Room</th>
                        <th>Schedule</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
				    $i = 1;
                        $qry = $conn->query("SELECT b.*,r.room,concat(u.firstname,' ',u.lastname) as name FROM `bookings` b inner join `room_list` r on r.id = b.room_id inner join users u on u.id = b.user_id order by date(b.date_created) desc ");
                    while($row= $qry->fetch_assoc()):
				    ?>
                    <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
                        <td><?php echo $row['name'] ?></td>
                        <td><?php echo $row['room'] ?></td>
                        <td><?php echo date("Y-m-d H:i",strtotime($row['date_in'])).' - '.date("Y-m-d H:i",strtotime($row['date_out'])) ?></td>
                        <td class="text-center">
                            <?php if($row['status'] == 0): ?>
                                <span class="badge badge-warning">Pending</span>
                            <?php elseif($row['status'] == 1): ?>
                                <span class="badge badge-primary">Confirmed</span>
                            <?php elseif($row['status'] == 2): ?>
                                <span class="badge badge-danger">Cancelled</span>
                            <?php elseif($row['status'] == 3): ?>
                                <span class="badge badge-success">Done</span>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $row['total_amount'] ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this booking permanently?","delete_booking",[$(this).attr('data-id')])
		})
        $('.view_data').click(function(){
            uni_modal("Booking Information","bookings/view.php?id="+$(this).attr('data-id'))
        })
		$('.table').dataTable();
	})
	function delete_booking($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_booking",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>