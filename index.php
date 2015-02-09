<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title>Auto Mutual</title>
    <link rel="shortcut icon" href="favicon.ico" />
    <link rel="stylesheet" type="text/css" href="mutual.css" />
    <link rel="stylesheet" type="text/css" href="p.css" />
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
</head>

<body>
    <?php include 'config.php'; ?>
    <style>
        body {
            background-image: url('<?=$bg?>');
        }
    </style>
    <script language="javascript">
        function mutual() {

            $.ajax({
                type: 'GET',
                url: 'request.php',
                data: 'id=' + $('#user1').val(),
                dataType: 'html',
                success: function(response) {
                    $('#mutual').fadeOut(500, function() {
                        $('#insidemutual').html(response);
                    });
                    $('#mutual').fadeIn(500);
                }
            });
        }
    </script>
    <div id="wrapper">
        <div id="logo" style="position: relative;">
            <a href="//osu.ppy.sh/u/<?echo $u;?>"><img src="<?=$logo?>" style="border-radius: 20px;"></a>
        </div>
        <br/>

        <a href="//osu.ppy.sh/u/<?=$u;?>"><img src="http://osusig.ppy.sh/image1.png?u=<?=$u?>&amp;m=<?=$m?>" style="direction: ltr"></a>
        <?php
			for($i=0;$i<4;$i++){
				if ($i==$m) continue;
		?>
			<a href="//osu.ppy.sh/u/<?=$u;?>"><img src="http://osusig.ppy.sh/image1.png?u=<?=$u?>&amp;m=<?=$i?>" style="direction: ltr"></a>
		<?php
			}
		?>
			<div id="mutual_user"></div>


			<center>
				<div id="mutual">
					<div id="insidemutual">
						Become <?=$u;?>'s mutual friend!</div>
				</div>
				<br/>
				<br/>
				<form id="eee">
					<input id="user1" class="username" name="user1" size="15" maxlength="40" tabindex="0" type="text" placeholder="Your osu! ID">
					<script type="text/javascript">
						document.getElementById('user1').focus()
					</script>
					<input type="hidden" hidden="true" id="start" name="start" value="0" />
					<input style="display:inline" tabindex="-1" id="click" type="submit" size="15" value="Mutual" onclick="mutual();return false;" onsubmit="return false;" /> &nbsp;
				</form>
				<div id="language">
					osu! Auto Mutual by <a href="http://wa.vg">jebwizoscar</a>
					<br/> Edit by <a href="http://hazelzhu.com">Hazel_Zhu</a>
				</div>



				<div id="howto">
					<center>
						<div id="howtomutual">How to become
							<?=$u;?>'s mutual friend?</div>
						<table>
							<tr>
								<td>
									<a class="btn" style="background: orange;min-width: 20px;">1</a>
								</td>
								<td>
									<a href="//osu.ppy.sh/u/<?echo $u;?>" class="btn" style="background:#5db8ef;"><i class="icon-plus-sign"></i> Add as Friend</a>
								</td>
								<td>
									<a class="btn" style="background:#ff0000;min-width: 20px;"><i class="icon-arrow-right"></i></a>
								</td>
								<td>
									<a class="btn" style="background:#54bd21;"><i class="icon-minus-sign"></i> Friend</a>
								</td>
							</tr>

							<tr>
								<td>
									<a class="btn" style="background: orange;min-width: 20px;">2</a>
								</td>
								<td>
									<a class="btn" style="background:#733047;">Type your name</a>
								</td>
								<td>
									<a class="btn" style="background:#ff0000;min-width: 20px;"><i class="icon-arrow-right"></i></a>
								</td>
								<td>
									<input id="sync" class="username" style="width:139px; height:28px; padding:0px; font-size: 16px; text-align: center;" type="text" value="your username" disabled="true">
								</td>
							</tr>

							<tr>
								<td>
									<a class="btn" style="background: orange;min-width: 20px;">3</a>
								</td>
								<td>
									<a class="btn" style="background:#787ede;" onclick="mutual();return false;" onsubmit="return false;">Click Mutual</a>
								</td>
								<td>
									<a class="btn" style="background:#ff0000;min-width: 20px;"><i class="icon-arrow-right"></i></a>
								</td>
								<td>
									<a class="btn" style="background:#ef77af;"><i class="icon-heart"></i> Mutual Friend</a>
								</td>
							</tr>

						</table>
					</center>
				</div>

				<div id="more">
					<pre style="text-align: left;">
					<?php $file = fopen($fr,"r"); echo fread($file,1000000);fclose($file);?>
					</pre>
				</div>
			</center>
    </div>
</body>
<script language="javascript">
    $('#user1').keyup(function() {
        $('#sync').val($('#user1').val());
    });
</script>

</html>