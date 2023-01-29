<?php
    include "config/dbConn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Order System</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="style/main.css">
</head>
<body>
    <div class="header">
        <div class="p-3 text-center">
            <h4>Header</h4>
        </div>
    </div>
    <main class="w-100">
        <section class="categoryPage">
            <hr>
            <div class="d-flex p-1">
                <div class="sidebar w-25">
                    <ul>
                        <?php 
                            $fetchCatQuerry="SELECT * FROM category";
                            $querry_result=mysqli_query($conn,$fetchCatQuerry);
                            $i=0;

                            if($querry_result==true){
                                
                                $count=mysqli_num_rows($querry_result);

                                if( $count>0){
                                    while($rows=mysqli_fetch_assoc($querry_result)){
                                        $i++;
                                        $cat_id=$rows['cat_id'];
                                        $cat_name=$rows['cat_name']; 
                                        $cat_image=$rows['cat_icon']; 

                        ?>
                        <li>
                        <a href=<?php echo "category.php?cat=$cat_id"?> >
                            <img src=<?php echo"images/".$cat_image; ?> alt="">
                            <p><?php echo $cat_name; ?></p>
                         </a>
                        </li>
                         
                        <?php
                                    
                                }
                                

                            }
                        }
                        ?> 
                    </ul>
                </div>
                <div class="foods w-75">
                    <div class="container">
                        <div class="row">
                            <?php 
                                $category=$_GET['cat'];
                                settype($category, "integer");

                                $fetchCatQuerry="SELECT c.cat_id, c.cat_name, p.prod_id, p.prod_name, p.prod_price, p.prod_image, p.description 
                                FROM category c, product p WHERE p.prod_cat=c.cat_id AND c.cat_id=$category ORDER BY c.cat_id DESC";

                                $querry_result=mysqli_query($conn,$fetchCatQuerry);
                                $i=0;
                                if($querry_result==true){
                                   
                                    $count=mysqli_num_rows($querry_result);

                                    if( $count>0){
                                        while($rows=mysqli_fetch_assoc($querry_result)){
                                            $i++;
                                            
                                            
                                            $prod_id=$rows['prod_id'];
                                            $prod_name=$rows['prod_name'];
                                            $prod_cat=$rows['cat_name'];
                                            $prod_price=$rows['prod_price'];
                                            $prod_image=$rows['prod_image'];
                                            $description=$rows['description'];

        

                            ?>
                                <div class="col-md-6 px-2">
                                    <div class="border product p-2">
                                        <?php
                                        $img="images/".$prod_cat."/".$prod_image;
                                        echo "<img src=\"$img\" class='prodImg' alt=''>";
                                        ?>
                                        
                                        <span><?php echo $prod_name; ?></span>
                                        <p><?php echo $description; ?></p>
                                        <div class="d-flex">
                                            <div class="w-75"><span>$<?php echo $prod_price; ?></span></div>
                                            <div class="text-end"><span class="btn btn-sm btn-danger">+</span></div>
                                        </div>
                                    </div>  
                                </div>
                            <?php
                                        
                                    }
                                   
                                }
                            }
                            ?> 
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer">
                <h5>Footer</h5>
            </div>
        </section>
    </main>
</body>
</html>