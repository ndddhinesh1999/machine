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
        <table style="width:100%;" cellspacing="0" class="report-outer report-border-left  report-border-top">
            <tr>
                <th style="width:7%;  padding:2px;" class="report-border-right " valign="top">#</th>
                <th style="width:20%; padding:2px;" class="report-border-right " valign="top">Activity &<br>Plan</th>
                <th style="width:45%; padding:2px;" class="report-border-right " valign="top">Remark</th>
                <th style="width:20%; padding:2px;" class="report-border-right " valign="top">Before</th>
                <th style="width:20%; padding:2px;" class="report-border-right " valign="top">After</th>
            </tr>

            <?php

            $s_no = 1;
            foreach ($pdfList as $get_main) {
            ?>
                <tr class="<?= $style; ?>">
                    <td colspan="5" style="padding:3px;text-align:center;" class="report-border-right report-border-top report-padding-top-bottom report-table-border-bottom"><b><?= dateGeneralFormat($get_main['dates']) ?></b></td>
                </tr>
                <?php foreach ($get_main['details'] as $get) { ?>

                    <tr class="<?= $style; ?>">
                        <td colspan="5" style="padding:3px;text-align:center;" class="report-border-right report-border-top report-padding-top-bottom report-table-border-bottom"><b><?= dateGeneralFormat($get['activity_name']) ?></b></td>
                        
                    </tr>
                    <?php foreach ($get['activity_details'] as $get_record) { ?>
                        <tr class="<?= $style; ?>">
                            <td style="text-align:center;" class="report-border-right report-border-top report-padding-top-bottom report-table-border-bottom"><?= $s_no++; ?></td>
                            <td style="text-align:center;" class="report-border-right report-border-top report-padding-top-bottom report-table-border-bottom"> <?= $get_record['activity_detail_name']; ?><br><?= $get_record['activity_details_plan']; ?></td>
                            <td style="text-align:center;" class="report-border-right report-border-top report-padding-top-bottom report-table-border-bottom">
                                <p><?= $get_record['preventive_before_text']; ?></p>
                            </td>
                            <td style="text-align:center;" class="report-border-right report-border-top report-padding-top-bottom report-table-border-bottom"><img style="height:80px;" src="<?= !empty($get_record['preventive_before_file']) ? '../../' . $get_record['preventive_before_file'] : './demo.jpg' ?>" alt=""></td>
                            <td style="text-align:center;" class="report-border-right report-border-top report-padding-top-bottom report-table-border-bottom"><img style="height:80px;" src="<?= !empty($get_record['preventive_after_file']) ? '../../' . $get_record['preventive_after_file'] : './demo.jpg' ?>" alt=""></td>


                            <!-- <td style="padding:3px;text-align:center;" class="report-border-right report-border-top report-table-border-bottom "></td> -->
                        </tr>

            <?php
                    }
                }
            }
            ?>
        </table>
        <br />
    </div>
</body>

</html>