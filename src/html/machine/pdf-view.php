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
        <table style="width:100%;" cellspacing="0" class="report-outer report-border-left report-border-top">
            <tr>
                <th colspan="2" style="padding:.5rem; background:black; color: white" class="report-border-right report-border-bottom" valign="top">Machine Name</th>
                <th class="report-border-right report-border-bottom">Type</th>
            </tr>
            <tr>
                <td colspan="2" class="report-border-right report-border-bottom">
                    <p>Machine Number</p>
                    <br>
                    <b>M123546587ASD1254</b>
                </td>
                <td class="report-border-right report-border-bottom">
                    <p>Machine Model</p>
                    <br>
                    <b>Hybrid</b>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="report-border-right report-border-bottom">
                    <p>Machine System</p>
                    <br>
                    <b>Automatic</b>
                </td>
                <td class="report-border-right report-border-bottom">
                    <p>Machine Serial Number</p>
                    <br>
                    <b>S150</b>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="report-border-right report-border-bottom">
                    <p>Year Of Manufacture (month,year)</p>
                    <br>
                    <b>05/03/2024</b>
                </td>
                <td class="report-border-right report-border-bottom">
                    <p>Location</p>
                    <br>
                    <b>Chennai</b>
                </td>
            </tr>
            <tr>
                <td class="report-border-right report-border-bottom">
                    <p>X-axis</p>
                    <br>
                    <b>000</b>
                </td>
                <td class="report-border-right report-border-bottom">
                    <p>Y-axis</p>
                    <br>
                    <b>000</b>
                </td>
                <td class="report-border-right report-border-bottom">
                    <p>Z-axis</p>
                    <br>
                    <b>000</b>
                </td>
            </tr>
            <tr>
                <td class="report-border-right report-border-bottom">
                    <p>Previously Maintenance Done</p>
                    <br>
                    <b>5 Done</b>
                </td>
                <td class="report-border-right report-border-bottom">
                    <p>Planned Maintenance</p>
                    <br>
                    <b>3</b>
                </td>
                <td class="report-border-right report-border-bottom">
                    <p>Tool Storage Capacity</p>
                    <br>
                    <b>500</b>
                </td>
            </tr>
            <tr>
                <th>
                    <img src="https://media.istockphoto.com/id/1404463239/photo/the-multi-tasking-cnc-lathe-machine-swiss-type-milling-cut-the-metal-parts-by-milling-spindle.jpg?s=612x612&w=0&k=20&c=bDKmO6kzOFthf_Jaml2L8T42CDng-LdHZmABxucljEA=" alt="" srcset="">
                </th>
            </tr>
        </table>
    </div>

</body>

</html>