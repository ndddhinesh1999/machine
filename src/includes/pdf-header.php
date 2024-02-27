<?php
$companyDetails = companyDetails();

?>

<style>
</style>

<table width="100%">
    <tr>
        <td align="left">
            <img src="<?= !empty($companyDetails['logo']) ? $companyDetails['logo'] : '' ?>" alt="" srcset="" class="left-logo">
        </td>
        <td align="center">
            <b style="font-size: 24px;"><?= $companyDetails['name'] ?></b>
            <h5><?= $companyDetails['address'] ?></h5>
        </td>
        <td align="right"> </td>
    </tr>
    <tr>
        <td colspan="3" style="border-bottom: 1px solid grey"></td>
    </tr>
    <tr>
        <td><br></td>
    </tr>
</table>