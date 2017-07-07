<!DOCTYPE html>
<html>
    <head>
        <title>MailPanel</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" href="assets/css/chosen.min.css"/>
        <link rel="stylesheet" href="assets/css/style.css"/>
        <?php
        include_once 'admin-setup/setup.php';
        include_once 'database.php';
        $query = "create table test(id bit)";
        $dbh->query($query);
        ?>
    </head>
    <body>
        <div class="vertical-space"></div>
        <div class="row">
            <div class="container">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Mail Panel</b></div><!--.panel-heading-->
                    <div class="panel-body">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#compose" data-toggle="tab" aria-expanded="false">Compose</a></li>
                            <li class=""><a href="#add-contact" data-toggle="tab" aria-expanded="false">AddContact</a></li>
                            <li class=""><a href="#contact" data-toggle="tab" aria-expanded="true">ContactsList</a></li>
                            <li class=""><a href="#maillist" data-toggle="tab" aria-expanded="false">MailList</a></li>
                            <li class=""><a href="#configuration" data-toggle="tab" aria-expanded="false">Configuration</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="compose" class="tab-pane active">
                                <form class="mail-send" action="mail-send.php" method="post">
                                    <div class="form-group">
                                        <label for="to">To:</label>
                                        <select name="language" class="chosen-select" data-placeholder=" "  multiple="multiple">
                                            <option value="a.sabagh72@gmail.com">a.sabagh72@gmail.com</option>
                                            <option value="rangraz54@gmail.com">rangraz54@gmail.com</option>
                                            <option value="info@asabagh.ir">info@asabagh.ir</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="block" for="from">From:</label>
                                        <input id="from" class="form-control" placeholder="" type="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="cc">Cc:</label>
                                        <input id="cc" class="form-control" placeholder="" type="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="bcc">Bcc:</label>
                                        <input id="bcc" class="form-control" placeholder="" type="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="body">Body:</label>
                                        <textarea id="body" class="tinymce"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="attachment">Attachment:</label>
                                        <input type="file" name="attachment" value="attachment" >
                                    </div>
                                    <input class="btn btn-primary" name="send_mail" type="submit" value="Send Mail">
                                </form>
                            </div><!--#compose-->
                            <div id="add-contact" class="tab-pane">
                                <form class="add-contact" action="contact-add.php" method="post">
                                    <div class="form-group">
                                        <label for="firstname">FirstName:</label>
                                        <input id="firstname" name="firstname" class="form-control" placeholder="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="lastname">LastName:</label>
                                        <input id="lastname" name="lastname" class="form-control" placeholder="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input id="email" name="email" class="form-control" placeholder="" type="text">
                                    </div>
                                    <input type="submit" class="btn btn-primary" name="add_contact" value="Add Contact" > 
                                </form><!--.mail-config-->
                            </div><!--#add-contact-->
                            <div id="contact" class="tab-pane">
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>FirstName</th>
                                            <th>LastName</th>
                                            <th>Email</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM contacts";
                                        $query_result = $dbh->query($query);
                                        while ($row_obj = $query_result->fetchObject()) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row_obj->firstname; ?></td>
                                                <td><?php echo $row_obj->lastname; ?></td>
                                                <td><?php echo $row_obj->email; ?></td>
                                                <td>
                                                    <a href="contact-edit.php?id=<?php echo $row_obj->id; ?>" title="edit contact">Edit</a> | <a href="contact-delete.php?id=<?php echo $row_obj->id; ?>" title="remove contact">Remove</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div><!--#contact-->
                            <div id="configuration" class="tab-pane">
                                <form class="mail-config" action="mail-config.php" method="post">
                                    <div class="form-group">
                                        <label for="smtpsecure">SMTPSecure:</label>
                                        <input id="smtpsecure" class="form-control" placeholder="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="host">Host:</label>
                                        <input id="host" class="form-control" placeholder="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="port">Port:</label>
                                        <input id="port" class="form-control" placeholder="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input id="username" class="form-control" placeholder="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input id="password" class="form-control" placeholder="" type="text">
                                    </div>
                                    <input type="submit" class="btn btn-primary" name="save_configuration" value="Save Configuration" > 
                                </form><!--.mail-config-->
                            </div><!--#Configuration-->
                            <div id="maillist" class="tab-pane">
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th>To</th>
                                            <th>From</th>
                                            <th>Subject</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>info@asabagh.ir</td>
                                            <td>a.sabagh72@gmail.com</td>
                                            <td>new project on github</td>
                                            <td><a href="#" title="show mail detail">ShowMore</a></td>
                                        </tr>
                                        <tr>
                                            <td>info@asabagh.ir</td>
                                            <td>a.sabagh72@gmail.com</td>
                                            <td>new project on github</td>
                                            <td><a href="#" title="show mail detail">ShowMore</a></td>
                                        </tr>
                                        <tr>
                                            <td>info@asabagh.ir</td>
                                            <td>a.sabagh72@gmail.com</td>
                                            <td>new project on github</td>
                                            <td><a href="#" title="show mail detail">ShowMore</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div><!--.maillist-->
                        </div><!--.tab-content-->
                    </div><!--.panel-body-->
                </div><!--.panel-body-->
            </div><!--.container-->
        </div><!--.row-->
        <script src="assets/js/jquery-3.2.1.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/chosen.jquery.min.js"></script>
        <script src="assets/js/tinymce.min.js"></script>
        <script src="assets/js/scripts.js"></script>
    </body>
</html>

