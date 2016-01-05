<?php
if(isset($_POST['upload'])){
    echo 'huj';
    
    header("Location: ../main.php");
}

?>



<div class="content_item">
    <form class="form-inline"  action="contents/upload.php" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="file">Select a file to upload</label>
                    <input type="file" name="file_name">
                 
                  </div>
                    <input type="submit" name="upload" class="btn btn-lg btn-primary" value="Upload">
                </form>
   
</div>
<div class="content_item">
    <form method="post" action="main.php?tab=storage&id=make_dir" class="form-inline">
  <div class="form-group">
    <label for="directory_name">Create Directory</label>
    <input type="text" name="dir_name" class="form-control" id="directory_name" placeholder="Name">
  </div>
  
  <button type="submit" class="btn btn-default">Create</button>
</form>
</div>