<?php
  require_once('../vendor/autoload.php');
  require_once('../includes/functions.php');

  DB::debugMode(); // echo out each SQL command being run, and the runtime

  $results = DB::query("SELECT * FROM `user`");

?>

<table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Last Login</th>
      <th scope="col">Type</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($results as $row) {
      $id = $row['id'];
      echo "<tr><th scope='row'>" . $id . "</th>";
      echo "<td>" . $row['name'] . "</td>";
      echo "<td>" . $row['username'] . "</td>";
      echo "<td>" . $row['email'] . "</td>";
      echo "<td>" . $row['last_login'] . "</td>";
      echo "<td>" . $row['type'] . "</td>";
      echo "<td>";
      echo "<a href='admin.php?page=edit_user&option=ban&id=$id'>ban</a> - <a href='admin.php?page=edit_user&option=ipban&id=$id'>ipban</a> - <a href='admin.php?page=edit_user&option=delete&id=$id'>delete</a>";
      echo "</td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>
