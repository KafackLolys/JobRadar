<?php

    echo"
    <div class='prophile'>
        <div class='container'>";
        if ($user["prophile"]) {
            echo "<div class='prophile_img' style='background-image: url(../../public/users/$user[prophile]);'></div>";
        } else {
            echo "
            <svg width='100px' height='99px' viewBox='0 0 16 16' fill='none' xmlns='http://www.w3.org/2000/svg' style='margin-left: 20px;'>
                <path
                    d='M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z'
                    fill='#000000' />
                <path d='M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z' fill='#000000' />
            </svg>";
        }
                echo"
            <h3>$user[nom] $user[prenom]</h3>
            <p style='color: dark; font-size:17px;'>$user[email]</p>
            <br>
            <p style='color: gray; font-size:12px;'>$user[pays]</p>
            <br>
            <p>$user[description] ...</p>
        </div>
    </div>
    ";

?>
