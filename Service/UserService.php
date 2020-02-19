<?php


class UserService
{

    private function loadUser( $row )
    {
        $user = new User();
        $user->Load($row);
        return $user;
    }

    public function setUserData ($login, $wachtwoord){

        $user = new User();
        $user->setLogin($login);
        $user->setPaswd($wachtwoord);

        return $user;
    }

    public function CheckLogin(User $user)
    {
        //gebruiker opzoeken ahv zijn login (e-mail)
        $sql = "SELECT * FROM users WHERE usr_login='" . $user->getLogin() . "' ";

        $data = GetData($sql);
        if ( count($data) == 1 )
        {
            $row = $data[0];
            //password controleren
            if ( password_verify( $user->getPaswd(), $row['usr_paswd'] ) ) $login_ok = true;
        }

        if ( $login_ok )
        {
            session_start();
            $_SESSION['usr'] = $this->loadUser($row);
            $this->LogLoginUser($_SESSION['usr']);
            return true;
        }

        return false;
    }

    public function LogLoginUser(User $user)
    {
        $session = session_id();
        $timenow = new DateTime( 'NOW', new DateTimeZone('Europe/Brussels') );
        $now = $timenow->format('Y-m-d H:i:s') ;
        $sql = "INSERT INTO log_user SET log_usr_id=".$user->getId().", log_session_id='".$session."', log_in= '".$now."'";
        print $sql;
        ExecuteSQL($sql);
    }

    public function LogLogoutUser()
    {
        $session = session_id();
        $timenow = new DateTime( 'NOW', new DateTimeZone('Europe/Brussels') );
        $now = $timenow->format('Y-m-d H:i:s') ;
        $sql = "UPDATE log_user SET  log_out='".$now."' where log_session_id='".$session."'";
        ExecuteSQL($sql);
    }

    public function CheckIfUserExistsAlready()
    {
        global $MS;
        global $_application_folder;
        //controle of gebruiker al bestaat
        $sql = "SELECT * FROM users WHERE usr_login='" . $_POST['usr_login'] . "' ";
        $data = GetData($sql);
        if ( count($data) > 0 ) {
            $MS->addMessage("Deze gebruiker bestaat reeds! Gelieve een andere login te gebruiken.", "error");
            die(header("Location: " . $_application_folder . "/register.php"));
        }
    }

    public function ValidatePostedUserData()
    {
        global $_application_folder;
        global $MS;
        $this->CheckIfUserExistsAlready();

        //controle wachtwoord minimaal 8 tekens
        if ( strlen($_POST["usr_paswd"]) < 8 ) {
            $MS->addMessage("Uw wachtwoord moet minstens 8 tekens bevatten!", "error");
            die(header("Location: " . $_application_folder . "/register.php"));
        }

        //controle geldig e-mailadres
        if (!filter_var($_POST["usr_login"], FILTER_VALIDATE_EMAIL)) {
            $MS->addMessage("Ongeldig email formaat voor login", "error");
            die(header("Location: " . $_application_folder . "/register.php"));
        }
    }

    public function RegisterUser()
    {
        global $tablename;
        global $_application_folder;
        global $MS;

        //wachtwoord coderen
        $password_encrypted = password_hash ( $_POST["usr_paswd"] , PASSWORD_DEFAULT );

        $sql = "INSERT INTO $tablename SET " .
            " usr_voornaam='" . htmlentities($_POST['usr_voornaam'], ENT_QUOTES) . "' , " .
            " usr_naam='" . htmlentities($_POST['usr_naam'], ENT_QUOTES) . "' , " .
            " usr_straat='" . htmlentities($_POST['usr_straat'], ENT_QUOTES) . "' , " .
            " usr_huisnr='" . htmlentities($_POST['usr_huisnr'], ENT_QUOTES) . "' , " .
            " usr_busnr='" . htmlentities($_POST['usr_busnr'], ENT_QUOTES) . "' , " .
            " usr_postcode='" . htmlentities($_POST['usr_postcode'], ENT_QUOTES) . "' , " .
            " usr_gemeente='" . htmlentities($_POST['usr_gemeente'], ENT_QUOTES) . "' , " .
            " usr_telefoon='" . htmlentities($_POST['usr_telefoon'], ENT_QUOTES) . "' , " .
            " usr_login='" . $_POST['usr_login'] . "' , " .
            " usr_paswd='" . $password_encrypted . "'  " ;

        if ( ExecuteSQL($sql) )
        {
            $MS->AddMessage( "Bedankt voor uw registratie!" );

            $user = $this->setUserData($_POST['usr_login'], $_POST["usr_paswd"]);

            if ( $this->CheckLogin($user) )
            {
                header("Location: " . $_application_folder . "/steden.php");
            }
            else
            {
                $MS->AddMessage( "Sorry! Verkeerde login of wachtwoord na registratie!", "error" );
                header("Location: " . $_application_folder . "/login.php");
            }
        }
        else
        {
            $MS->AddMessage( "Sorry, er liep iets fout. Uw gegevens werden niet goed opgeslagen", "error" ) ;
            header("Location: " . $_application_folder . "/register.php");
        }
    }

}