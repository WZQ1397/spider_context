					<br/><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                  <center>
                    
<span>采集站点配置</span> &emsp; &emsp; &emsp;&emsp; &emsp;<span>目标数据库</span><br>

					<select name="data_fetch" id="data_fetch" style="width:200px" >
                  <?php 
					$d = dir($_SERVER['DOCUMENT_ROOT'] . "/dev/spider_context/config/");
					while (($file = $d->read()) !== false) {
					    if (preg_match('/config.json/', $file)) {
					        echo "<option value=" . $file . "\">" . $file . "</option>";
					    }
					}
					$d->close();
					?>
										</select>
					                  					<select name="db_fetch" id="db_fetch" style="width:200px">
					                  <?php 
					$d = dir($_SERVER['DOCUMENT_ROOT'] . "/dev/spider_context/config/");
					while (($file = $d->read()) !== false) {
					    if (preg_match('/database.json/', $file)) {
					        echo "<option value=" . $file . "\">" . $file . "</option>";
					    }
					}
					$d->close();
                    $t=600;
					?>
					</select></center>
					<br/>
                  <?php
   $data_fetch = $_POST["data_fetch"];  $db_fetch= $_POST["db_fetch"]; $para="target=".$data_fetch."&storge=".$db_fetch; $para=str_replace("\"","",$para); echo $para;?>
                  </form>
<a href="zachrun.php?<?php echo $para;?>" target="zachrun"><button onclick="block();display(<?php echo $t; ?>);" id='btn1'>开始采集</button></a>