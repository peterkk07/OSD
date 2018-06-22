<html lang="en">
<head>
  <title>Add Remove input fields dynamically using jQuery bootstrap</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
 
<div class="container">
  <div class="panel panel-default">
    <div class="panel-heading">Add Remove input fields Dynamically using jQuery Bootstrap</div>
    <div class="panel-body">
        <form action="" >
 
        <div class="input-group control-group after-add-more">
      
      
         <input type="text" name="addmore[]" class="form-control" placeholder="Enter Name Here">
            <div class="input-group-btn"> 
            <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
            </div>
        </div>
 
        </form>
    
 
        <!-- Copy Fields-These are the fields which we get through jquery and then add after the above input,-->
        <div class="copy-fields hide">
          <div class="control-group input-group" style="margin-top:10px">
            <input type="text" name="addmore[]" class="form-control" placeholder="Enter Name Here">
            <div class="input-group-btn"> 
              <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
            </div>
          </div>
        </div>
  </div>
  </div>
</div>
 
<script type="text/javascript">
 
    $(document).ready(function() {
 
  //here first get the contents of the div with name class copy-fields and add it to after "after-add-more" div class.
      $(".add-more").click(function(){ 
          var html = $(".copy-fields").html();
          $(".after-add-more").after(html);
      });
//here it will remove the current value of the remove button which has been pressed
      $("body").on("click",".remove",function(){ 
          $(this).parents(".control-group").remove();
      });
 
    });
 
</script>
 
</body>
</html>