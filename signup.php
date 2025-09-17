<?php
require 'ClassAutoLoad.php';
$ObjLayouts->header($conf);
$ObjLayouts->navbar($conf);
$ObjLayouts->banner($conf);
$ObjLayouts->form_content($conf, $ObjForms);
$ObjLayouts->footer($conf);