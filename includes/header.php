<div class="header-top">
    <div class="container">
        <div class="logo">
            <a href="index.php"><img src="images/images.jpg" alt=""></a>
        </div>
        <div class="top-nav">
                <span class="menu"><img src="images/menu.png" alt="">  </span>
                    <ul >
                        <li ><a href="index.php" > Home </a></li>
                        <li><a href="user/signin.php" > User</a></li>
                        <li><a href="police/signin.php" >Police</a></li> 
                        <li><a href="admin/signin.php" >Admin</a></li> 
                    <div class="clearfix"> </div>
                    </ul>
                    <script>
                        $("span.menu").click(function(){
                            $(".top-nav ul").slideToggle(500, function(){
                            });
                        });
                    </script>
                </div>  
<div class="clearfix"></div>                
    </div>
</div>