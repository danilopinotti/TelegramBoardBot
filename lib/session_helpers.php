<?php
class SessionHelpers {

  public static function shouldBeAutenticated(){
    if (!(isset($_SESSION['user']))) {
      Flash::message('danger', 'Você deve estar logado para acessar está página!');
      ViewHelpers::redirectTo('../../index.php');
    }
  }

  public static function shouldNotBeAutenticated(){
    if (isset($_SESSION['user'])) {
      Flash::message('warning', 'Você deve estar deslogado para acessar está página!');
      ViewHelpers::redirectTo('/home');
    }
  }

  public static function currentUser() {
    return $_SESSION['user']['email'];
  }

  public static function logIn($user) {
    $_SESSION['user'] = $user;
  }

  public static function isLoggedIn() {
    return isset($_SESSION['user']);
  }

  public static function logOut() {
    unset($_SESSION['user']);
  }
} ?>
