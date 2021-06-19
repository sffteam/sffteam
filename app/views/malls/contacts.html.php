<table>
 <tr>
  <td>Name</td>
  <td>Mobile</td>
  <td>Refer Mobile</td>
  <td>ReferName</td>
  <td>DateJoin</td>
 </tr>
<?php foreach($todayJoining as $t){?>
 <tr>
  <td>BEGIN:VCARD<br>VERSION:2.1</td>
 </tr>
 <tr>
  <td>N:<?=$t['name']?>;;;;<br>FN:<?=$t['refer']?></td>
 </tr>
 <tr>
  <td>TEL;VOICE;PREF:+91<?=$t['Mobile']?>;;;;<br>FN:</td>
 </tr>
 <tr>
  <td>NOTE:Categories: Modicare <?=$t['refer']?></td>
 </tr>
 <tr>
  <td>END:VCARD</td>
 </tr>
<?php  }?>
</table>