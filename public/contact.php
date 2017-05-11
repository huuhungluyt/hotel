<?php include("_header.php"); ?>

<script>
    document.getElementById("url_home").classList.remove("active");
    document.getElementById("url_about").classList.remove("active");
    document.getElementById("url_contact").classList.add("active");
    document.getElementById("url_book").classList.remove("active");
</script>




<div class="row">
    <div class="col-md-6">
        <form class="form-signin" id="formContact" name="formContact" method="POST">
            <div class="form-group">
                <label for="email-from">Your email:</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="abcxyz@gmail.com">
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <textarea class="form-control" id="subject" name="subject" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="10"></textarea>
            </div>
            <div class="form-group pull-right">
                  <button type="submit" id="submit" name="submit" class="btn btn-primary btn-md">Submit</button>
            </div>
        </form>

    </div>
    <div class="col-md-6">
        <div id="inform" class="alert">
            <strong><span class="glyphicon"></span><span></span></strong><span></span>
        </div>

    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="js/contact.js"></script>

<?php include("_footer.php"); ?>