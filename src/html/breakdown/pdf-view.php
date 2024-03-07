<head>
    <?php if ($path != 'localhost') { ?>
        <link rel="stylesheet" href="<?= PROJECT_PATH ?>/src/assets/css/pdf-table-style.css" />
    <?php   } ?>

</head>

<body>
    <?php
    require_once "../../includes/pdf-header.php";
    ?>


    <div id="wrapper">
        <table style="width:100%;" cellspacing="0" class="">

            <?php
            $s_no = 1;
            foreach ($pdfList as $get_main) { ?>
                <tr>
                    <td colspan="2" style=" padding:3px;" class="report-border-left report-border-right report-border-top report-padding-top-bottom  " valign="top">Date: <br> <b> <?= dateGeneralFormat($get_main['year_breakdown_date']) ?> </b> </td>
                    <td colspan="10" style=" padding:3px;" class="report-border-left report-border-right report-border-top report-padding-top-bottom  " valign="top">Machine Name: <br> <b><?= $get_main['machine_name'] ?></b> </td>
                    <td colspan="3" style=" padding:3px;" class="report-border-left report-border-right report-border-top report-padding-top-bottom  " valign="top">Type:<br> <b> VMC </b> </td>
                </tr>
                <tr>
                    <td colspan="9" style=" padding:3px;" class="report-border-left report-border-right report-border-top report-padding-top-bottom  " valign="top">Nature of Problem:<br> <b> <?= $get_main['year_breakdown_problem'] ?> </b> </td>
                    <td colspan="3" style=" padding:3px;" class="report-border-left report-border-right report-border-top report-padding-top-bottom  " valign="top">Downtime - From: <br> <b><?= $get_main['year_breakdown_downtime_from'] ?></b> </td>
                    <td colspan="3" style=" padding:3px;" class="report-border-left report-border-right report-border-top report-padding-top-bottom  " valign="top">Downtime - To:<br> <b> <?= $get_main['year_breakdown_downtime_to'] ?> </b> </td>
                </tr>
                <tr>
                    <td colspan="7" style=" padding:3px;" class="report-border-left report-border-right report-border-top report-padding-top-bottom  " valign="top">Root Cause: <br> <b><?= $get_main['year_breakdown_root_case'] ?> </b> </td>
                    <td colspan="4" style=" padding:3px;" class="report-border-left report-border-right report-border-top report-padding-top-bottom  " valign="top">Action Taken/Planned:<br> <b> <?= $get_main['year_breakdown_planned'] ?></b> </td>
                    <td colspan="4" style=" padding:3px;" class="report-border-left report-border-right report-border-top report-padding-top-bottom  " valign="top">Spare Changed / Purchased: <br> <b><?= $get_main['year_breakdown_purchase'] ?> </b> </td>
                </tr>
                <tr>
                    <td colspan="5" style=" padding:3px;" class="report-border-left report-border-right report-border-top report-padding-top-bottom  " valign="top">Attended By: <br> <b><?= $get_main['year_breakdown_attended_by'] ?> </b> </td>
                    <td colspan="5" style=" padding:3px;" class="report-border-left report-border-right report-border-top report-padding-top-bottom  " valign="top">Before - Description:<br> <b> <?= $get_main['year_breakdown_before_text'] ?></b> </td>
                    <td colspan="5" style=" padding:3px;" class="report-border-left report-border-right report-border-top report-padding-top-bottom  " valign="top">After - Description:<br> <b> <?= $get_main['year_breakdown_after_text'] ?> </b> </td>
                </tr>
                <tr>
                    <td colspan="5" style=" padding:3px;" class="report-border-left report-border-right report-border-top report-padding-top-bottom report-table-border-bottom " valign="top">Attended By Image: <br> <b> </b> </td>
                    <td colspan="5" style=" padding:3px;" class="report-border-left report-border-right report-border-top report-padding-top-bottom report-table-border-bottom " valign="top">Before - Image: <br> <b>
                            <img style="height:80px;" src="<?= !empty($get_main['year_breakdown_before_image']) ? $get_main['year_breakdown_before_image'] : './demo.jpg' ?>" alt="">
                        </b> </td>

                    <td colspan="5" style=" padding:3px;" class="report-border-left report-border-right report-border-top report-padding-top-bottom report-table-border-bottom " valign="top">After - Image: <br> <b>
                            <img style="height:80px;" src="<?= !empty($get_main['year_breakdown_after_image']) ? $get_main['year_breakdown_after_image'] : './demo.jpg' ?>" alt="">
                        </b> </td>
                </tr>
                <tr>
                    <td colspan="15"><br> </td>
                </tr>
                <tr>
                    <td colspan="15"><br> </td>
                </tr>
            <?php
            }
            ?>
        </table>
        <br />

    </div>




</body>

</html>