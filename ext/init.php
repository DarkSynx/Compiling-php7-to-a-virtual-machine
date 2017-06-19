<?php

	define('PATH_LINK', realpath(dirname(".")) . '\\' );
	define('PATH_EXT', PATH_LINK  . 'ext\\' );
	
	echo PHP_EOL,
	 " -- ~~ ====================== ~~ -- ", PHP_EOL ,
	 " -- ~~ = DOWNLOAD MEDIAFIRE = ~~ -- ", PHP_EOL ,
	 " -- ~~ === WIN10 FOR PHP7 === ~~ -- ", PHP_EOL ,
	 " -- ~~ ======   9 GB   ====== ~~ -- ", PHP_EOL ,
	 " -- ~~ ===== 2016--2017 ===== ~~ -- ", PHP_EOL ,
	 " -- ~~ ====================== ~~ -- ", PHP_EOL ,
	 " -- ~~ ====== DARKSYNX ====== ~~ -- ", PHP_EOL ,
	 " -- ~~ ====================== ~~ -- ", PHP_EOL ;
	 
	sleep(2);
	echo PHP_EOL,PHP_EOL;
	
	echo ' ==> Load hash.txt ', PHP_EOL;
	echo ' = ==> scan  : ' , PHP_EOL;
	$lines = file( PATH_EXT . 'hash.txt' );
		$hashtab = array(); $numb_file = 0;
		foreach ($lines as $line_num => $line) {
			list($name,$md5) = explode('=',trim($line));
			$hashtab[$name] = array('md5'=>$md5,'link'=>null,'val'=>null);
			echo "> " , $numb_file++ , ' : ' , $name , PHP_EOL;
			
		}
	echo " =========== ",PHP_EOL;	
	$c = count($hashtab);
	echo "\t",$numb_file , " FILES ",PHP_EOL;
	echo " =========== ",PHP_EOL;
	echo ' ==> Number archive : ' , $c , PHP_EOL;
	
	
	echo ' ==> Load url.txt ', PHP_EOL;
	
	$lines = file( PATH_EXT . 'url.txt');
	foreach ($lines as $line_num => $line) {
		$line = trim($line);
		$name = basename($line);
		$hashtab[$name]['link'] = $line;
	}
	
	
	echo ' ==> Verification and download ', PHP_EOL, PHP_EOL;
	
	$u=0;
	foreach ($hashtab as $l => $k) {
		echo  '[ ', ++$u , '/' ,$c , ' ] : ' , $l , ' ==> ' ;
		ifexist($hashtab,$l,$k);
		if($u == 1) { $first = $l; }
	}

	
	echo PHP_EOL,' ==> Uncompress archive loading ... ', PHP_EOL;
	
	
	echo passthru( PATH_EXT  . 'Rar.exe x ' . PATH_LINK . 'download\\' . $first . " extract\\ 2>&1 ");
	
	echo PHP_EOL;
	echo ' Your File found in the Folder "extract" ', PHP_EOL;
	
	echo PHP_EOL,PHP_EOL,PHP_EOL,PHP_EOL,PHP_EOL,PHP_EOL;
	echo '==== DARKSYNX @ 2016/2017 DOWNLOAD MEDIAFIRE ! ====', PHP_EOL ;
	echo PHP_EOL,PHP_EOL,PHP_EOL,PHP_EOL,PHP_EOL,PHP_EOL;
	sleep(10);
	
	
	function ifexist($hashtab,$l,$k) {
		
		if (file_exists(PATH_LINK . 'download\\' . $l)) {
				echo " \t => File $l exist." , PHP_EOL;
				echo " \t => Verification Hash :: " , $k['md5'] ,' <=> ' ;
				$fmd5 = md5_file(PATH_LINK . 'download\\' . $l);
				echo $fmd5 . ' :: '; 
				if($k['md5'] != $fmd5) {
					echo 'ERROR', PHP_EOL;
					echo " \t => Download File ." , PHP_EOL;			
					downlink($k['link']);
					
					echo " \t => File $l Download New verification " , PHP_EOL;
					ifexist($hashtab,$l,$k);
				}
				 else {
					 echo 'OK', PHP_EOL;
					 $hashtab[$l]['val'] = 'ok';
				 }
			} else {
				echo " \t => File $l does not exist." , PHP_EOL;
				downlink($k['link']);
					echo " \t => File $l Download verification of it " , PHP_EOL;
					ifexist($hashtab,$l,$k);
			}
	}
	
	
	function downlink($link) {
		echo PHP_EOL;
		echo "\t ~> link : ",$link;
		$page = file_get_contents($link);
		$pos1 = strpos($page, 'kNO = "');
		$pos2 = strpos($page, '";',$pos1);
		$lien = substr($page,$pos1 + 7, ($pos2 - ($pos1 + 7)));
		echo "\r\t ~> Download : ", $lien, PHP_EOL , PHP_EOL;
		$name = basename($lien);
		echo passthru( PATH_EXT . 'wget.exe --progress=bar:force -O ' . PATH_LINK . '\\Download\\' . $name . chr(32) . $lien . " 2>&1 ");
		echo PHP_EOL;
	}
	
	
?>