<?php

    

    function checkPermissions($user_id, $permission_id) { 
        include 'db_connect.php'; 
        
        $sql  = 'select

                     count(*) as total_permissions

                     from rolepermissions

                     left join roles

                     on rolepermissions.role_id = roles.role_id

                     left join users on roles.role_id = users.type

                     where users.id = '.$user_id.

                     ' and rolepermissions.permission_id = '.$permission_id;
                   
                    if ($permissions = $conn->query($sql)){
                        

                        $row=$permissions->fetch_assoc();


                        $authorized = ''; 



                        if ($row['total_permissions'] > 0) {

                            $authorized = "true";

                        } else {

                            $authorized = "false";

                        }

                        

                        return $authorized;
                        
                    };
        

             


        
}