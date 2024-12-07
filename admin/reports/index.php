<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title">Detailed of Transactions</h3>
    </div>
    
	<div class="card-body">
        <div class="d-flex align-items-center mb-2">
            <div class="col-4">
                <div class="form-group">
                    <label><b>View:</b></label><br>
                    <input type="radio" name="status" value="0" id="status-pending">&nbsp;Pending&nbsp;
                    <input type="radio" name="status" value="1" id="status-confirmed">&nbsp;Confirmed&nbsp;
                    <input type="radio" name="status" value="3" id="status-done">&nbsp;Done&nbsp;
                    <input type="radio" name="status" value="all" id="status-all" checked>&nbsp;All&nbsp;
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="start_date"><b>Start Date:</b></label><br>
                    <input type="date" name="start_date" id="start_date" class="form-control">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label for="end_date"><b>End Date:</b></label><br>
                    <input type="date" name="end_date" id="end_date" class="form-control">
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                    <label><b>Search:</b></label><br>
                    <button class="btn btn-primary form-control" type="submit" name="search" id="search"><i class="fas fa-search"></i> Search</button>
                </div>
            </div>
            <div class="col-2">
                <div class="form-group">
                <form action="cetak.php" method="post">
                    <label><b>Print:</b></label><br>
                    <a href="reports/cetak.php" data-id="<?php echo $start_date;?><?php echo $end_date; ?>"><target="_blank" alt="Edit Data" class="btn btn-warning btn-primary form-control"><span class="fas fa-print"></span> Print</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <table class="table table-striped text-dark" id="status">
                <colgroup>
                    <col width="5%">
                    <col width="13%">
                    <col width="15%">
                    <col width="10%">
                    <col width="25%">
                    <col width="11%">
                    <col width="11%">
                </colgroup>
                <thead>
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
                    <tr data-status="<?php echo $row['status'] ?>" data-date="<?php echo date("Y-m-d", strtotime($row['date_created'])) ?>">
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
                        <td>Rp.<?php echo number_format($row['total_amount']) ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
		</div>
	</div>
</div>
<script>
    function filterStatusAndDate() {
        const selectedStatus = document.querySelector('input[name="status"]:checked').value;
        const startDate = document.getElementById("start_date").value;
        const endDate = document.getElementById("end_date").value;
        const rows = document.querySelectorAll("#status tbody tr");

        rows.forEach(row => {
            const rowDate = row.getAttribute("data-date");
            const rowStatus = row.getAttribute("data-status");

            // Initialize visibility
            let showRow = true;

            // Check if a date range is set
            if (startDate && endDate) {
                // If dates are provided, filter by date range
                if (rowDate < startDate || rowDate > endDate) {
                    showRow = false; // Hide if the row date is outside the range
                }
            }

            // Further filter by status
            if (selectedStatus !== 'all' && row.getAttribute('data-status') !== selectedStatus) {
                showRow = false; // Hide if status does not match
            }

            // Set display based on the combined conditions
            row.style.display = showRow ? '' : 'none';
        });
    }

    // Event listeners for status radio buttons
    document.querySelectorAll('input[name="status"]').forEach(radio => {
        radio.addEventListener('change', filterStatusAndDate);
    });

    // Search button event listener
    document.getElementById("search").addEventListener("click", function() {
        filterStatusAndDate();  // Filter by both status and date when searching
    });

    // Initial filtering on page load
    filterStatusAndDate();

    function filterStatus() {
        const selectedStatus = document.querySelector('input[name="status"]:checked').value;
        const rows = document.querySelectorAll("#status tbody tr");

        rows.forEach(row => {
            if (selectedStatus === 'all') {
                row.style.display = ''; // Tampilkan semua jika 'All' dipilih
            } else {
                row.style.display = row.getAttribute('data-status') === selectedStatus ? '' : 'none';
            }
        });
    }
    document.querySelectorAll('input[name="status"]').forEach(radio => {
        radio.addEventListener('change', filterStatus);
    });

    filterStatus();

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