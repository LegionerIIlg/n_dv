<?php
   if (!defined('ACSEPT'))
       exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Страница авторизации</title>
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <meta name="author" content="Legioner">
        <meta name="publisher-email" content="" />
        <meta name="robots" content="index, follow" />
        <link href="/assets/bootstrap/css/bootstrap.css" rel="stylesheet">

    </head>
    <body>



        <div class="container-fluid">
            <div class="conteiner">
                <div class="row d-flex justify-content-center ">
                    <div class="col-sm-4 mt-5 rounded-2 border-dark">
                        <h3 class="text-center">Представтесь</h3>
                        <form action="/index.php/?enter=true"  onsubmit="return enterInFunction(this)">
                            <div class="mb-3">
                                <label class="form-label">Логин</label>
                                <input type="text" name="login" value="" class="form-control" id="inputLogin" placeholder="" required="true">
                            </div>

                       
                            <div class="mb-3">
                                <label  class="form-label">Пароль</label>
                                <input type="password" name="passw" value="" class="form-control" id="inputPassword" placeholder="" required="true">
                            </div>

                            <p class="text-muted">user; 2</p>
                            <div class="d-inline-block w-100 text-end">
                                <button type="submit" class="btn btn-success">Войти</button>
                            </div>

                        </form>
                    </div>

                </div>


            </div>


        </div>


        <script src="/assets/js/jquery-3.5.1.js"></script>


        <script src="/assets/bootstrap/js/bootstrap.bundle.js"></script>
        <script src="/assets/js/jquery.blockUI.js"></script>
        <script src="/assets/js/enter.js?id=<?= rand(1, 150); ?>"></script>



        <script>



        </script>


    </body>
</html>
