<?php

    include 'autoloader.php';
    $collection = createNameSpaceCollection();
    print_r("<pre>");
    print_r($collection->namespaceArray['fileNamePath']);
    print_r($collection->namespaceArray['namespace']);
    print_r("</pre>");