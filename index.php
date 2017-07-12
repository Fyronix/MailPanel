<?php include_once 'admin-setup/setup.php'; ?> 
<!DOCTYPE html>
<html>
    <head>
        <title>MailPanel</title>
        <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="assets/css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" href="assets/css/chosen.min.css"/>
        <link rel="stylesheet" href="assets/css/style.css"/>
        <?php
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
                                <form class="mail-send" action="mail-send.php" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="block" for="from">From:</label>
                                        <input id="from" name="from" class="form-control" placeholder="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label class="block" for="reply-to">Reply to:</label>
                                        <input name="reply_to" id="reply-to" class="form-control" placeholder="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label class="block" for="subject">Subject:</label>
                                        <input name="subject" id="subject" class="form-control" placeholder="" type="text">
                                    </div>
                                    <div class="form-group">
                                        <label for="to">To:</label>
                                        <select name="to[]" class="chosen-select" data-placeholder=" "  multiple="multiple">
                                            <?php
                                            $query = "SELECT * FROM contacts";
                                            $result = $dbh->query($query);
                                            while ($row_obj = $result->fetchObject()) {
                                                echo '<option value="' . $row_obj->email . '">' . $row_obj->email . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="cc">Cc:</label>
                                        <select name="cc[]" class="chosen-select" data-placeholder=" "  multiple="multiple">
                                            <?php
                                            $query = "SELECT * FROM contacts";
                                            $result = $dbh->query($query);
                                            while ($row_obj = $result->fetchObject()) {
                                                echo '<option value="' . $row_obj->email . '">' . $row_obj->email . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="bcc">Bcc:</label>
                                        <select name="bcc[]" class="chosen-select" data-placeholder=" "  multiple="multiple">
                                            <?php
                                            $query = "SELECT * FROM contacts";
                                            $result = $dbh->query($query);
                                            while ($row_obj = $result->fetchObject()) {
                                                echo '<option value="' . $row_obj->email . '">' . $row_obj->email . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="body">Body:</label>
                                        <textarea name="body" id="body" class="tinymce"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="attachment">Attachment:</label>
                                        <input type="file" name="attachment"  >
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
                                <?php 
                                $query = "SELECT * FROM configuration LIMIT 1";
                                $result = $dbh->query($query);
                                $row_obj = $result->fetchObject();
                                ?>
                                <form class="mail-config" action="mail-config.php" method="post">
                                    <div class="form-group">
                                        <label for="smtpsecure">SMTPSecure:</label>
                                        <input type="text" id="smtpsecure" name="smtpsecure" value="<?php echo $row_obj->smtpsecure; ?>" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="host">Host:</label>
                                        <input type="text" id="host" name="host" value="<?php echo $row_obj->host; ?>" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="port">Port:</label>
                                        <input type="text" id="port" name="port" value="<?php echo $row_obj->port; ?>" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="username">Username:</label>
                                        <input type="text" id="username" name="username" value="<?php echo $row_obj->username; ?>" class="form-control" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password:</label>
                                        <input type="password" id="password" name="password" value="<?php echo $row_obj->password; ?>" class="form-control" placeholder="">
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

