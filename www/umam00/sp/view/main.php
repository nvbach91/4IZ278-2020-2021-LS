<?php include ('model/update.php')?>
<?php include ('model/update_project.php')?>
<?php include ('model/add_note.php')?>
<?php include ('model/add_project.php')?>
<?php include ('model/project_ver.php') ?>
<?php include ('view/head.php') ?>
<body class="main">

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '347589966714808',
      cookie     : true,
      xfbml      : true,
      version    : 'v11.0'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<?php include('view/sidebar.php'); ?>
    <?php 
    if(isset($_GET["add"]))
    {
        if($_GET["add"] == "note")
        {
            include ('note_form.php');
        }
        elseif($_GET["add"] == "project")
        {
            include ('project_form.php');
        }
        elseif($_GET["add"] == "project_note")
        {
            include ('project_note_form.php');
        }
        else
        {
            include('controller/reset_page.php');
        }
    }
    elseif(isset($_GET["edit"]))
    {
        if($_GET["edit"] == "project")
        {
            include ('project_edit.php');
        }
        else
        {
            include('controller/reset_page.php');
        }
    }
    else if(isset($_GET["note"]))
    {
        include ('view/note_edit.php');
    }
    else if (isset($_GET["projects"]))
    {
        if($_GET["projects"]==null)
        {
            include ('view/projects_list.php');
        }
        elseif(is_numeric(($_GET["projects"])) and empty($_GET["proj_note"]))
        {
            include ('view/project_view.php');
        }
        elseif(is_numeric($_GET["projects"]) and is_numeric($_GET["proj_note"]))
        {
            include ('view/project_note_edit.php');
        }
        else
        {
            include('controller/reset_page.php');
        }
    }
    else if (isset($_GET["shared_projects"]))
    {
        if($_GET["shared_projects"]==null)
        {
            include ('view/shared_projects_list.php');
        }
        elseif(is_numeric(($_GET["shared_projects"])))
        {
            /*include ('view/project_view.php');*/
            include('controller/reset_page.php');
        }
        else
        {
            include('controller/reset_page.php');
        }
    }
    elseif(empty($_GET))
    {
        include ('view/notes_list.php'); 
    }
    elseif(isset($_GET["settings"]))
    {
        include ('view/settings.php');
    }
    else
    {
        include('controller/reset_page.php');
    }
    ?>



