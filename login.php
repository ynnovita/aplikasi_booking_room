<style>
    #uni_modal .modal-content>.modal-footer,#uni_modal .modal-content>.modal-header{
        display:none;
    }
</style>

<div class="container py-5">
    <div class="row">
        <div class="col-md-12">
                <div class="col-md-6 mx-auto">
                    <div class="card border-secondary">
                        <div class="card-header">
                            <h3 class="mb-0 my-2">Login</h3>
                        </div>
                        <div class="card-body">
                            <form class="form" role="form" autocomplete="off" id="login-form" method="post">
                                <div class="form-group">
                                    <label for="" class="control-label">Username</label>
                                    <span class="red-asterisk"> *</span>
                                    <input type="text" class="form-control form"
                                           name="username"
                                           placeholder="username"
                                           required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="control-label">Password</label>
                                    <span class="red-asterisk"> *</span>
                                    <input type="password" class="form-control form"
                                           name="password"
                                           placeholder="password"
                                           required>
                                </div>
                                <div class="form-group">
                                    <p>Not registered? <a href="javascript:void(0)" id="register">Register here.</a></p>
                                </div>
                                <div class="form-group">
                                    <a href="index.php" class="btn btn-dark">Home</a>
                                    <input type="submit" class="btn btn-primary btn-md float-right"
                                           value="login" name="login">
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
    $('#register').click(function(){
      uni_modal("","register.php","large")
    })
    $('#login-form').submit(function(e){
            e.preventDefault();
            start_loader()
            if($('.err-msg').length > 0)
                $('.err-msg').remove();
            $.ajax({
                url:_base_url_+"classes/Login.php?f=login_user",
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
                        alert_toast("Login Successfully",'success')
                        setTimeout(function(){
                            location.reload()
                        },2000)
                    }else if(resp.status == 'incorrect'){
                        var _err_el = $('<div>')
                            _err_el.addClass("alert alert-danger err-msg").text("Incorrect Credentials.")
                        $('#login-form').prepend(_err_el)
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