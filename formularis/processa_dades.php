<?php

    print_r ("Text: " .$_REQUEST["mytext"]."<br>");

    print_r ("Radio value: " .$_REQUEST["myradio"]."<br>");

    if(isset($_REQUEST["mycheckbox"])){
        echo ("Check value: " . print_r ($_REQUEST["mycheckbox"])."<br>");
    }

    if(isset($_REQUEST["myselect"])){
        print_r  ("Group value: " . ($_REQUEST["myselect"])."<br>");
    }

    print_r ("Area de text: " .$_REQUEST["mytextarea"]."<br>");

?>