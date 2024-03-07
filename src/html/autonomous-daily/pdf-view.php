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
                <th style="width:20%; padding:2px;" class="report-border-right " valign="top">Label &<br>Standard</th>
                <th style="width:45%; padding:2px;" class="report-border-right " valign="top">Remark</th>
                <th style="width:20%; padding:2px;" class="report-border-right " valign="top">Before</th>
                <th style="width:20%; padding:2px;" class="report-border-right " valign="top">After</th>
            </tr>

            <?php
            $s_no = 1;
            foreach ($pdfList as $get_main) { ?>

                <tr class="<?= $style; ?>">
                    <td colspan="5" style="padding:3px;text-align:center;" class="report-border-right report-border-top report-padding-top-bottom report-table-border-bottom"><b><?= dateGeneralFormat($get_main['dates']) ?></b></td>
                </tr>

                <?php foreach ($get_main['details'] as $get_record) { ?>
                    <tr class="<?= $style; ?>">
                        <td style="text-align:center;" class="report-border-right report-border-top report-padding-top-bottom report-table-border-bottom"><?= $s_no++; ?></td>
                        <td style="text-align:center;" class="report-border-right report-border-top report-padding-top-bottom report-table-border-bottom"> <?= $get_record['label_part']; ?><br><?= $get_record['label_std']; ?></td>
                        <td style="text-align:center;" class="report-border-right report-border-top report-padding-top-bottom report-table-border-bottom">
                            <p><?= $get_record['remark']; ?></p>
                        </td>
                      
                        <td style="text-align:center;" class="report-border-right report-border-top report-padding-top-bottom report-table-border-bottom"><img style="height:80px;" src="<?= !empty($get_record['before_image']) ? '../../' . $get_record['before_image'] : '../../uploads/no-image.png'?>" alt=""></td>
                        <td style="text-align:center;" class="report-border-right report-border-top report-padding-top-bottom report-table-border-bottom"><img style="height:80px;" src="<?= !empty($get_record['after_image']) ? '../../' . $get_record['after_image'] : './demo.jpg' ?>" alt=""></td>


                        <!-- <td style="padding:3px;text-align:center;" class="report-border-right report-border-top report-table-border-bottom "></td> -->
                    </tr>

            <?php
                }
            }
            ?>
        </table>
        <br />

    </div>




</body>

</html>