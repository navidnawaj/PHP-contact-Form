<!DOCTYPE html>
<html>
    <head>
        <title>PHP Contact Form</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600;700&display=swap" rel="stylesheet">
    </head>
    <?php
        /*=======E-mail Setting =========*/
        $email_address = "navid.nawaj18@gmail.com";

        $subject = "New Contact form submission";

        /*============ Needed Vairbles ==============*/
        $whitelist = array('email', 'name', 'message');
        /*============ Variables For the Form ==============*/
        $errors = array();
        $sent = null;


        /*============ CHECK FORM SUBMISSION ==============*/


        /*==Check if the fields are not empty==*/
        if( ! empty ($_POST) ){
             
            /******Check the Captcha**********/
            if ( intval ( $_POST['captcha'] ) !== 15 ){
                $errors[] = "your math is incorrect.";
            }
            /******Validate email address*****/
            if( ! empty($_POST['email']) && ! filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL) ) {
                $errors[] = "your email address in not valid.";
            }

            /****Whitelising the fields */
            foreach($whitelist as $key){
                $fields[$key] = $_POST[$key];
            }

            /****** validate Field data *****/
            foreach($fields as $field => $data){
                if( empty($data) ){
                    $errors[] = 'your missing field is ' . $field;
                }
            }

            /**** Check & Process ****/
            if(empty($errors)){
                $sent = mail($email_address, $subject, $fields['message']);
            }
        }
    ?>
    <body>
    <style>
        body{
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }
    </style>
        <div class="container">
            <div class="row my-5">
                <div class="col-2"></div>
                <div class="col-8 my-auto">
                <h1 class="my-3" style="text-transform: uppercase; border-bottom: 1px solid #d1d1d1; padding-bottom: 5px; margin-bottom: 50px !important;">Send Mail Using The Form</h1>
                    <form role="form" method="POST" action="index.php">
                        <div class="form-group">
                            <label>Email address</label>
                            <input name="email" type="email" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Your Name</label>
                            <input name="name" type="text" class="form-control" value=>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Your Message</label>
                            <textarea name="message" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <div class="form-group row" style="margin-top: 35px;">
                            <label class="col-sm-1 col-form-label">7+8=?</label>
                            <div class="col-sm-11">
                                <input name="captcha" type="number" class="form-control" style="width: 30%;">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <?php if( ! empty($errors) ) : ?>
                        <div class="errors" style="margin-top: 20px;">
                            <p style="padding: 10px;color: white; text-transform: capitalize;" class="bg-danger"><?php echo implode('</p><p style="padding: 10px; color: white; text-transform: capitalize;" class="bg-danger">', $errors); ?></p>
                        </div>
                    <?php elseif($sent) : ?>
                        <div class="success">
                            <p style="padding: 10px;color: white; text-transform: capitalize;" class="bg-success">Your message is sent!</p>
                        </div>
                <?php endif; ?>
                </div>
                <div class="col-2"></div>
            </div>
        </div>
</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </body>


</html>
