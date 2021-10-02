<?php

require_once dirname(__FILE__). '/BaseServices.class.php';
require_once dirname(__FILE__).'/../dao/UserDao.class.php';

class UserServices extends BaseServices{

    public function register($user){
    
        try {

            $this->dao->beginTransaction();
            
            $user = parent::add([
            "name" => $user['name'],
            "surname" => $user['surname'],
            "email" => $user['email'],
            "password" => md5($user['password'])
          ]);

          $this->dao->commit();

        } catch (Exception $e) {
          $this->dao->rollBack();

          if (str_contains($e->getMessage(), 'users.uq_user_email')) {
            throw new Exception("Account with same email exists in the database", 400, $e);
          }
          else{
            throw $e;
          }
        }
    
        return $user;
      }

    public function login($user){
        $db_user = $this->dao->get_user_by_email($user['email']);
    
        if (!isset($db_user['id'])) throw new Exception("User doesn't exists", 400);
    
        if ($db_user['password'] != md5($user['password'])) 
                                 throw new Exception("Invalid password", 400);
    
        return $db_user;
      }      




}


?>