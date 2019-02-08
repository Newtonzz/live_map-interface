<!--

// ************************************************************************** //
//            LiveMap Interface - The web interface for the livemap
//                    Copyright (C) 2017  Jordan Dalton
//
//      This program is free software: you can redistribute it and/or modify
//      it under the terms of the GNU General Public License as published by
//      the Free Software Foundation, either version 3 of the License, or
//      (at your option) any later version.
//
//      This program is distributed in the hope that it will be useful,
//      but WITHOUT ANY WARRANTY; without even the implied warranty of
//      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//      GNU General Public License for more details.
//
//      You should have received a copy of the GNU General Public License
//      along with this program in the file "LICENSE".  If not, see <http://www.gnu.org/licenses/>.
// ************************************************************************** //

-->
<!DOCTYPE html>

<?php
    require_once("utils/minifier.php");
    require_once("utils/config.php");
    require_once("utils/params.php");
    require_once("utils/update_checker.php");
    //require_once("utils/servers.php");

    Update::getCurrentVersion();

    $debug = true;

    $parser = ParamParser::getParser();

    if(ISSET($_GET["server"])){
        /*
        $name = $_GET["server"];

        if(array_key_exists($name, Config::$servers)){
            $srv = Config::$servers[$name];
        }else{
            $name = key(Config::$servers); // get the first server in array
            $srv = Config::$servers[$name];
        }
        */

        unset($_GET["server"]);
    }else{
        $name = key(Config::$servers); // get the first server in array
        $srv = Config::$servers[$name];
    }
?>

<html>
<head>
    <meta charset="utf-8">
    <title>Havoc's Live map</title>

    <!-- Pin favicon from: https://www.freefavicon.com/freefavicons/objects/iconinfo/map-pin-152-195874.html -->
    <link href="data:image/x-icon;base64,AAABAAEAEBAAAAEAIABoBAAAFgAAACgAAAAQAAAAIAAAAAEAIAAAAAAAAAQAABILAAASCwAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP74zAv++Mwn/vjMMf74zDH++Mwm//jMCQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAD++c0d/vnNROPLnGDw4bRX/vnNQ/75zRkAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACFKwBThSsAQgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACFLQABhSwAvIUsAKyGLgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAhS0AYYUtAP+FLQD+hS0AUgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACGLgAAhi4AYYUtAPmFLQD/hS0A/4UtAPWGLgBVhi4AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACHLwABhi4AkoUuAP+MMQD/uEQA/7ZDAP+LMAD/hS4A/oYuAIONNAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAhzAAWoYvAP/DTQD//8Ay///mSP//5Uj//7ov/7dHAP+FLwD+hi8ASgAAAAAAAAAAAAAAAAAAAAAAAAAAiC0AAIYwAM2UNgD//888///pS///6Uv//+lL///pS///xjf/jTMA/4UwAL0AAAAAAAAAAAAAAAAAAAAAAAAAAIYxAAmGMAD66WQN///qTP//6Uz//+lM///pTP//6Uz//+pM/9NYCP+FMADxhTAAAwAAAAAAAAAAAAAAAAAAAACFMQALhTEA/PduE///6k3//+pN///qTf//6k3//+pN///qTf/iYg7/hTEA84MxAAMAAAAAAAAAAAAAAAAAAAAAhDEAAYQxANemQwH//+RK///qTf//6k3//+pN///qTf//30j/mjwA/4UxAMcAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACEMgBshDEA//93Gf//50z//+tO///rTv//5Ev/8W0V/4QxAP+EMgBbAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAgzIAA4MyAK+CMQD/tEwH//+AH///fh7/rUgF/4IxAP+BMQCggDEAAQAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACDMgAEgjIAc4MyAOCDMgD+gzIA/oEyANyCMgBqgDEAAgAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAB+MAACgTIAFn4xABV/MQABAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA+B8AAPgfAAD+fwAA/D8AAPw/AADwDwAA4AcAAOAHAADABwAAwAMAAMADAADABwAA4AcAAOAHAADwDwAA/D8AAA==" rel="icon" type="image/x-icon">

    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700">
    <?php
        // Print the CSS stuff for the webapp. This will either print the minfied version or, links to the CSS filees
        Minifier::printCss($debug);
    ?>
	<link type="text/css" rel="stylesheet" href="style/fontawesome-all.min.css" />

    <script src="js/jquery-3.2.1.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/bootstrap-notify.min.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
        integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
        crossorigin=""/>

    <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
        integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
        crossorigin=""></script>


    <?php
        Minifier::printFirstJs($debug);
    ?>

</head>
<body>

    <nav class="navbar navbar-dark navbar-expand-md">
        <!-- At some point, I'll add more stuff here. For the time being, it'll just be the site logo -->
        <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="https://github.com/TGRHavoc/">
                    <img src="https://avatars1.githubusercontent.com/u/1770893?s=460&v=4" style="max-height: 30px" >
                    Live Map v<?php echo Update::$version ?>
            </a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Servers -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Select a server
                        </a>
                        <div id="server_menu" class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" role="button" id="sidebarTooggle" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-label="Toggle sidebar" aria-expanded="false">
                            Hide/Show Controls
                        </a>
                    </li>


                    <li class="nv-item">
                        <a class="nav-link" role="button" id="blipToggle" data-toggle="collapse" data-target="#blip-filter-dropdown" aria-controls="blip-filter-dropdown" aria-label="Toggle blip controls" aria-expanded="false">
                            Blip controls
                        </a>
                    </li>

                </ul>
            </div>
        </div>

    </nav>

    <div id="wrapper" class="container-fluid">
        <div id="control-wrapper" >
            <div id="sidebar" class="custom-menu col-md-2 col-sm-6 col-xs-12 float-left collapse">
                <div class="list-group border-0 card text-center text-md-left" style="padding: 8px 0;">

                    <a class="nav-header">Controls</a>

                    <a class="list-group-item d-inline-block collapsed" id="refreshBlips" href="#">
                        <span class="d-md-inline">Refresh Blips</span>
                    </a>

                    <a id="showBlips" href="#" class="list-group-item d-inline-block collapsed">
                        <span class="d-md-inline">Show Blips</span>
                        <span id="blips_enabled" class="badge badge-pill badge-success pull-right">on</span>
                    </a>

                      <!--
                      <li>
                          <a id="toggleLive" href="#">Live update <span id="live_enabled" class="badge badge-danger pull-right">off</span></a>
                      </li>
                      -->
                    <a id="reconnect" href="#" class="list-group-item d-inline-block collapsed">
                        <span class="d-md-inline">Connect</span>
                        <span id="connection" class="badge badge-pill badge-danger pull-right">disconnected</span>
                    </a>

                    <a class="list-group-item d-inline-block collapsed">
                        <span class="d-md-inline">Track Player</span>

                        <select id="playerSelect" class="input-large form-control pull-right">
                            <option></option>
                        </select>
                    </a>
                </div>

                <div class="list-group border-0 card text-center text-md-left" >
                    <a class="nav-header">Information</a>

                    <a class="list-group-item d-inline-block collapsed">Currently viewing:
                        <p id="server_name" style="white-space: normal; color: #17A2B8">
                        </p>
                    </a>

                    <a class="list-group-item d-inline-block collapsed">Blips loaded
                        <span id="blip_count" class="badge badge-pill badge-info pull-right">0</span>
                    </a>

                    <a class="list-group-item d-inline-block collapsed">Online players
                        <span id="player_count" class="badge badge-pill badge-info pull-right">0</span>
                    </a>
                </div>

                <div class="list-group border-0 card text-center text-md-left" style="margin-top: 10px;">
                    <p style="text-align: center;">This was originaly created by <a href="https://github.com/TGRHavoc">Havoc</a></p>
                </div>
            </div>

            <div id="blip-filter-dropdown" class="custom-menu col-sm-0 col-xs-0 col-md-12 collapse">
                <div class="list-group border-0 card text-center text-md-left" style="padding: 8px 0;">

                    <a class="nav-header">Blip Controls <small id="toggle-all-blips" class="btn btn-sm btn-info">Toggle all</small></a>

                    <div id="blip-control-container" class="row">

                    </div>

                </div>
            </div>
        </div>

        <main id="map-holder" class="col-12 main" >
            <div id="map-canvas" style="position: relative; overflow: hidden; background-color: rgb(15, 168, 210);"></div>
        </main>
    </div>

<?php
    Minifier::printLastJs($debug);
    $parser->printJsForParams();
    if(!Update::latestVersion()){
        echo Update::alertJs();
    }
?>

    <script>
    var greenIcon = L.icon({
		iconUrl: 'images/icons/debug.png',

		iconSize:     [23, 32], // size of the icon
		iconAnchor:   [23, 32/2], // point of the icon which will correspond to marker's location
		popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });
    var normalIcon = L.icon({
		iconUrl: 'images/icons/normal.png',

		iconSize:     [23, 32], // size of the icon
		iconAnchor:   [23, 32/2], // point of the icon which will correspond to marker's location
		popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
    });
    </script>
</body>

</html>
