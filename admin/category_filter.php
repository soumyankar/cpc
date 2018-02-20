<?php
  include('../connect.php');
  $filter=$_POST['filter'];
  $sql="Select * from complaints where Category='$filter'";
  $result=mysqli_query($conn,$sql);
  $found=mysqli_num_rows($result);
  if(!$found)
  {
    echo "<center><h4 style=\"position:absolute; top:35%; left:40%\">--No Complaints--</h4></center>";
  }
  else
  {
    ?>
    <table align="center" border="5">
      <thead>
        <tr>
          <th>Complaint ID</th>
          <th>Complainant Name</th>
          <th>Complainant Email</th>        
          <th>Complainant Mobile</th>
          <th>Category</th>
          <th>Complaint Status</th>
          <th>Complaint Details</th>
        </tr>
      </thead>
      <tbody>
        <?php
            while($found=mysqli_fetch_array($result,MYSQLI_ASSOC))
            {
              $id=$found['user_id'];
              $sql2="Select * from users where ID='$id'";
              $query=mysqli_query($conn,$sql2);
              $user=mysqli_fetch_array($query,MYSQLI_ASSOC);
              $c_id=$found['Complaint_ID'];
              ?>
              <tr>
                <td><?php echo $c_id; ?></td>
                <td><?php echo $user['First_Name']. " " . $user['Last_Name']; ?></td>
                <td><?php echo $user['Email']; ?></td>
                <td><?php echo $user['Mobile']; ?></td>
                <td><?php echo $found['Category']; ?></td>
                <td><?php echo $found['Complaint_Status']; ?></td>
                <td><a class="btn btn-success" href="admin_complaints.php?c_id=<?php echo $c_id; ?>">See Complaint Details</a></td>
              </tr>
              <?php
            }  
        ?>
      </tbody>
    </table>
    <?php
  }
?>

