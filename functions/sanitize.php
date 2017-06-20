<?php

/**
 * Escapes all outputs to prevent xss
 * @param string 
 * @return escaped string
 */
function escape_output($str)
{

	return htmlspecialchars($str,ENT_COMPAT,'UTF-8');
}
?>