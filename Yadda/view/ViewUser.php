<?php

require_once './view/View.php';

class UserView extends View {

    public function __construct($model) {
        parent::__construct($model);
    }

    private function displayul() {
        $users = User::retrievem();
        $s = "<div class='haves' style='display:none;'> ";
        foreach ($users as $user) {
            $s .=  sprintf("%s<br/>\n"
                , $user);
        }
        $s .= "</div>";
        return $s;
    }

 private function userForm() {
        $s = sprintf("
            <div id='register-page'>
            <div id='register-form'>
            <form action='%s?function=U' method='post' id='register' enctype='Multipart/form-data'>\n
            <div class='gets'>\n
                <h3>Create User</h3>\n
                <p>\n
                    Username:<br/>
                    <input type='text' name='uid'/>\n
                </p>\n
                <p>\n
                    First name:<br/>
                    <input type='text' name='first'/>\n
                </p>\n
                <p>\n
                    Last name:<br/>
                    <input type='text' name='last'/>\n
                </p>\n
                <p>\n
                    Email:<br/>
                    <input type='email' name='email'/>\n
                </p>\n
                <p>\n
                    Pwd:<br/>
                    <input type='password' name='pwd1'/>\n
                </p>\n
                 <p>\n
                    Pwd repeat:<br/>
                    <input type='password' name='pwd2'/>\n
                </p>\n
                <p>\n
                   Profile image:<br/>
                   <input type='hidden' name='MAX_FILE_SIZE' value='131072'/>
                   <input type='file' name='imageitself' required/>\n
               </p>\n
                <p>\n
                    <input type='submit' value='Create user'/>
                </p>
            </div>", $_SERVER['PHP_SELF']);
// MAX_FILE_SIZE -> is the image size in kb kb -> mb is 0,001
        if (!Model::areCookiesEnabled()) {
            $s .= "<tr><td colspan='2' class='err'>Cookies
            from this domain must be
                      enabled before attempting login.</td></tr>";
        }
        $s .= "          </div>\n";
        $s .= "          </form> </div>\n";
        return $s;
    }

    private function displayUser() {
        $s = sprintf("<main class='main'>\n%s\n%s</main>\n"
                    , $this->displayul()
                    , $this->userForm());
        return $s;
    }

    public function display(){
       $this->output($this->displayUser());
    }

}
