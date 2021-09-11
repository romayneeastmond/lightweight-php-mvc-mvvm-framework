<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>MVC/MVVM Annotations Framework: <?php echo $this->title;?></title>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $this->path();?>public/css/default.css">
    <?php $this->injectCSS();?>
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo $this->route("welcome");?>">Framework Demo</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li <?php if (isset($this->menuHomeActive)):?> class="active" <?php endif;?>><a href="<?php echo $this->route("welcome");?>">Home</a></li>
                    <li <?php if (isset($this->menuAboutActive)):?> class="active" <?php endif;?>><a href="<?php echo $this->route("about");?>">About</a></li>
                    <li <?php if (isset($this->menuContactActive)):?> class="active" <?php endif;?>><a href="<?php echo $this->route("contact");?>">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Examples <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo $this->route("simple-controller-example");?>">Controllers</a></li>
                            <li><a href="<?php echo $this->route("default-model-binding-example");?>">Models</a></li>
                            <li><a href="<?php echo $this->route("action-view-example");?>">Views</a></li>
                            <li><a href="<?php echo $this->route("view-model-annotated-binding-example");?>">ViewModels</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="<?php echo $this->route("defining-annotations-example");?>">Annotations</a></li>
                            <li><a href="<?php echo $this->route("defining-bundles-example");?>">Bundles</a></li>
                            <li><a href="<?php echo $this->route("defining-aliases-example");?>">Aliases</a></li>
                            <li><a href="<?php echo $this->route("defining-routes-example");?>">Routing</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?php
        $this->renderBody();
        ?>
    </div>
    <footer class="footer">
        <div class="container">
            <p class="text-muted text-center"></p>
        </div>
    </footer>
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <?php $this->injectJavascript();?>
</body>
</html>