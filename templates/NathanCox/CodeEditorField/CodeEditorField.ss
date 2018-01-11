<textarea $AttributesHTML>$ValueEntities.RAW</textarea>
<div id='{$ID}_Ace'></div>
<div class='codeeditor-button-bar'>


    <label class="btn btn-secondary tool-button ace-word-wrap-button">
        <input id='{$ID}_Ace_word_wrap' type='checkbox' />
        Word wrap
    </label>

    <%-- Only show toggle Dark/Light if nothing specific is defined --%>
    <% if not $DefaultTheme %>
    <% if $Theme == $DarkTheme || $Theme == $LightTheme %>
    <label class="btn btn-secondary tool-button font-icon-eye ace-theme-button btn--last">
        Toggle theme
    </label>
    <% end_if %>
    <% end_if %>

	<label id="mode-label">$Mode</label>
</div>
