<html>
  <body>
    <?php
      require( 'config.php' );

      // connect to the MySQL server
      $connection = mysql_connect( $mysql_server, $mysql_username, $mysql_password );
      if( !$connection )
      {
        $error = mysql_error();
        die( $error );
      }
      echo 'Succeeded in connecting to the MySQL server.';
      echo '<br/>';

      // set the charset
      $query = 'SET NAMES ' . $mysql_charset;
      mysql_query( $query, $connection );

      // create the database
      $query = 'CREATE DATABASE ' . $mysql_db_name . ' CHARACTER SET ' . $mysql_charset;
      if( !mysql_query( $query, $connection ) )
      {
        $error = mysql_error();
        mysql_close( $connection );
        die( $error );
      }
      echo 'Succeeded in creating the database.';
      echo '<br/>';

      // select the database
      $database = mysql_select_db( $mysql_db_name, $connection );
      if( !$database )
      {
        $error = mysql_error();
        mysql_close( $connection );
        die( $error );
      }
      echo 'Succeeded in selecting the database.';
      echo '<br/>';

      // create the Posts table
      $query = 'CREATE TABLE Posts ( post_id int(10) NOT NULL AUTO_INCREMENT, post_date datetime NOT NULL, post_title text NOT NULL, post_content text NOT NULL, post_category int(4) DEFAULT \'0\' NOT NULL, PRIMARY KEY (post_id) )';
      if( !mysql_query( $query, $connection ) )
      {
        $error = mysql_error();
        mysql_close( $connection );
        die( $error );
      }
      echo 'Succeeded in creating the Posts table.';
      echo '<br/>';

      // create the Categories table
      $query = 'CREATE TABLE Categories ( category_id int(4) NOT NULL AUTO_INCREMENT, category_name tinytext NOT NULL, PRIMARY KEY (category_id) )';
      if( !mysql_query( $query, $connection ) )
      {
        $error = mysql_error();
        mysql_close( $connection );
        die( $error );
      }
      $query = 'INSERT INTO Categories ( category_name ) VALUES ( \'未分类\' )';
      if( !mysql_query( $query, $connection ) )
      {
        $error = mysql_error();
        mysql_close( $connection );
        die( $error );
      }
      echo 'Succeeded in creating the Categories table.';
      echo '<br/>';

      // create the Comments table
      $query = 'CREATE TABLE Comments ( comment_id int(10) NOT NULL AUTO_INCREMENT, comment_post_id int(10) NOT NULL, comment_author tinytext NOT NULL, comment_author_email tinytext NOT NULL, comment_author_homepage tinytext, comment_author_IP tinytext NOT NULL, comment_date datetime NOT NULL, comment_content text NOT NULL, PRIMARY KEY (comment_id) )';
      if( !mysql_query( $query, $connection ) )
      {
        $error = mysql_error();
        mysql_close( $connection );
        die( $error );
      }
      echo 'Succeeded in creating the Comments table.';
      echo '<br/>';

      // close the connection
      mysql_close( $connection );

      echo 'Installation finished successfully.';
    ?>
  </body>
</html>
