<?php
    session_start();

    if(!isset($_SESSION["search_results"])){
        if(isset($_SESSION["last_option"])){
            $redirect = "./php/search.php";
        }else{
            $redirect = "./index.php";
        }
    }
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<?php if(!isset($_SESSION["search_results"])){ ?>
<meta HTTP-EQUIV="REFRESH" content="0; url=<?php echo $redirect;?>" />
<?php } ?>
<title>Βιβλιοθήκες και Υπηρεσίες Πληροφόρησης - Αρχική Σελίδα</title>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/login.css" rel="stylesheet" type="text/css">
<link href="css/search.css" rel="stylesheet" type="text/css">
<link href="css/searchResults.css" rel="stylesheet" type="text/css">
<link href="css/search_library.css" rel="stylesheet" type="text/css">
<script src="scripts/login.js" type="text/javascript"></script>
<script src="scripts/searchswitch.js" type="text/javascript"></script>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
</head>
<body>
<div id="container">
    <div id="header">
        <div id="logo">
            <a href="index.php"><img src="images/uoa.png" alt="logo"></a>
        </div>
        <h1><a href="index.php">
            Βιβλιοθήκες <br/>
                και Υπηρεσίες Πληροφόρησης</a></h1>
        <div id="login">
            Καλώς ήρθες, <?php if(!isset($_SESSION["logged_user"])){?><a class="link1" href='register.php'>Εγγραφή</a> ή <a class="link2"href='#' onclick="toggle_login('login', 'loginBox')">Σύνδεση</a><?php }else{?><a class="link1" href='profile.php'><?php echo $_SESSION["logged_user"]; ?></a> (<a class="link2"href='./php/logout.php'>Αποσύνδεση</a>)<?php } ?>
        </div>
        <div style="color:red;font-size:x-small">
            <?php
                if(isset($_SESSION["login_message"])){
                    echo "<p>".$_SESSION["login_message"]."</p>";
                    unset($_SESSION["login_message"]);
                }
            ?>
        </div>
        <div id="loginBox">
            <div id="uoaAuth"><img class="img1" src="images/education_icons_IF-02-512.png" width="45" height="39"><a class="text" href='#'>Είσοδος μέσω <span class="empty"></span>Κεντρικής </br> Υπηρεσίας Πιστοποίησης</a><img class="img2" src="images/256.png" width="25" height="25">
            </div>
            <form class="nonUoaAuth" method="POST" action="php/login.php">
                <input type="text" name="email" placeholder="E-mail">
                <input type="password" name="password" placeholder="Συνθηματικό">
                <input type="submit" name="login" class="submit" value="Σύνδεση">
            </form>
            <button class="cancel" onclick="toggle_login('loginBox', 'login')">Ακύρωση</button>
        </div>
    </div>
    <div style="clear:both"></div>
    <div id="menu">
    <ul class="button-list">
        <li class="button">
            <div id="dd" class="dropdown-button" tabindex="1">ΥΠΗΡΕΣΙΕΣ
                <ul class="dropdown">
                    <li><a href="#" onclick="toggle_search('searchboxLib', 'searchbox')">Αναζήτηση Περιεχομένου</a></li>
                    <li><a href="#">Σύνθετη Αναζήτηση</a></li>
                </ul>
            </div>
        </li>
        <li class="button">
            <div id="dd1" class="dropdown-button" tabindex="2">ΒΙΒΛΙΟΘΗΚΕΣ
                <ul class="dropdown">
                    <li><a href="#" onclick="toggle_search('searchbox', 'searchboxLib')">Αναζήτηση</a></li>
                    <li><a href="./php/alllibs.php">Πλοήγηση</a></li>
                </ul>
            </div>
        </li>
        <li class="button">
            <div class="link"><a href='#'>ΑΝΑΚΟΙΝΩΣΕΙΣ</a></div>
        </li>
        <li class="button">
            <div class="link"><a class="link" href='#'>ΒΟΗΘΕΙΑ</a></div>
        </li>
        <?php if(isset($_SESSION["logged_user"])){?>
        <li class="button">
            <div id="dd2" class="dropdown-button" tabindex="3"><?php echo $_SESSION["logged_user"]; ?>
                <ul class="dropdown">
                    <li><a href="profile.php">Προφίλ</a></li>
                    <li><a href="./php/logout.php">Αποσύνδεση</a></li>
                </ul>
            </div>
        </li><?php }?>
    </ul>
    </div>
    <div style="clear:both"></div>
    <div id="announcements">
        <div class="title"> Πρόσφατες Ανακοινώσεις</div>
            <ul class="annlist">
                <li class="announcement">a</li>
                <li class="announcement">b</li>
                <li class="announcement">c</li>
                <li class="announcement">d</li>
            </ul>
    </div>
    <div id="rest">
        <form id="searchbox" method="POST" action="./php/search.php">
            <div class="fields">
                <input id="search" type="text" placeholder="Αναζήτηση Περιεχομένου" name="search">
                <input id="submit" type="submit" value="Αναζήτηση">
                <select id="search-options" name="option">
                    <option value="title">Τίτλος</option>
                    <option value="author">Συγγραφέας</option>
                </select>
                <a class="advanced-search" href="advsearch.php">Σύνθετη Αναζήτηση</a>
            </div>
        </form>
        <form id="searchboxLib" method="POST" action="./php/searchlib.php">
        <div class="fieldsLib">
            <input id="searchLib" type="text" placeholder="Αναζήτηση Βιβλιοθήκης" name="libsearch">
            <input id="submitLib" type="submit" value="Αναζήτηση">
            <div style="clear:both"></div>
            <select id="search-optionsLib" name="liboption">
                <option value="libName">Όνομα</option>
                <option value="department">Τμήμα</option>
                <option value="address">Διεύθυνση</option>
            </select>
        </div>
        </form>
        <div class="infobox">
            <div style="color:red;text-align:center">
            <?php
                if(isset($_SESSION["search_message"])){
                    echo "<p>".$_SESSION["search_message"]."</p>";
                    unset($_SESSION["search_message"]);
            ?>
            </div>
            <?php
                }else{
                    if(!isset($_SESSION["logged_user"])){
            ?>
            <div style="color:red;text-align:center"> Δεν είστε συνδεδεμένοι, οπότε η επιλογή δανεισμού είναι απενεργοποιημένη.</div>
            <ul class="resultList">
            <?php
                    }
                    if(isset($_SESSION["search_results"])){
                        $results = $_SESSION["search_results"];
                        $count = $_SESSION["search_count"];
                        $lendedCount = $_SESSION["lended_count"];
                        unset($_SESSION["search_results"]);
                        unset($_SESSION["search_count"]);
                        unset($_SESSION["lended_count"]);


                    for($i = 0; $i < $count; $i++){
            ?>
                <li class="result">
                    <div class="resultText">
                    <div style="font-size:20px;font-weight:bold;color:black;">
                        <?php echo $results[$i]["title"] ?>,
                    </div>
                    <div style="font-size:14px;color:grey;">
                        <?php echo $results[$i]["type"] ?> από τον/την <b><?php echo $results[$i]["author"] ?></b>.<br/> Δημοσιεύτηκε στις <?php echo $results[$i]["publicationDate"] ?>
                    </div>
                    <div style="font-size:16px;color:black;">
                        <form name="hiddenForm" method="POST" action="./php/searchlib.php">
                    <input type="hidden" name="liboption" value="libName">
                    <input type="hidden" name="libsearch" value="<?php echo $results[$i]["libName"] ?>">Βρίσκεται στη βιβλιοθήκη:
                    <a href="javascript:document.forms['hiddenForm'].submit()"><?php echo $results[$i]["libName"] ?></a>
                    </form>
                    </div>
                    </div>
                    <?php
                        if(isset($_SESSION["logged_user"])){
                            $mysqli = mysqli_connect('localhost', 'root', '', 'eam_2016');
                            $mysqli->set_charset("utf8");
                            if($mysqli->connect_errno){echo 'I HATE PHP';}
                            $query = "SELECT * FROM documents WHERE title='".$results[$i]["title"]."' and useridLended=".$_SESSION["logged_user_id"].";";
                            $result = $mysqli->query($query);
                        }
                        if(isset($_SESSION["logged_user"]) && $results[$i]["count(*)"] - $lendedCount[$i] > 0 && $result->num_rows == 0){
                    ;
                    ?>
                    <form name="hiddenForm<?php echo $i ?>" method="POST" action="./php/order.php">
                    <input type="hidden" name="title" value="<?php echo $results[$i]["title"]; ?>">
                    <a href="javascript:document.forms['hiddenForm<?php echo $i ?>'].submit()"><div class="lendButton">Δανεισμός</div></a>
                    </form>
                    <?php
                        }else if(isset($_SESSION["logged_user"]) && $result->num_rows != 0){
                    ?>
                    <a href="#"><div class="lendButtonInactive">Το Έχω</div></a>
                    <?php }else{?>
                    <a href="#"><div class="lendButtonInactive">Δανεισμός</div></a>
                    <?php } ?>
                    <div style="color:grey;float:right;margin-right:35px">
                        Διαθέσιμα: <b style="color:#b34700"><?php
                            echo $results[$i]["count(*)"] - $lendedCount[$i];
                        ?></b>
                    </div>
                    <br style="clear:both"/>
                </li>
            <?php
                    }}
                }
            ?>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript" src="scripts/menu.js"></script>
</body>
</html>
