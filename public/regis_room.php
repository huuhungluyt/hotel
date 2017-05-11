<?php include("_header.php");?>
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-success">
        <div class="panel-heading">
            <h2>Search empty room</h2>
        </div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-sm-5" for="start_time">Start time:</label>
                        <link rel="stylesheet prefetch" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
                        <div class="col-sm-7 input-group date">
                            <input class="form-control" data-date-format="yyyy-mm-dd" readonly type="text" id="start_time" name= 'start_time'>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5" for="end_time">End time:</label>
                        <link rel="stylesheet prefetch" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
                        <div class="col-sm-7 input-group date">
                            <input class="form-control" data-date-format="yyyy-mm-dd" readonly type="text" id="end_time" name= 'end_time'>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5" for="type-room">Type of room:</label>
                        <div class="col-sm-7">
                            <select class="form-control" id="type-room">
                                <option>Single - Vip</option>
                                <option>Double - Vip</option>
                                <option>Single</option>
                                <option>Double</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5" for="id-room">ID Room:</label>
                        <div class="col-sm-7">
                            <input type="text" id="id-room" class="form-control" placeholder="01001">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5" for="floor">Floor:</label>
                        <div class="col-sm-7">
                            <input type="text" id="floor" class="form-control" placeholder="01">
                        </div>
                    </div>
                    <div class="form-group col-sm-8 pull-right">
                        <button type="button" id="submit" class="btn btn-primary btn-md">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h2 style="color:red">Result</h2>
            </div>
            <div class="panel-body">
                <form>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="col-sm-2">
                                <input type="checkbox" id="choose-all"> Choose
                            </th>
                            <th class="col-sm-3">Id Room</th>
                            <th class="col-sm-3">Type of room</th>
                            <th class="col-sm-4">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="checkbox" id="choose"></td>
                            <td>01001</td>
                            <td>Double</td>
                            <td>100000</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" id="choose"></td>
                            <td>01004</td>
                            <td>Single-Vip</td>
                            <td>100000</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" id="choose"></td>
                            <td>02001</td>
                            <td>Double-Vip</td>
                            <td>100000</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" id="choose"></td>
                            <td>03004</td>
                            <td>Single-Vip</td>
                            <td>100000</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" id="choose"></td>
                            <td>05005</td>
                            <td>Single</td>
                            <td>100000</td>
                        </tr>
                    </tbody>
                </table>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<script src="../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
<script src="js/room.js"></script>

<?php include("_footer.php");?>