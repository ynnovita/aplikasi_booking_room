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
            <div class="form-group row">
                <div class="form-group">
                    <label for="control-label" class="col-md-9 col-form-label">Check In 
                        <span class="red-asterisk"> *</span>
                    </label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                            <input type="datetime-local" class="form form-control"  
                            name='date_in' min="<?php echo Util::dateToday('0'); ?>" required>
                        </div>
                    </div>

                    <label for="date_out" class="col-md-9 col-form-label">Check Out 
                        <span class="red-asterisk"> *</span>
                    </label>
                    <div class="col-md-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                            <input type="datetime-local" class="form-control" 
                            name='date_out' min="<?php echo Util::dateToday('0'); ?>" required>
                        </div>
                    </div>

                    <label class="col-md-9 col-form-label" for="room_type">Room Type</label>
                    <div class="col-md-9">
                        <span class="input-group-text">
                            <td class="text-right" id="room_type">Room <?php echo $_GET['room_id'] ?></td>
                        </span>
                    </div>

                    <label class="col-md-9 col-form-label" for="adults">Adults
                        <span class="red-asterisk"> *</span>
                    </label>
                    <div class="col-md-9">
                        <select required class="custom-select mr-md-2"  name="adults">
                            <option selected value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                <div class="form-group">
                    <a type="button" class="btn btn-primary check_policies" href="javascript:void(0)" class="btn btn-info">Check-in policies</a>     
                </div>
            </div>
            <hr>
            <div class="col-md-6 offset-md-3">
                <h4>Total</h4>
                <div class="row row-cols-1">
                <div class="callout callout-info p-1">
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
                        <td>Duration <input type="hidden" name="duration" value="0"></td>
                        <td class="text-right" id="hours"><?php echo 0 ?></td>
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
<?php
class Util{
    public static function dateToday($plus)
    {
        $dateToday = date("Y-m-d H:i");
        if ($plus != '0') {
            return date('Y-m-d H:i', strtotime($dateToday . ' + ' . $plus . ' hours'));
        }
        return date("Y-m-d H:i");
    }
}
?>
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
        var room_rate, grand_total =0;
        var room_rate = $('#room_rate').text()
            room_rate = room_rate.replace(/,/g,'')
        var hours = parseFloat($('#hours').text());
            grand_total = parseFloat(room_rate) * hours;

            $('#total').text(parseFloat(grand_total).toLocaleString('en-US',{style:'decimal',maximumFractionDigits:2}))
            $('[name="total_amount"]').val(grand_total)

    }
    $(function(){

        $('[name="date_in"],[name="date_out"]').on('change input',function(){
            if($('[name="date_in"]').val() != '' && $('[name="date_out"]').val() != ''){
                var hours = hours_between($('[name="date_in"]').val(),$('[name="date_out"]').val())
                $('#hours').text(hours)
                $('[name="duration"]').val(hours)
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
        $('.check_policies').click(function(){
            uni_modal("Check-In Policies","check_policies.php?")
        })
    })
</script>