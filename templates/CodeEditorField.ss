<textarea $AttributesHTML>$Value</textarea>
<div id='{$ID}_Ace'></div>
<div class='codeeditor-button-bar'>
	<button id='{$ID}_Ace_word_wrap' class='ss-ui-button ace-word-wrap-button ss-ui-button-small'>Toggle Word Wrap</button>
	
	<%-- Only show toggle Dark/Light if nothing specific is defined --%>
	<% if not $DefaultTheme %>
	<% if $Theme == $DarkTheme || $Theme == $LightTheme %>
		<button id='{$ID}_Ace_theme' class='ss-ui-button ace-theme-button ss-ui-button-small'>Toggle Light/Dark Theme</button>
	<% end_if %>
	<% end_if %>
	
	<label id="mode-label">$Mode</label>
</div>

 