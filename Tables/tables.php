<?php
class tables{
   public function users_table(){
      global $conf, $ObjFncs, $SQL;
      $users = $SQL->select_while("SELECT * FROM roles WHERE roleId > 1 ORDER BY roleId ASC");
      $spot_init = $SQL->select("SELECT MIN(roleId) AS minRoleId FROM roles WHERE roleId > 1");

      $min_row = $spot_init['minRoleId'];
?>
      <ul class="nav nav-tabs" role="tablist">
         <?php
         if($users) {
            foreach($users as $index => $role) {
               $active_class = ($role['roleId'] == $min_row) ? 'active' : '';
         ?>
               <li class="nav-item" role="presentation"><button class="nav-link <?php echo $active_class; ?>" href="#tab-table<?php echo $role['roleId']; ?>" data-bs-toggle="tab" data-bs-target="#tab-table<?php echo $role['roleId']; ?>"><?php echo ucwords($role['roleName']); ?></button></li>
         <?php
            }
         }
         ?>
      </ul>
      <div class="tab-content pt-2">
   <?php
   // Dynamic tabs for each role
         if($users){
            foreach($users as $index => $role) {
               $activeClass = ($role['roleId'] == $min_row) ? 'active' : '';
               ?>
               <div class="tab-pane <?php echo $activeClass; ?>" id="tab-table<?php echo $role['roleId']; ?>">
                  <table id="myTable<?php echo $role['roleId']; ?>" class="table table-striped table-bordered" cellspacing="0" width="100%">
                     <thead>
                           <tr>
                              <th>ID</th>
                              <th>Full Name</th>
                              <th>Email</th>
                              <th>Role</th>
                           </tr>
                     </thead>
                  </table>
               </div>
            <?php
            }
         }
   ?>
      </div>
   <?php
    }
}