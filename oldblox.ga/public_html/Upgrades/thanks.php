<?
	include($_SERVER['DOCUMENT_ROOT'].'/Header1.php');
?>
	<div class='report-abuse-thanks'>
		<div id='ThankYouContainer'>
			<div class='ThankYouCategory'>
				<div class='ThankYouContent'>
					<div class='ThankYouImage'>
						<img src='https://www.world2build.net/Badgess/Administrator.png' width='75'>
					</div>
					<div class='ThankYouDescription'>
						<h2 style='font-weight:normal;margin:0;'>
							Thank you.
						</h2>
						Thank you for purhasing your membership. Please allow up to 24 hours for your membership to be active. 
					</div>
				</div>
				<div class='divider-bottom' style='border-bottom:1px solid #E6E6E6;clear:both;margin-top:15px;'></div>
			</div>
		</div>
		<div class='report-thanks-links'>
			<a href='https://www.world2build.net/' class='btn-primary'>
				Go to Home Page
			</a>
		</div>
	</div>
	<script src='https://www.2checkout.com/static/checkout/javascript/direct.min.js'></script>
	<form action='https://www.2checkout.com/checkout/purchase' method='post'>
<input type='hidden' name='sid' value='1303908' />
<input type='hidden' name='mode' value='2CO' />
<input type='hidden' name='li_0_type' value='product' />
<input type='hidden' name='li_0_name' value='invoice123' />
<input type='hidden' name='li_0_price' value='25.99' />
<input type='hidden' name='card_holder_name' value='Checkout Shopper' />
<input type='hidden' name='street_address' value='123 Test Address' />
<input type='hidden' name='street_address2' value='Suite 200' />
<input type='hidden' name='city' value='Columbus' />
<input type='hidden' name='state' value='OH' />
<input type='hidden' name='zip' value='43228' />
<input type='hidden' name='country' value='USA' />
<input type='hidden' name='email' value='example@2co.com' />
<input type='hidden' name='phone' value='614-921-2450' />
<input name='submit' type='submit' value='Checkout' />
</form>
<?
	include($_SERVER['DOCUMENT_ROOT'].'/Footer.php');
?>