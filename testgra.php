<?php
function test_case($case)
{
    global $cases, $test_verbose, $n_tests, $n_pass, $n_fail, $test_save;
    $n_tests++;
    extract($cases[$case]);
    $title = "Test case {$n_tests}: {$data_type} (should match {$like})";
    # Make a data array that is valid (but not necessarily reasonable)
    # for any data type. One works for all except pie chart.
    if (!empty($pie)) {
        $plot_type = 'pie';
        $data = array(array('', 1), array('', 1), array('', 2));
    } else {
        $plot_type = 'lines';
        # Valid for text-data, data-data, and data-data-error:
        $data = array(array('', 1, 2, 2, 2), array('', 2, 4, 1, 1), array('', 3, 5, 2, 2));
    }
    $p1 = new PHPlot(400, 300);
    $p1->SetFailureImage(False);
    $p1->SetPrintImage(False);
    $p1->SetDataValues($data);
    $p1->SetDataType($data_type);
    // Alias data type
    $p1->SetPlotType($plot_type);
    $p1->DrawGraph();
    $p1_image = $p1->EncodeImage('raw');
    if ($test_save) {
        file_put_contents("dta-{$case}a_{$data_type}.png", $p1_image);
    }
    $p2 = new PHPlot(400, 300);
    $p2->SetFailureImage(False);
    $p2->SetPrintImage(False);
    $p2->SetDataValues($data);
    $p2->SetDataType($like);
    // Base data type - alias should match this
    $p2->SetPlotType($plot_type);
    $p2->DrawGraph();
    $p2_image = $p2->EncodeImage('raw');
    if ($test_save) {
        file_put_contents("dta-{$case}b_{$like}.png", $p2_image);
    }
    if ($p1_image == $p2_image) {
        $n_pass++;
        if ($test_verbose) {
            echo "Pass: {$title}\n";
        }
    } else {
        $n_fail++;
        echo "FAIL - Image Mismatch: {$title}\n";
    }
}
<?
