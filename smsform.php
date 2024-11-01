
	<form action="" method="post" id="sendsms">
		<table>
		<tr>
		<td class="lbl">Mobile No.:</td>
		<td><input type="text" class="text" name="to" size="20"></td>
		</tr>
		<tr>
		<td class="lbl">Message:</td>
		<td rowspan="5"><font size="2"><textarea cols="30" class="text" rows="5" name="sms"  onKeyDown="limitText(this.form.sms,this.form.countdown,160);" 
onKeyUp="limitText(this.form.sms,this.form.countdown,160);"></textarea></font></td>
		</tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr></tr>
		<tr>
		<td></td>
		<td><font size="1">(Maximum characters: 160)<br>
		You have <input readonly type="text" name="countdown" size="3" value="160"> characters left.</font></td>
		</tr>
		<tr>
		<td></td>
		<td><input type="submit" name="send" value="Send SMS"></td>
		</tr>
		<tr>
		<td></td>
		<td><span id="status"></span></td>
		</tr>
		</table>
		</form>
