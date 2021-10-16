<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>
    
<!--  <form method="POST">
   <table>
    <tr>
        <td><label for="">User</label></td>
        <td><input type="text" name="user"></td>
    </tr>
     <tr>
    <td><label for="">passowrd</label></td>
    <td><input type="text" name="passowrd"></td>
    </tr>
      <tr>
       <td>
       <button type="subemet" name="sub">inscr</button> <span><button type="reset">rest</button> </span>
       </td>
      </tr>
   </table>
</form>-->
<div class="container">
<form method="POST" enctype="multipart/form-data" >
  <table class='mt-3'>
    <tr>
        <td>
            <label >insert file </label>
        </td>
        <td>
           <input type="file" name="file" accept="image/*" require />
        </td>
       <td>
           <button class="btn btn-info" type="submit" name="upload">Uplaod</button>
       </td>
       </tr>
  </table>   
</form>
<form method="POST"><button  name='click'> Delete </button></form>
<form method="GET" class="d-flex">
    <table>
        <tr>
            <td><input type="search" class="form-control form-control-lg" aria-label="Search"  style="width:300px;"   name="serch"  require></td>
            <td><button type="submit" class="btn btn-warning" name="serche">serch</button></td>
        </tr>
        <tr>
            <td></td>
        </tr>
    </table>
  
  
   
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>

<?php
$user="root";
$password="";
$database=new PDO("mysql:host=localhost;dbname=users;charset=utf8",$user,$password);
$download=$database->prepare("SELECT * FROM files ");
$download->execute();

  if(isset($_POST['click'])){
    $delete=$database->prepare("DELETE FROM files WHERE Id= 4");
    if($delete->execute()){
        echo "delete is OK";
    }else{
        echo "delete not OK";
    } 

  }

   if(isset($_GET['serche'])){
       $dataserche="%".$_GET['serch']."%";
       $serch=$database->prepare("SELECT * FROM user1 WHERE nom LIKE :dataserch ");
       $serch->bindParam("dataserch",$dataserche);
       $serch->execute();
        foreach($serch AS $data_value){

      echo  '<span>
             <span class="card text-dark bg-warning mb-3" style="max-width: 18rem;">
             <div class="card-header">Resulta</div>
             <div class="card-body">
             <h5 class="card-title">'.$data_value['nom'].'</h5>
             <p class="card-text">'. $data_value['prenom'] .'</p>
             <p class="card-text">'. $data_value['age'] .'</p>
              </div>
              </span>';
          
    
   }
   }
  



    foreach($download AS $data){
          $datafina="data:".$data['typ'].";base64,".base64_encode($data['files']);
        echo "<a href='".$datafina."' download>".$data['nom']."</a><br>";
       /* echo "<img src='".$datafina."' width='300px'/>";*/
      
    }
  
if(isset($_POST['upload'])){
    $filetype=$_FILES['file']["type"];
    $filename=$_FILES['file']["name"];
    $file=file_get_contents($_FILES['file']["tmp_name"]);
   
    $uplaodfile=$database->prepare("INSERT INTO files (nom,typ,files)  VALUES(:namee,:typee,:posi)");
    $uplaodfile->bindParam("namee", $filename);
    $uplaodfile->bindParam("typee",$filetype) ;
    $uplaodfile->bindParam("posi",$file) ;   
     var_dump($uplaodfile->errorInfo());
    if($uplaodfile->execute()){
        echo "file uplaoud";
        
    }else{
        echo "euror";
    }


    
    
}




/*if(isset($_POST['sub'])){
    $user=$_POST['user'];
    $pass=$_POST['passowrd'];
    $sql=$database->prepare("INSERT INTO user(user,passowrd) VALUES(:userr,:passw)");
    
   $sql->bindParam("userr",$user);
   $sql->bindParam("passw",$pass);
    if($sql->execute()){
         echo " its good";
    }else{
         echo "its Not good";
    } 
}*/
  /*$sql=$database->prepare("SELECT * FROM user");
      $sql->execute();
     /* $sql=$sql->fetch(PDO::FETCH_ASSOC); /* array liste */
      /*echo "<h1>".$sql['user']."</h1>";   /* afichier comme  arraylist */
      /*$sql=$sql->fetchObject(); /*pour recuprer les donnees de la forme Objet*/
      /*echo $sql->user; /* afficher sur la form Objet */
      /*var_dump($sql);*/
/*if($database){
    echo "base de donnée connect";
}*/
/*$username = "root";
$password="";
$basededone = new PDO("mysql:host=localhost;dbname=users;charset=utf8",$username,$password);

if($basededone){
   echo "best connected";
}*/
/*$sql = $basededone->prepare("INSERT INTO user1(nom,prenom,age) VALUES('belkacem1','fares1','27')"); /* جميع اوامر sql */
/*$sql->execute();*/ /* تنفيذ اوامر sql */
  
/*$recpr=$basededone->prepare("SELECT * FROM user1");
$recpr->execute();

/*var_dump($recpr->errorInfo());/* يساعد على إيجاد الخطأ في الكود*/

/*foreach($recpr AS $resulta){
  echo "<h1 >" .$resulta['nom'] ."</h1> <br>";
  echo "<h1 >" .$resulta['prenom'] ."</h1> <br>";
}
 /*إسترجاع البيانات من قاعدة البيانات  */ 
  
/*if(isset($_POST['send'])){
    $nom= $_POST['nom'];
$prenom=$_POST['prenom'];
$age=$_POST['age'];
$sql = $basededone->prepare("INSERT INTO user1(nom,prenom,age) VALUES(:nom,:prenom,:age)"); /* جميع اوامر sql */
/* تنفيذ اوامر sql */
/*$sql->bindParam("nom",$nom);
$sql->bindParam("prenom",$prenom);
$sql->bindParam("age",$age);
if($sql->execute())
echo "تم إيضافة البيانات بنجاح" ;
else{
    echo "حدث خطأ";
}
}
*/

?>




