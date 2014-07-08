<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <title>Гостевая книга</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <style type="text/css">
            body {
                padding-top: 60px;
                padding-bottom: 40px;
            }
            .sidebar-nav {
                padding: 9px 0;
            }
        </style>
        <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/css/bootstrap-combined.min.css" rel="stylesheet">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script src="//netdna.bootstrapcdn.com/twitter-bootstrap/2.2.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container ">
            <div class="row">
                <div class="col-md-8 col-xs-offset-2">
                    
                    <?php $form->render(); //Вывод формы. $form - объект класса Form ?>
                
            </div>
        </div>

        <div class="row">
            <div id ="message_list" class="col-md-4 col-xs-offset-4">
               <?php 
               //Вывод сообщений. 
               //$paginator - объект класса Pagination
               Messanger::renderMessages($paginator->getResults());
               ?>
            </div>
        </div>
        <div class="row">
            <div id="pagingControls" class="col-md-4 col-xs-offset-2">
                <?php echo $paginator->getLinks($_GET); ?>
            </div>
            <div class="col-md-4 col-xs-offset-3">
                <h4>Вывести сообщений:</h4>
            </div>
            <div class="col-md-4 ">
                <?php echo $paginator->renderSelect(); ?>
            </div>
        </div>
    </body>
</html>
