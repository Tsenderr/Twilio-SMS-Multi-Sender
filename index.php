<?php


require 'vendor/autoload.php';
use Twilio\Rest\Client;

        
if(isset($_POST['send']))
{
    // check inputs
    //if(empty($_POST['sid']) || empty($_POST['token']) || empty($_POST['body']))
    do {
        
        if(empty($_POST['sid']))
        {
            $errBox = 'SID input field must not be empty.';
            break;
        }
        
        if(empty($_POST['token']))
        {
            $errBox = 'Token must not be empty.';
            break;
        }
        
        if(empty($_POST['body']))
        {
            $errBox = 'You must send something as message';
            break;
        }
        
        if(strlen($_POST['body']) > 160)
        {
            $errBox = 'Max body lenght is 160 chars.';
            break;
        }
        
        if(empty($_POST['numbers']))
        {
            $errBox = 'You must set at least one number to send a message.';
            break;
        }
        
        if(empty($_POST['from']))
        {
            $errBox = 'You must set a number from which to send the sms\'';
            break;
        }
        
        // all correct ?
        
        $msg = trim($_POST['body']);
        $sid = $_POST['sid'];
        $token = $_POST['token'];
        $from = $_POST['from'];
        
        $numbers = explode('+', $_POST['numbers']);

        
        $client = new Client($sid, $token);
        
        $i = 0;
        $j = 0;
        foreach($numbers as $number)
        {
            if(empty($number)) continue;
            try
            {
                $sms = $client->account->messages->create(
        
                    // the number we are sending to - Any phone number
                    '+' . $number,
        
                    array(
                        // Step 6: Change the 'From' number below to be a valid Twilio number 
                        // that you've purchased
                        'from' => "$from", 
                        
                        // the sms body
                        'body' => "$msg"
                    )
                );
                $i++;
            }catch( Exception $e){
                $errors[] = $e->getMessage();
            }
            $j++;
        }
        $warBox = $i . " messages where successfully sent. $j messages failed to be sent.";
        
    } while (false);
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Twilio SMS sender</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
    
    <div class="container container-fluid">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <h3>SMS Sender :D</h3>
                <hr/>
                <?php include 'libs/alerts.php'; ?>
                <div class="col-xs-12">
                    <form method="post">
                        <div class="col-sm-9">
                            <div class="form-group">
                                <input type="text" name="sid" class="form-control" placeholder="SID: " value="<?php echo $_POST['sid']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="token" class="form-control" placeholder="Token: " value="<?php echo $_POST['token']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" name="from" class="form-control" placeholder="From: ( one of the numbers you have purchased at twilio.com/console)" value="<?php echo $_POST['from']; ?>">
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" style="height:200px" name="body" placeholder="Message here :)" value="<?php echo $_POST['body']; ?>"></textarea>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <textarea class="form-control" name="numbers" style="height:350px" placeholder="Mobile numbers"><?php echo $_POST['numbers']; ?></textarea>
                        </div>
                        
                        <div class="col-xs-12">
                            <hr/>
                            <input type="submit" name="send" class="btn btn-primary btn-lg" value="Send!">
                        
                            <p style="margin-top:5%; color:red">
                                <?php
                                    if($errors)
                                    {
                                        foreach($errors as $error)
                                        {
                                            echo $error . '<br/><br/>';
                                        }
                                    }
                                ?>
                            </p>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</body>

</html>