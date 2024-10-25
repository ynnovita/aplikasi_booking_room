<?php require_once('config.php') ?>
<?php
$qry = $conn->query("SELECT * from `room_list` where id = '{$_GET['room_id']}' ");
if($qry->num_rows > 0){
    foreach($qry->fetch_assoc() as $k => $v){
        $$k=$v;
    }
}
?>
<div class="container-fluid">
    <form action="" id="book-form">
        <input name="room_id" type="hidden" value="<?php echo $_GET['room_id'] ?>" >
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="control-label">Check In</label>
                    <input type="datetime-local" class='form form-control' required   name='date_in'>
                </div>
                <div class="form-group">
                    <label for="control-label">Check Out</label>
                    <input type="datetime-local" class='form form-control' required   name='date_out'>
                </div>
            </div>
            <div class="col-md-6">
                <h5>Payment Method</h5>
                <hr>
                <div class="row row-cols-2">
                <?php 
                $accom = $conn->query("SELECT * FROM `accommodations` order by `accommodation` asc");
                while($row = $accom->fetch_assoc()):
                    $row['description'] = strip_tags(stripslashes(html_entity_decode($row['description'])));
                ?>
                <div class="col">
                    <div class="callout callout-info p-1">
                        <span>
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="accom_<?php echo $row['id'] ?>" value="<?php echo $row['id'] ?>" name="accom_id[]" data-price="<?php echo $row['price'] ?>" >
                                <label for="accom_<?php echo $row['id'] ?>">
                                    <b><?php echo $row['accommodation'] ?></b>
                                </label>
                            </div>
                        </span>
                        <span class="float-right" title="<?php echo $row['description'] ?>"><i class="fa fa-question-circle text-info"></i></span>
                        <p class="m-0 text-right"><b><?php echo number_format($row['price']) ?></b></p>
                        
                    </div>
                </div>
                <?php endwhile; ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h4>Total</h4>
                <table class="table">
                    <colgroup>
                            <col width="50%">
                            <col width="50%">
                    </colgroup>
                    <tr>
                        <td>Room Rate</td>
                        <td class="text-right" id="room_rate"><?php echo number_format($price) ?></td>
                    </tr>
                    <tr>
                        <td>Duration</td>
                        <td class="text-right" id="hours"><?php echo 0 ?></td>
                    </tr>
                    <tr class="border-top">
                        <td>Room Rate Sub Total <input type="hidden" name="room_rate_sub" value="0"></td>
                        <td class="text-right" id="room_sub_total"><?php echo number_format($price) ?></td>
                    </tr>
                    <tr>
                        <td>Payment Method <input type="hidden" name="accommodation_sub" value="0"></td>
                        <td class="text-right" id="accom_total"><?php echo 0 ?></td>
                    </tr>
                    <tr class="border-top">
                        <td>Grand Total <input type="hidden" name="total_amount" value="0"></td>
                        <td class="text-right" id="total"><?php echo 0 ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
</div>
<script>
    function hours_between(date1, date2) {

        // Here are the two dates to compare
        var date1 = date1;
        var date2 = date2;

        // First we split the values to arrays date1[0] is the year, [1] the month and [2] the day
        date1 = date1.split('T');
        date2 = date2.split('T');

         // Create Date objects for both dates
         var date1_obj = new Date(date1[0] + ' ' + date1[1]);
         var date2_obj = new Date(date2[0] + ' ' + date2[1]);

         // Calculate the difference in milliseconds
         var difference_ms = Math.abs(date2_obj.getTime() - date1_obj.getTime());

        // The number of milliseconds in one day
        var ONE_HOUR = 1000 * 60 * 60; 
        
        // Calculate difference in hours
        var timeDifferenceInHours = Math.round(difference_ms / ONE_HOUR);
        return timeDifferenceInHours;
    }
    
    function calc_total(){
        var room_rate_sub, accom_sub,grand_total =0;
        var room_rate = $('#room_rate').text()
            room_rate = room_rate.replace(/,/g,'')
        var hours = parseFloat($('#hours').text());
            room_rate_sub = parseFloat(room_rate) * hours;
            accom_sub = $('#accom_total').text()
            accom_sub = parseFloat(accom_sub.replace(/,/g,''))
            grand_total =  room_rate_sub + accom_sub
            $('#total').text(parseFloat(grand_total).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2}))
            $('#room_sub_total').text(parseFloat(room_rate_sub).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2}))
            $('[name="room_rate_sub"]').val(room_rate_sub)
            $('[name="total_amount"]').val(grand_total)
            $('[name="accommodation_sub"]').val(accom_sub)
    }
    $(function(){
        $('[name="accom_id[]"]').each(function(){
            $(this).change(function(){
                var accom_sub = $('#accom_total').text()
                    accom_sub = parseFloat(accom_sub.replace(/,/g,''))
                    if($(this).is(':checked') == true){
                        accom_sub = parseFloat(accom_sub) + parseFloat($(this).attr('data-price'))
                    }else{
                        accom_sub = parseFloat(accom_sub) - parseFloat($(this).attr('data-price'))

                    }
                    $('#accom_total').text(parseFloat(accom_sub).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2}))
                    calc_total()
            })
        })
        $('[name="date_in"],[name="date_out"]').on('change input',function(){
            if($('[name="date_in"]').val() != '' && $('[name="date_out"]').val() != ''){
                var hours = hours_between($('[name="date_in"]').val(),$('[name="date_out"]').val())
                $('#hours').text(hours)
                calc_total()
            }
        })
        $('#book-form').submit(function(e){
            e.preventDefault();
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Master.php?f=book_room",
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
                        alert_toast("Booking Request Successfully sent.")
                        $('.modal').modal('hide')
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