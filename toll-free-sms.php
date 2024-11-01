<?php
/*
	Plugin Name: Toll Free SMS
	Plugin URI: http://nitinyawalkar.in/wp-plugins/toll-free-sms
	Description: Send Free SMS to your Subscribers using your Way2SMS Account withour leaving wordpress dashboard.
	Version: 1.0
	Author: Mallikarjun Yawalkar
	Author URI: http://nitinyawalkar.in
	License : GPLv2

	Copyright 2012  Mallikarjun Yawalkar  (email : mhyawalkar@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php 	
	function tfs_menu()
	{
	
		$page = add_menu_page( 'Toll Free SMS', 'Toll Free SMS', 'administrator', __FILE__, 'toll_free_sms', plugins_url('/sms.png',__FILE__),3);
		
		add_action( 'admin_print_styles-' . $page, 'tfs_admin_styles' );
	}

	function toll_free_sms()
	{ ?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>

		<script language="javascript">
			$(document).ready(
				function() {
					$("#smsform").hide();
				});
		</script>
		<script language="javascript">
			$(document).ready(function() {
				$("#mobile,#mobile1").keydown(function(event) {
					// Allow: backspace, delete, tab, escape, and enter
					if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 || 
						 // Allow: Ctrl+A
						(event.keyCode == 65 && event.ctrlKey === true) || 
						 // Allow: home, end, left, right
						(event.keyCode >= 35 && event.keyCode <= 39)) {
							 // let it happen, don't do anything
							 return;
					}
					else {
						// Ensure that it is a number and stop the keypress
						if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
							event.preventDefault(); 
						}   
					}
				});
			});		
		</script>
		<script language="javascript">
		$(document).ready(
			function() {
				$("#user").submit(
					function() {
						$("#status").html('<img src="<?php echo plugins_url('/loading.gif',__FILE__); ?>">');
						$.post("<?php echo plugins_url('/login.php',__FILE__); ?>",$("#user").serialize(),function(data) {
							if(data == "Logged in successfully!")
							{
								$("#status").css("color","green");
								$("#status").html(data);
								
								$("#smsform").show();
								$("#userform").hide();
								//$("#userform").load('<?php echo plugins_url('/smsform.php',__FILE__); ?>');
								//window.location="send-sms.php";
								
							} else {
								$("#status").css("color","red");
								$("#status").html(data);
						
							}
						});
						return false;
					}
				);
			}
		);
		</script>
		
		<script language="javascript">
		$(document).ready(
			function() {
				$("#sendsms").submit(
					function() {

					$("#status1").html('<img src="<?php echo plugins_url('/loading.gif',__FILE__); ?>">');
						$.post("<?php echo plugins_url('/sms.php',__FILE__)?>",$("#sendsms").serialize(),function(data) {
							if(data == "Message sent !")
							{
								$("#status1").css("color","green");
								$("#status1").html(data);
							} else {
								$("#status1").css("color","red");
								$("#status1").html(data);
						
							}
						});
						return false;
					}
				);
			}
		);
		</script>

		<script language="javascript" type="text/javascript">
		function limitText(limitField, limitCount, limitNum) {
			if (limitField.value.length > limitNum) {
				limitField.value = limitField.value.substring(0, limitNum);
			} else {
				limitCount.value = limitNum - limitField.value.length;
			}
		}
		</script>		

		<div class="wrap">
			<div class="icon32"><img src="<?php echo plugins_url('/sms32.png',__FILE__);?>"></div><h2>Toll Free SMS</h2>
		<div style="width:68%; float:left;">
			<div id="accordion">
				<h3><a href="#">Send Free SMS to Your Subscribers</a></h3>
				<div>
					<h2 class="title">Send SMS To Your Subscribers using Your Way2SMS Account Without Leaving the Wordpress Admin Area. </h2>
					<div id="userform" style="border:1px solid #111111; padding:5px 10px; margin:5px 0; border-radius:3px;">
						<form method="post" id="user" action="">
							<span class="lbl"><h3>Login to Your Way2SMS Account:</h3></span>
							<span class="error"><h3>Note: We don't store or share your passwords. You will be automatically logged out as soon as you leave the "Toll Free SMS" page.</span></h3>
						<table>
						<tr>
						<td class="lbl"><b>Mobile:</b></td>
						<td><input type="text" class="text" size="20" name="uname" id="mobile" onKeyDown="limitText(this.form.uname,this.form.countdown,11);" 
					onKeyUp="limitText(this.form.uname,this.form.countdown,11);">
						</td>
						</tr>
						<tr>
						<td class="lbl"><b>Password:</b></td>
						<td><input type="password" class="text" size="20" name="pwd"></td>
						</tr>
						<tr>
						<td></td>
						<td><input type="submit" class="button-primary" name="login" value="Login"></td>
						</tr>
						<tr>
						<td></td>
						<td><span id="status"></span></td>
						</tr>
						<tr>
						<td colspan="2"><hr/></td>
						</tr>
						<tr>
						<td colspan="2">Don't have Way2SMS Account? <a href="http://site1.way2sms.com/content/index.html" target="_blank">Get it here.</a></td>
						</tr>
						</table>
						</form>
					</div>
					
					<div id="smsform" style="border:1px solid #111111; padding:5px 10px; margin:5px 0; border-radius:3px;">
						<form action="" method="post" id="sendsms">
							<span class="lbl"><h3>Enter the Subscriber's Mobile No., Type the SMS and Click on Send Button:</h3></span>
							<span class="error"><h3>Note: There is no limit for sending sms.</span></h3>
							<table>
							<tr>
							<td class="lbl"><b>Enter Subscribers Mobile No.:</b></td>
							<td><input type="text" class="text" name="to" size="20" id="mobile1" onKeyDown="limitText(this.form.to,this.form.countdown1,11);" 
					onKeyUp="limitText(this.form.to,this.form.countdown1,11);"></td>
							</tr>
							<tr>
							<td class="lbl"><b>Type Your Message:</b></td>
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
							<td><input type="submit" class="button-primary" name="send" value="Send SMS"></td>
							</tr>
							<tr>
							<td></td>
							<td><span id="status1"></span></td>
							</tr>
							</table>
							</form>
					
					</div>
					
				</div>
			</div>
			<div id="accordion2">
				<h3><a href="#">Help Improve The Development!</a></h3>
				<div>
				<?php 
					$siteurl = get_option('siteurl');
					$donate = $siteurl . '/wp-content/plugins/' . basename(dirname(__FILE__)) . '/images/btn_donate.gif';			
				?>
					<p align="justify">We develop & support all of our plugins for free. If you use this plugin and find it useful please consider a donation as a token of your appreciation.</p>
					<div align="center">
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
							<input type="hidden" name="business" value="nitiny892@gmail.com">
							<input type="hidden" name="cmd" value="_donations">
							<input type="hidden" name="item_name" value="Friends of Mallikarjun Yawalkar">
							<input type="image" name="submit" src="<?php echo $donate;?>">
						</form>
					</div>
				</div>
			</div>
		</div>
		<div style="width:30%; float:right;">
			<div id="accordion5">
				<h3><a href="#">Visit My Sites</a></h3>
				<div>
					<ul type="square">
						<li><span style="font-family:webdings; font-weight:bold; padding-right:5px;">2</span><a href="http://nitinyawalkar.in/#utm_source=wpadmin&utm_medium=sidebar&utm_term=link&utm_campaign=wordpress+plugins" style="text-decoration:none;">My Personal Blog</a></li>
						<li><span style="font-family:webdings; font-weight:bold; padding-right:5px;">2</span><a href="http://www.fairyhost.in/#utm_source=wpadmin&utm_medium=sidebar&utm_term=link&utm_campaign=wordpress+plugins" style="text-decoration:none;">Fairyhost Technologies</a></li>
						<li><span style="font-family:webdings; font-weight:bold; padding-right:5px;">2</span><a href="http://nxtweb.in/#utm_source=wpadmin&utm_medium=sidebar&utm_term=link&utm_campaign=wordpress+plugins" style="text-decoration:none;">Web Inspiration - Technology Blog</a></li>
					</ul>				
				</div>
			</div>
			<div id="accordion1">
				<h3><a href="#">Support Forum</a></h3>
				<div>
					<p align="justify">Toll Free SMS Plugin Support is available at Wordpress.org support forum.</p>
					<p><button class="button-primary"><a href="http://wordpress.org/support/plugin/toll-free-sms" style="color:#FFFFFF; text-decoration:none;">Visit Support Forum</a></button></p>
				</div>
			</div>
			<div id="accordion3">
				<h3><a href="#">Subscribe to Facebook Updates</a></h3>
				<div>
					<p><div class="fb-subscribe" data-href="https://www.facebook.com/yawalkar.nitin" data-show-faces="true" data-width="280"></div></p>
				</div>
			</div>
			<div id="accordion4">
				<h3><a href="#">Other Plugins by The Author</a></h3>
				<div>
					<ul type="square">
						<li><span style="font-family:webdings; font-weight:bold; padding-right:5px;">Z</span><a href="http://wordpress.org/extend/plugins/rdfa-breadcrumb/" style="text-decoration:none;">RDFa Breadcrumbs</a></li>
						<li><span style="font-family:webdings; font-weight:bold; padding-right:5px;">Z</span><a href="http://wordpress.org/extend/plugins/facebook-subscriber-widget/" style="text-decoration:none;">Facebook Subscriber Widget</a></li>
						<li><span style="font-family:webdings; font-weight:bold; padding-right:5px;">Z</span><a href="http://wordpress.org/extend/plugins/google-authorship-widget/" style="text-decoration:none;">Google Authorship Widget</a></li>
						<li><span style="font-family:webdings; font-weight:bold; padding-right:5px;">Z</span><a href="http://wordpress.org/extend/plugins/google-add-to-circle/" style="text-decoration:none;">Google Add to Circle</a></li>
						<li><span style="font-family:webdings; font-weight:bold; padding-right:5px;">Z</span><a href="http://wordpress.org/extend/plugins/df-pagination/" style="text-decoration:none;">DF-Pagination</a></li>
						<li><span style="font-family:webdings; font-weight:bold; padding-right:5px;">Z</span><a href="http://wordpress.org/extend/plugins/admin-menu-tamplate-plugin/" style="text-decoration:none;">Admin Menu Blank Template Plugin</a></li>
					</ul>
				</div>
			</div>		
		</div>
	</div>					
<?php
	}
	
	function tfs_admin_styles() 
	{
		wp_enqueue_style( 'jquery_style' );

		wp_enqueue_script( 'tfs-jquery' );
		wp_enqueue_script( 'tfs-jquery-ui' );
		wp_enqueue_script( 'tfs-jquery-accord' );
	}
	
	function tfs_styles() 
	{
		wp_register_style( 'jquery_style', plugins_url('/css/toll_free_sms.css', __FILE__) );

		wp_register_script( 'tfs-jquery', plugins_url('/js/jquery.js', __FILE__) ); 
		wp_register_script( 'tfs-jquery-ui', plugins_url('/js/jquery-ui.js', __FILE__) );
		wp_register_script( 'tfs-jquery-accord', plugins_url('/js/accord.js', __FILE__) ); 
	}
	// Add settings link on plugin page
	function tfs_settings_link($links) { 
	  $settings_link = '<a href="admin.php?page=Toll-Free-SMS/toll-free-sms.php">Send SMS</a>'; 
	  array_unshift($links, $settings_link); 
	  return $links; 
	}	
	
	$plugin = plugin_basename(__FILE__); 
	add_filter("plugin_action_links_$plugin", 'tfs_settings_link' );
	
	add_action( 'admin_init', 'tfs_styles' );
	add_action( 'admin_menu','tfs_menu' );
?>