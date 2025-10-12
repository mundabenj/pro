<?php
class tables{
    public function users_table(){
        global $conf, $ObjFncs, $SQL;
        $users = $SQL->select_while("SELECT * FROM users WHERE roleId > 1");
        if($users) {
            ?>
            <table id="example" class="table table-striped">
               <thead>
                  <tr>
                     <th>ID</th>
                     <th>Name</th>
                     <th>Email</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($users as $user) { ?>
                  <tr>
                     <td><?php print $user['userId']; ?></td>
                     <td><?php print $user['fullname']; ?></td>
                     <td><?php print $user['email']; ?></td>
                     <td>
                        <a href="edit_user.php?id=<?php print $user['userId']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete_user.php?id=<?php print $user['userId']; ?>" class="btn btn-danger">Delete</a>
                     </td>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>

            <?php
        } else {
            print '<p>No users found.</p>';
        }
    }
}