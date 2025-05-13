<?php
    include($_SERVER["DOCUMENT_ROOT"]."/SiT_3/config.php");
    
    $error = array();
    $key = "BhPassForBh1";
    if(!empty($_POST)){
        if($_POST["key"] != $key){
            $error[] = "Incorrect Key!";
        }
        
        if(empty($error)){
            $_SESSION["canAccess"] = "true";
            header("Location: /");
        }
    }
?>
<head>
<title>OFFLINE | Brick-Hill</title>
       <link rel="icon" href="../assets/BH_favicon.png">
        <link href="/assets/new-css/style.css?t=<?=filemtime($_SERVER["DOCUMENT_ROOT"]."/assets/new-css/style.css")?>" rel="stylesheet">
        <style>
            #globalError:empty, .dropdown-content:not(.active) { display: none; }
        </style>
        <title><?=$name?></title>
        <script src="https://js.hcaptcha.com/1/api.js" async defer></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.1/css/all.css?t=<?=time()?>" data-turbolinks-track="true" />
        <script src="https://cdn.jsdelivr.net/npm/vue"></script>
        <style>
            html{
                background-image: url('/maintenance/mains.png')!important;
            }
            body{
                background: none!important;
            }
        </style>
    </head>

    <div style="height:50px;"></div>
<div class="main-holder grid">
<div class="col-1-3 push-1-3">
<?php if($error != null){ ?>
<div class="alert error">
    <?=$error[0]?>
</div>
<?php } ?>
<div class="card">
<div class="top blue">
Maintenance
</div>
<div class="content text-center">
<form method="POST" action="#">
    <div class="input-group fill">
<input name="key" placeholder="Jp Key..." type="text">
<button class="button blue">Submit</button>
</div>
</form>
<a href="https://discord.gg/Hyg5kefsSp" style="font-weight:bold;color:#7289da;"><i class="fab fa-discord"></i>&nbsp;&nbsp;Discord Server</a>
</div>
</div>
    </div>
</div>
<?php
    include($_SERVER["DOCUMENT_ROOT"]."/SiT_3/footer.php");
?>