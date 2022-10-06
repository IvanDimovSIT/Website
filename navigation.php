<?php
    function navigation(){
        print("<table><tr><td><div id='login' class='navbarData'><a class='navbarLink' href='index.php'>Log In</a></div></td>
        <td><div id='register' class='navbarData'><a class='navbarLink' href='register.php'>Register</a></div></td>
        <td><div id='posts' class='navbarData'><a class='navbarLink' href='post.php'>Posts</a></div></td>
        <td><div id='me' class='navbarData'><a class='navbarLink' href='user.php?user=".$_SESSION['username']."'>Me</a></div></td>
        </tr></table>");
        print("<script>
        const DEFAULT = document.getElementById('login').style.backgroundColor;
        const NEWCOLOR = 'rgb(170, 170, 230)';
        let login = document.getElementById('login');
        let register =  document.getElementById('register');
        let posts =  document.getElementById('posts');
        let me =  document.getElementById('me');


        login.addEventListener('mouseleave', function(event){
            event.target.style.backgroundColor = DEFAULT;
            console.log('mouse out:', event);
        });

        register.addEventListener('mouseleave', function(event){
            event.target.style.backgroundColor = DEFAULT;
            console.log('mouse out:', event);
        });

        posts.addEventListener('mouseleave', function(event){
            event.target.style.backgroundColor = DEFAULT;
            console.log('mouse out:', event);
        });

        me.addEventListener('mouseleave', function(event){
            event.target.style.backgroundColor = DEFAULT;
            console.log('mouse out:', event);
        });

        login.addEventListener('mouseenter', function(event){
            event.target.style.backgroundColor = NEWCOLOR;
            console.log('mouse enter:', event);
        });

        register.addEventListener('mouseenter', function(event){
            event.target.style.backgroundColor = NEWCOLOR;
            console.log('mouse enter:', event);
        });

        posts.addEventListener('mouseenter', function(event){
            event.target.style.backgroundColor = NEWCOLOR;
            console.log('mouse enter:', event);
        });

        me.addEventListener('mouseenter', function(event){
            event.target.style.backgroundColor = NEWCOLOR;
            console.log('mouse enter:', event);
        });
        
       </script>");
    }
?>