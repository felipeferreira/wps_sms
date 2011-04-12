 <?php include 'sms_manager.php'; ?>
<?
$mobile="552199999999";
$msg=" Seu Primeiro Envio de SMS via PHP usado o Gateway Mobile Pronto.";
$credencial="XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
$usuariomaster = "MPGATEWAY";
$msg = URLEncode($msg);
$response =
fopen(" http://www.mpgateway.com/v_2_00/smspush/enviasms.aspx?Credencial=".$credencial."&Principal_User="
.$usuariomaster."&Aux_User=USUAUX&Mobile=".$mobile."&Send_Project=S&Message=".$msg,"r");
$status_code= fgets($response,4);
echo "Status code = ".$status_code;
?>

