<?php require_once('config.php') ?>
<?php
$i=1;
$qry = $conn->query("SELECT b.*,r.room FROM `bookings` b inner join `room_list` r on r.id = b.room_id where b.user_id ='".$_settings->userdata('id')."' order by date(b.date_created) desc ");    
foreach($qry->fetch_assoc() as $k => $v){
        $$k=$v;
    }
?>
<style>
    #uni_modal .modal-content>.modal-footer{
        display:none;
    }
</style>
<p><b>Room:</b> <?php echo $room ?></p>
<p><b>Details:</b> 
<p><b>Schedule:</b> <?php echo date("d F, Y H:i",strtotime($date_in)).' - '.date("d F, Y H:i",strtotime($date_out)) ?></p>
<?php if(!empty($accommodation_ids)): ?>
<p><b>Payment Method:</b>
<?php 
$accom = "";
$qry2 = $conn->query("SELECT * FROM accommodations where id in ({$accommodation_ids}) order by accommodation asc");
while($row= $qry2->fetch_assoc()):
    if(!empty($accom)) $accom .= ", ";
    $accom .= $row['accommodation'];
endwhile;
echo $accom;
?>
<?php ?>
</p>
<?php endif; ?>
<p><b>Status:</b>
<td name="status" id=""class="text-center">
    <?php if($row['status'] == 0): ?>
        <span class="badge badge-secondary">Pending</span>
    <?php elseif($row['status'] == 1): ?>        
        <span class="badge badge-primary">Approved</span>
    <?php elseif($row['status'] == 2): ?>
        <span class="badge badge-danger">Cancelled</span>
    <?php elseif($row['status'] == 3): ?>
        <span class="badge badge-success">Done</span>
    <?php endif; ?>
</td>
</p>

<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
</div>

<script>
    $(function(){
        $('#book-status').submit(function(e){
            e.preventDefault();
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_book_status",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                error:err=>{
                    console.log(err)
                    alert_toast("an error occured",'error')
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        location.reload()
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                    }
                    end_loader()
                }
            })
        })
    })
</script>