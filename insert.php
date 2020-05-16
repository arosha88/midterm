
<?php
include('db.php');
include('function.php');
if(isset($_POST["operation"]))
{
 if($_POST["operation"] == "Add")
 {
  $image = '';
  if($_FILES["user_image"]["name"] != '')
  {
   $image = upload_image();
  }
  $statement = $connection->prepare("
   INSERT INTO users (Bname, Bauthor, image) 
   VALUES (:Bname, :Bauthor, :image)
  ");
  $result = $statement->execute(
   array(
    ':Bname' => $_POST["Bname"],
    ':Bauthor' => $_POST["Bauthor"],
    ':image'  => $image
   )
  );
  if(!empty($result))
  {
   echo 'Data Inserted';
  }
 }
 if($_POST["operation"] == "Edit")
 {
  $image = '';
  if($_FILES["user_image"]["name"] != '')
  {
   $image = upload_image();
  }
  else
  {
   $image = $_POST["hidden_user_image"];
  }
  $statement = $connection->prepare(
   "UPDATE users 
   SET Bname = :Bname, Bauthor = :Bauthor, image = :image  
   WHERE id = :id
   "
  );
  $result = $statement->execute(
   array(
    ':Bname' => $_POST["Bname"],
    ':Bauthor' => $_POST["Bauthor"],
    ':image'  => $image,
    ':id'   => $_POST["user_id"]
   )
  );
  if(!empty($result))
  {
   echo 'Data Updated';
  }
 }
}

?>
   