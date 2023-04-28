<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
/**
 * Bitrix vars
 *
 * @var array $arParams
 * @var array $arResult
 * @var CBitrixComponentTemplate $this
 * @global CMain $APPLICATION
 * @global CUser $USER
 */
?>
<div class="mfeedback">
<?if(!empty($arResult["ERROR_MESSAGE"]))
{
	foreach($arResult["ERROR_MESSAGE"] as $v)
		ShowError($v);
}
if($arResult["OK_MESSAGE"] <> '')
{
	?><div class="mf-ok-text"><?=$arResult["OK_MESSAGE"]?></div><?
}
?>

<form action="<?=POST_FORM_ACTION_URI?>" method="POST">
<?=bitrix_sessid_post()?>

	<div class="mf-name">
		<div class="mf-text">
			<?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
		</div>
		<input type="text" name="user_name" value="<?=$arResult["AUTHOR_NAME"]?>">
	</div>
	<div class="mf-email">
		<div class="mf-text">
			<?=GetMessage("MFT_EMAIL")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
		</div>
		<input type="text" name="user_email" value="<?=$arResult["AUTHOR_EMAIL"]?>">
	</div>
	<div  class="mf-education">
		<div class="mf-text">
			<?=GetMessage("MFT_EDUCATION")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EDUCATION", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
		</div>
		<input id="education" type="text" name="user_Education" onchange="EDSummator()">
	</div>
	<div  class="mf-nationality">
		<div class="mf-text">
			<?=GetMessage("MFT_NATIONALITY")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NATIONALITY", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
		</div>
		<input id="nationality" type="text" name="user_nationality" onchange="NASummator()">
	</div>
	<div  class="mf-zodiac_sign">
		<div class="mf-text">
			<?=GetMessage("MFT_ZODIAC_SIGN")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("ZODIAC_SIGN", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
		</div>
		<input id="zodiac_sign" type="text" name="user_zodiac_sign" onchange="ZOSummator()">
	</div>
	<div  class="mf-favorite_season">
		<div class="mf-text">
			<?=GetMessage("MFT_FAVORITE_SEASON")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("FAVORITE_SEASON", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
		</div>
		<input id="favorite_season" type="text" name="user_favorite_season" onchange="FASummator()">
	</div>


	<div class="mf-progress-circle">
		<div class="mf-text">
			<?=GetMessage("MFT_PROGRESS_CIRCLE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("PROGRESS_CIRCLE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?>
		</div>
		<div class ="progress-circle">
			<svg class ="progress-ring" width = "120" height = "120">
				<circle class="progress-ring__circle" stroke="white", stroke-width="6"
				cx = "60" cy = "60" r ="52" fill = "transparent">
			</svg>	
			
		</div>
		<div id ="progress-circle" class="inside-circle"> </div>
		
	</div>


	<input type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
	
	<script >
		var col = 0;
		var EDsum = 0;
		var NAsum = 0;
		var ZOsum = 0;
		var FAsum = 0;
		document.getElementById('progress-circle').textContent = col + "%";
		function EDSummator()
		{
			var input = document.getElementById('education').value;
			if (input === "" || input.length === 0 || input === null)
			{
				EDsum = 0;
				col -= 25;
				document.getElementById('progress-circle').textContent = col + "%";
			}
			else
			{
				if(EDsum != 1){
					EDsum = 1;
					col += 25;
					document.getElementById('progress-circle').textContent = col + "%";
				}
			}
			setProgress(col)
		}	
		function NASummator()
		{
			var input = document.getElementById('nationality').value;
			if (input === "" || input.length === 0 || input === null)
			{
				NAsum = 0;
				col -= 25;
				document.getElementById('progress-circle').textContent = col + "%";
			}
			else
			{
				if(NAsum != 1){
					NAsum = 1;
					col += 25;
					document.getElementById('progress-circle').textContent = col + "%";
				}
			}
			
			setProgress(col)
		}	
		function ZOSummator()
		{
			var input = document.getElementById('zodiac_sign').value;
			if (input === "" || input.length === 0 || input === null)
			{
				ZOsum = 0;
				col -= 25;
				document.getElementById('progress-circle').textContent = col + "%";
			}
			else
			{
				if(ZOsum != 1){
					ZOsum = 1;
					col += 25;
					document.getElementById('progress-circle').textContent = col + "%";
				}
				
			}
			setProgress(col)
		}	
		function FASummator()
		{
			var input = document.getElementById('favorite_season').value;
			if (input === "" || input.length === 0 || input === null)
			{
				FAsum = 0;
				col -= 25;
				document.getElementById('progress-circle').textContent = col + "%";
			}
			else
			{
				if(FAsum != 1){
					FAsum =1;
					col += 25;
					document.getElementById('progress-circle').textContent = col + "%";
				}
				
			}
			setProgress(col)
		}
		
		const circle = document.querySelector('.progress-ring__circle');
		const radius = circle.r.baseVal.value;
		const circumference = 2 * Math.PI * radius;

		circle.style.strokeDasharray = `${circumference} ${circumference}`;
		circle.style.strokeDashoffset = circumference;

		function setProgress(percent){
			const offset = circumference - percent / 100 * circumference;
			circle.style.strokeDashoffset = offset;
		}
		
	</script>
</form>
</div>