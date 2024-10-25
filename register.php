<style>
    #uni_modal .modal-content>.modal-footer,#uni_modal .modal-content>.modal-header{
        display:none;
    }
</style>

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
                <div class="col-md-6 mx-auto card-holder">
                    <div class="card border-secondary">
                        <div class="card-header">
                            <h3 class="mb-0 my-2">Create New Account</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="registration" method="post">
                                <div class="form-group">
                                    <label for="" class="control-label">Firstname</label>
                                    <input type="text" class="form-control form-control-sm form" name="firstname" required>

                                    <label for="" class="control-label">Lastname</label>
                                    <input type="text" class="form-control form-control-sm form" name="lastname" required>

                                    <label for="" class="control-label">Email</label>
                                    <input type="email" class="form-control form-control-sm form" name="email" placeholder="email@domain.com" required="">

                                    <label for="" class="control-label">Contact #</label>
                                    <input type="text" class="form-control form-control-sm form" name="contact" placeholder="(123) 456-7890" required>

                                    <label for="" class="control-label">Username</label>
                                    <input type="text" class="form-control form-control-sm form" name="username" placeholder="username" required>

                                    <label for="" class="control-label">Password</label>
                                    <span class="red-asterisk"> *</span>
                                    <input type="password" class="form-control form-control-sm form" name="password" placeholder="password" title="At least 4 characters with letters and numbers" required="">
                                </div>
                                <div class="form-group">
                                    <p>Already registered? <a href="javascript:void(0)" id="login">Log in here.</a></p>
                                </div>
                                <div class="form-group">
                                    <a  href="index.php" class="btn btn-dark">Home</a>
                                    <input type="submit" class="btn btn-primary btn-md float-right">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#login').click(function(){
            uni_modal("","login.php","large")
        })
        $('#registration').submit(function(e){
            e.preventDefault();
            start_loader()
            if($('.err-msg').length > 0)
                $('.err-msg').remove();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=register",
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
                        alert_toast("Account succesfully registered",'success')
                        setTimeout(function(){
                            location.reload()
                        },2000)
                    }else if(resp.status == 'failed' && !!resp.msg){
                        var _err_el = $('<div>')
                            _err_el.addClass("alert alert-danger err-msg").text(resp.msg)
                        $('#registration').prepend(_err_el)
                        end_loader()
                        
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                        end_loader()
                    }
                }
            })
        })
    })
    </script>
</body>
</html>