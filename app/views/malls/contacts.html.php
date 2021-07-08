<table>
<?php foreach($todayJoining as $t){?>
 <tr>
  <td>BEGIN:VCARD<br>VERSION:2.1</td>
 </tr>
 <tr>
  <td>N:<?=$t['name']?>;;;<br>FN:<?=$t['refer']?></td>
 </tr>
 <tr>
  <td>X-ANDROID-CUSTOM:vnd.android.cursor.item/nickname;<?=$t['mca']?>;1;;;;;;;;;;;;;</td>
 </tr>
 <tr>
  <td>TEL;CELL;PREF:+91<?=$t['Mobile']?></td>
 </tr>
 <tr>
  <td>ORG: Modicare, WeCapacitate - <?=$self['mcaName']?></td>
 </tr>
 <tr>
  <td>URL:https://sff.team/malls/ytdgpv/<?=$t['mca']?></td>
 </tr>
 <tr>
  <td>X-ANDROID-CUSTOM:vnd.android.cursor.item/contact_event;<?=$t['DateJoin']?>;0;Joining Date;;;;;;;;;;;;</td>
 </tr>
 <tr>
  <td>X-CUSTOM(CHARSET=UTF-8,ENCODING=QUOTED-PRINTABLE,Whatsapp):+91<?=$t['Mobile']?></td>
 </tr>
 <tr>
  <td>X-ANDROID-CUSTOM:vnd.android.cursor.item/relation;Business;10;;;;;;;;;;;;;</td>
 </tr>
 <tr>
  <td>NOTE:Categories: Modicare <?=$t['refer']?></td>
 </tr>
 <tr>
  <td>END:VCARD</td>
 </tr>
<?php  }?>
</table>