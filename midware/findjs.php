<?php 
function readjs(){
					$d = dir($_SERVER['DOCUMENT_ROOT'] . "/dev/spider_context/config/");
					while (($file = $d->read()) !== false) {
					    if (preg_match('/config.json/', $file)) {
					        echo "<option value=" . $file . "\">" . $file . "</option>";
					    }
					}
					$d->close();}
?>