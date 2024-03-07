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

        <?php $i = 1;
        $get ?>


        <table style="width:100%;" cellspacing="0" class="report-outer report-border-left report-border-top">
            <tr>
                <th colspan="2" style="padding:.5rem; background:black; color: white" class="report-border-right report-border-bottom" valign="top"><?= $get['machine_name'] ?></th>
                <th class="report-border-right report-border-bottom"><?= $get['category_name'] ?></th>
            </tr>
            <tr>
                <td colspan="2" class="report-border-right report-border-bottom">
                    <p>Machine Number</p>
                    <br>
                    <b><?= $get['machine_number'] ?></b>
                </td>
                <td class="report-border-right report-border-bottom">
                    <p>Machine Model</p>
                    <br>
                    <b><?= $get['machine_model'] ?></b>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="report-border-right report-border-bottom">
                    <p>Machine System</p>
                    <br>
                    <b><?= $get['machine_system'] ?></b>
                </td>
                <td class="report-border-right report-border-bottom">
                    <p>Machine Serial Number</p>
                    <br>
                    <b><?= $get['machine_serial_number'] ?></b>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="report-border-right report-border-bottom">
                    <p>Year Of Manufacture (month,year)</p>
                    <br>
                    <b><?= date("M/Y", strtotime($get['machine_year_of_manufacture'])) ?></b>
                </td>
                <td class="report-border-right report-border-bottom">
                    <p>Location</p>
                    <br>
                    <b><?= $get['machine_location'] ?></b>
                </td>
            </tr>
            <tr>
                <td class="report-border-right report-border-bottom">
                    <p>X-axis</p>
                    <br>
                    <b><?= $get['machine_x_axis'] ?></b>
                </td>
                <td class="report-border-right report-border-bottom">
                    <p>Y-axis</p>
                    <br>
                    <b><?= $get['machine_y_axis'] ?></b>
                </td>
                <td class="report-border-right report-border-bottom">
                    <p>Z-axis</p>
                    <br>
                    <b><?= $get['machine_z_axis'] ?></b>
                </td>
            </tr>
            <tr>
                <td class="report-border-right report-border-bottom">
                    <p>Previously Maintenance Done</p>
                    <br>
                    <b><?= dateGeneralFormat($get['machine_previously_maintanance']) ?></b>
                </td>
                <td class="report-border-right report-border-bottom">
                    <p>Planned Maintenance</p>
                    <br>
                    <b><?= dateGeneralFormat($get['machine_planned_maintanance']) ?></b>
                </td>
                <td class="report-border-right report-border-bottom">
                    <p>Tool Storage Capacity</p>
                    <br>
                    <b><?= $get['machine_total_storage_capacity'] ?></b>
                </td>
            </tr>
            <tr>
                <th colspan="3" class="report-border-right report-border-bottom">
                    <img width="500px" src="../../<?= $get['machine_image'] ?>" alt="" srcset="">
                </th>
            </tr>
        </table>

    </div>

</body>

</html>