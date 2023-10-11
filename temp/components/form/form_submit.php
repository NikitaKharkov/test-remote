<?
	if( !isset($jsValidateFunction) )
		$jsValidateFunction = "validate";
?>
		<div id="errorMessageWrapper">
			<div id="errorMessage">
				<div id="errorMessageInner">&#160;</div>
				<div id="submitFields" class="buttons">
					<a href="javascript:<?=$jsValidateFunction?>()">
					<img id="submitButtonLabel" src="images/buttonSubmit.gif" alt="Submit"/>
					</a>
				</div>
			</div>
		</div>
