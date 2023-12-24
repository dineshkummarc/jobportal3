<?php include('..\include\header.php');?>
<?php include('..\include\sidebar.php');?>
<?php include('..\include\sessionex.php');?>
<?php 
    $query="select * from company";
    // $query="select * from company right join admin_login ON company.cid=admin_login.id";
    $result=mysqli_query($connection,$query); 
    $raw=mysqli_num_rows($result);  
?>

<div class="p-1 my-container active-cont">
<main role="main" class="col-md-9 ml-sm-auto col-lg-12 pt-3 px-4">
        <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="admin_dashboard.php">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="company.php">Company</a></li>
  </ol>
</nav>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 class="h2">Company</h1>
          <?php if(isset($_SESSION['error'])){?>
          <div class="alert alert-success" role="alert">
            <?php   
                $message=$_SESSION['error'];
                echo $message;
                unset($_SESSION['error']);
            ?>
</div>
<?php }?>
           <a href="add_company.php" class="btn btn-primary">Add Company</a>
          </div>
 <!-- end -->

<!-- data tables -->
<div class="table-responsive">
<table id="example" class="table  table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Description</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>
        <?php
         if($raw>0){
            $sr=0;
          while($data=mysqli_fetch_assoc($result)) {
           
    ?>
            <tr>
                    
        <td><?php echo $data['cname'];?></td>
      <td><?php echo $data['description'];?></td>
      <!-- <td><?php //echo $data['admin_email'];?></td> -->
      <td><a href="edit_company.php?uid=<?php echo $data['cid'];?>"> <i class="fa-solid fa-pen-to-square mr-3"></i></a><a href="company.php?did=<?php echo $data['cid'];?>"><i class="fa-solid fa-trash ml-3"></i></a></td>
      
            </tr>
           
            <?php }}; ?>
        </tbody>
        <tfoot>
            <tr>
                <th>Company Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </tfoot>
    </table>
    </div>
    </div>
<!-- end datatables -->
<!-- delete querry -->
<?php 
        if(isset($_GET['did'])){
           $id=$_GET['did'];
           $query="delete from company where cid=$id";
           $result=mysqli_query($connection,$query);
           if($result){
            $msg="data deleted SuccessFully!";
            $_SESSION['error']=$msg;
        }
        else 
        {
            $msg="data not deleted SuccessFully!";
            $_SESSION['error']=$msg;
        }
        }
    ?>
<?php include('..\include\footer.php');?>
