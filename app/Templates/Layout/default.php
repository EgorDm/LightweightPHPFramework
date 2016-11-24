<html>
<head>
    <title>GTR</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="http://informatica-cals.nl/edmitriev/js/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="http://informatica-cals.nl/edmitriev/css/main.css"/>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img class="logo"
                                                  src="http://www.endless-resources.org/downloads/rFactor2/ISI_content/Addon_Cars/Nissan_GT-R/Gallery_Right/Nissan_GTR_logo.png"/></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Home</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">Login/Register</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="main-content">
    <div class="container">
        <?= $this->fetch('notification') ?>
        <?php
        $sidebar = $this->fetch('sidebar');
        $using_sidebar = !empty($sidebar);
        ?>
        <div class="row">
            <div class="<?= ($using_sidebar) ? 'col-md-9' : 'col-md-12' ?>">
                <?= $this->fetch('content') ?>
            </div>
            <?php
            if (($using_sidebar)) { ?>
                <div class="col-md-3">
                    <?= $sidebar ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?= $this->fetch('scripts') ?>
</body>
</html>