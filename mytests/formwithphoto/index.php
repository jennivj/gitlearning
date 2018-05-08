<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="inc/bootstrap.min.css">
    <link rel="stylesheet" href="inc/style.css">
    <title>Form</title>
    <style>

    </style>
</head>
<body>
<form name="frmform" id="frmform" enctype="multipart/form-data"  method="POST" action="mail-action.php">
    <div class="container">
        <h2>Form</h2>
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#step_1">Step 1</a></li>
            <li><a data-toggle="tab" href="#step_2" class="notActive">Step 2</a></li>
            <li><a data-toggle="tab" href="#step_3" class="notActive">Step 3</a></li>
            <li><a data-toggle="tab" href="#step_4" class="notActive">Step 4</a></li>
            <li><a data-toggle="tab" href="#step_done" class="doneCls notActive">Done</a></li>
        </ul>

        <div class="tab-content">
            <div id="step_1" class="tab-pane fade in active">
                <h3>STEP 1</h3>
                <p>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group  ">
                            <label>Name:</label>
                            <input type="text" class="form-control" id="userName" required name="userName"
                                   placeholder="Enter Your Name" maxlength="255">
                            <span class="help-block"><strong></strong></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group  ">
                            <label>Email:</label>
                            <input type="text" class="form-control" id="userEmail" required name="userEmail"
                                   placeholder="Enter Your Email Address">
                            <span class="help-block"><strong></strong></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group  ">
                            <label>Phone:</label>
                            <input type="text" class="form-control" id="userPhone" required name="userPhone"
                                   placeholder="Enter Your Phone Number" maxlength="255">
                            <span class="help-block"><strong></strong></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-primary btnNext pull-right">Next</button>
                    </div>
                </div>


                </p>


            </div>
            <div id="step_2" class="tab-pane fade">
                <h3>STEP 2</h3>
                <p>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group  ">
                            <label>Birthday:</label>
                            <input type="text" class="form-control" id="userDob" name="userDob"
                                   placeholder="Enter Your Bithday" maxlength="255">
                            <span class="help-block"><strong></strong></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 ">

                        <div class="form-inline">
                            <label>Favourite color:</label>
                            <br clear="all">

                            <label class="checkbox">
                                <input type="checkbox" name="faColor[]" value="Blue">
                            </label>
                            Blue
                            <label class="checkbox">
                                <input type="checkbox" name="faColor[]" value="Red">
                            </label>
                            Red
                            <label class="checkbox">
                                <input type="checkbox" name="faColor[]" value="Yellow">
                            </label>
                            Yellow
                            <label class="checkbox">
                                <input type="checkbox" name="faColor[]" value="Pink">
                            </label>
                            Pink

                            <span class="help-block"><strong></strong></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-primary btnPrevious">Previous</button>
                        <button class="btn btn-primary btnNext pull-right">Next</button>
                    </div>
                </div>
                </p>

            </div>
            <div id="step_3" class="tab-pane fade">
                <h3>STEP 3</h3>
                <p>
                    <label> how do you feel today: </label>
                    <br clear="all">


                <div class="row">
                    <div class="col-md-6 ">
                        <label class="radio-inline">
                            <input type="radio" name="optradio" value="Good">Good
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="optradio" value="Normal">Normal
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="optradio" value="Bad">Bad
                        </label>

                    </div>
                </div>
                </p>
                <div class="row">
                    <div class="col-md-6">
                        <button class="btn btn-primary btnPrevious">Previous</button>
                        <button class="btn btn-primary btnNext pull-right">Next</button>
                    </div>
                </div>
            </div>
            <div id="step_4" class="tab-pane fade">
                <h3>STEP 4</h3>
                <p>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group  ">
                            <label> Photo from left: &nbsp;</label>

                                   <input data-preview="#preview" name="imgup[]" type="file" id="img_left">

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group  ">
                            <label> Photo from right: </label>

                            <input data-preview="#preview" name="imgup[]" type="file" id="img_right">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group  ">
                            <label> Photo from front: </label>

                                  <input data-preview="#preview" name="imgup[]" type="file" id="img_front">


                        </div>
                    </div>
                </div>
                </p>

                <button class="btn btn-primary btnPrevious">Previous</button>
                <button class="btn btn-primary   pull-right btnSave">Next</button>
            </div>
            <div id="step_done" class="tab-pane fade">
                <h3>DONE</h3>
                <p>
                   <?php  if(isset($_REQUEST['msg'])) {
                   if(  $_REQUEST['msg']=="fail") {
                       echo "Could not send mail! Please check your PHP mail configuration.";
                    }
                    else {
                           echo "The mail has been sent successfully.";
                       }
                   }else{
                       echo "Sending Mail..";
                   }
                   ?></p>

            </div>
        </div>
    </div>
</form>
<!-- Optional JavaScript -->
<!-- jQuery first,   then Bootstrap JS -->
<script src="inc/query.js"></script>
<script src="inc/bootstrap.min.js"></script>
<script src="inc/jquery.validate.js"></script>
<script src="inc/form.js"></script>

<script>
    $('.btnNext').click(function () {

        if ($('#frmform').valid() != false) {
            $('.nav-tabs > .active').next('li').find('a').trigger('click');
            return false;
        }
    });

    $('.btnPrevious').click(function () {
        $('.nav-tabs > .active').prev('li').find('a').trigger('click');
        return false;
    });

    $('.btnSave').click(function () {
        $('#frmform').submit();
    });

    <?php
    if(isset($_REQUEST['msg'])){
?>
   $('.doneCls') .trigger('click');
    <?php
    }
    ?>
</script>
</body>
</html>