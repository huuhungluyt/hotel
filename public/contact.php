<?php include("_header.php"); ?>

<script>
    document.getElementById("url_home").classList.remove("active");
    document.getElementById("url_about").classList.remove("active");
    document.getElementById("url_contact").classList.add("active");
    document.getElementById("url_book").classList.remove("active");
</script>
<div class="row">
    <div class="col-md-6">
        <form class="form-signin" method="POST" action="do_contact.php">
            <div class="form-group">
                <label for="email-from">Your email:</label>
                <input type="text" id="email" name="email" class="form-control" placeholder="abcxyz@gmail.com">
            </div>
            <!--<div class="form-group">
                <label for="email-to">To</label>
                <input type="text" id="email-to" class="form-control" placeholder="abcxyz@gmail.com">
            </div>-->
            <div class="form-group">
                <label for="subject">Subject</label>
                <textarea class="form-control" id="subject" name="subject" rows="2"></textarea>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea class="form-control" id="message" name="message" rows="10"></textarea>
            </div>
            <div class="form-group pull-right">
                  <button type="submit" id="submit" class="btn btn-primary btn-md">Submit</button>
            </div>
        </form>

    </div>
</div>
<?php include("_footer.php"); ?>