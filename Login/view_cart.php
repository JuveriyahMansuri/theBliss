<?php
include 'con12.php';
session_start();
$username = $_SESSION['username'];
$output = "";

$query = "SELECT user_id FROM User WHERE user_name = '$username';";
                    $uid = mysqli_query($con, $query);
                    while($row = mysqli_fetch_assoc($uid)){
                        $user = $row['user_id'];
                    }
                    $pqty = mysqli_query($con, "SELECT product_id,quantity FROM Cart WHERE user_id = $user;");
                    //$t = "SELECT SUM(price) FROM Product WHERE product_id IN (SELECT product_id FROM Cart WHERE user_id = $user);";
                    //$total = mysqli_query($con,  $t);
                    //$amt = mysqli_fetch_assoc($total);
                    while($price = mysqli_fetch_array($pqty)){
                        
                    }
                   
                    
                    $amount = 0;
                    $sql = "SELECT * FROM Cart WHERE user_id = '$user';";
                    $res1 = mysqli_query($con, $sql);
                    if (mysqli_num_rows($res1) > 0) {             
                        while($rows = mysqli_fetch_assoc($res1))
                        {
                            $pid = $rows['product_id'];
                            $sql2 = "SELECT * FROM Product WHERE product_id = '$pid';";
                            $res2 = mysqli_query($con,$sql2);
                            while ($row2 = mysqli_fetch_array($res2)){
                                $amt = $row2['price'] * $rows['quantity'];
                                $amount = $amount + $amt;
                                $output .='
                                        <li>
                                        <a href="#" class="photo"><img src="image/Project_images/' . $row2['display_picture'] .'" class="cart-thumb" alt="Image" /></a>
                                        <h6><a href="#">'. $row2['name'] .'</a></h6>
                                        <p> '. $rows['quantity']." - ". '<span class="price"> '. $row2['price'] .'</span></p>
                                    </li>';
                                    

                                    

                                       
                                }
                            }
                            $output .='
                            <li class="total">
                            <a href="cart.php" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                            <span class="float-right"><strong>Total</strong>: '. "₹".$amount  .'</span>
                            </li></ul></li>';
                        }
                        echo $output;
                    ?>

