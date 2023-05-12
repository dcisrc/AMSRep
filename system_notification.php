<?php

    
    require_once('mail/mailer.php');
    //include('systemsettings.php');

    //$host=$_SESSION['system_info']['host'];
    //$username= $_SESSION['system_info']['username']; 
    //$password= $_SESSION['system_info']['password'];
    //$port= $_SESSION['system_info']['port'];

    function sendNotification($notif_id) { 
       
        include 'db_connect.php';
        
         $sql  = 'select

                      *

                     from notifications n left join users u ON n.role_id = u.type

                     
                      where n.id ='.$notif_id.' and status="ACTIVE"';

                      $notification_qry=$conn->query($sql) or die($conn->error);
                      while($row=$notification_qry->fetch_array()){
                         $email=$row['username'];
                         $subject = $row['notif_name'];
                         $type=$row['type'];
                         $message = $row['message'];
                         //sendmail($email,$subject,$message,$host,$username,$password,$port);
                         sendmail($email,$subject,$message);
                         
                           //header("location:mail/mailer.php?message=".$message."&email=".$email);
                       
        //                 $authorized = ''; 
        //                 return $authorized;
                        
                     };
                     return 1;
                    


        
};
?>