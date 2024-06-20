<?php
	class Site {
		public function stringToURL($string)
		{
			$list = array(
				'Š' => 'S',
				'š' => 's',
				'Đ' => 'Dj',
				'đ' => 'dj',
				'Ž' => 'Z',
				'ž' => 'z',
				'Č' => 'C',
				'č' => 'c',
				'Ć' => 'C',
				'ć' => 'c',
				'À' => 'A',
				'Á' => 'A',
				'Â' => 'A',
				'Ã' => 'A',
				'Ä' => 'A',
				'Å' => 'A',
				'Æ' => 'A',
				'Ç' => 'C',
				'È' => 'E',
				'É' => 'E',
				'Ê' => 'E',
				'Ë' => 'E',
				'Ì' => 'I',
				'Í' => 'I',
				'Î' => 'I',
				'Ï' => 'I',
				'Ñ' => 'N',
				'Ò' => 'O',
				'Ó' => 'O',
				'Ô' => 'O',
				'Õ' => 'O',
				'Ö' => 'O',
				'Ø' => 'O',
				'Ù' => 'U',
				'Ú' => 'U',
				'Û' => 'U',
				'Ü' => 'U',
				'Ý' => 'Y',
				'Þ' => 'B',
				'ß' => 'Ss',
				'à' => 'a',
				'á' => 'a',
				'â' => 'a',
				'ã' => 'a',
				'ä' => 'a',
				'å' => 'a',
				'æ' => 'a',
				'ç' => 'c',
				'è' => 'e',
				'é' => 'e',
				'ê' => 'e',
				'ë' => 'e',
				'ì' => 'i',
				'í' => 'i',
				'î' => 'i',
				'ï' => 'i',
				'ð' => 'o',
				'ñ' => 'n',
				'ò' => 'o',
				'ó' => 'o',
				'ô' => 'o',
				'õ' => 'o',
				'ö' => 'o',
				'ø' => 'o',
				'ù' => 'u',
				'ú' => 'u',
				'û' => 'u',
				'ý' => 'y',
				'ý' => 'y',
				'þ' => 'b',
				'ÿ' => 'y',
				'Ŕ' => 'R',
				'ª' => 'a',
				'º' => 'o',
				'ŕ' => 'r',
				'/' => '-',
				' ' => '-',
				'.' => '-',
				'#' => '-',
				'+' => '-',
				':' => '-',
				'!' => '',
				',' => '-',
				'"' => '',
				'\'' => '',
				')' => '',
				'(' => '',
				'?' => '',
				'%' => ''
			);

			$string = strtr($string, $list);
			$string = preg_replace('/-{2,}/', '-', $string);
			$string = preg_replace('/--/', '-', $string);
			$string = strtolower($string);
			return $string;
		}

		public function curl($url) {
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) ecko/20080311 Firefox/2.0.0.13');
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
			$result = curl_exec($ch);
			$result = json_decode($result);
			return $result;
		}

		public function mail($remetente, $destinatario, $titulo, $mensagem)
		{
			$headers = "MIME-Version: 1.1\r\n";
			$headers .= "Content-type: text/html; charset=utf-8\r\n";
			$headers .= "From: $remetente\r\n"; // remetente
			$headers .= "Return-Path: $destinatario \r\n"; // return-path
			$envio = mail($destinatario, $titulo, $mensagem, $headers); 
		}

		public function matarSite()
		{
			exit();
		}

		public function banirIP()
		{
			global $db;

			$consulta = $db->prepare("SELECT * FROM `ac_ips_banidos` WHERE ip = :ip");
			$consulta->bindValue(':ip', $_SERVER['REMOTE_ADDR']);
			$consulta->execute();

			if ($consulta->rowCount() == 0) {
				$banir = $db->prepare("INSERT INTO `ac_ips_banidos`(`ip`, `ban_timestamp`) VALUES (:ip, :timestamp)");
				$banir->bindValue(':ip', $_SERVER['REMOTE_ADDR']);
				$banir->bindValue(':timestamp', time());
				$banir->execute();
			}
		}

		public function verificaIP()
		{
			global $db;
			$consulta = $db->prepare("SELECT * FROM `ac_ips_banidos` WHERE ip = :ip");
			$consulta->bindValue(':ip', $_SERVER['REMOTE_ADDR']);
			$consulta->execute();

			if ($consulta->rowCount() > 0) {
				$this->matarSite();
			}
		}

		public function filtro($str)
		{
			if (!empty($str)) {
				//Retira tags e aspas
				$str = strip_tags($str);
				$str = htmlspecialchars($str);

				//Retira alguns textos por precaução
				$palavrasProibidas = array('\r', '\n', 'DELETE *', 'SELECT *', 'UPDATE *', 'DROP TABLE');
				$strSemFiltroMalicioso = $str;
				foreach ($palavrasProibidas as $palavra) {
					$str = str_ireplace($palavra, '', $str);
				}
				
				if ($strSemFiltroMalicioso !== $str) {
					$this->banirIP();
					$this->matarSite();
				} else {
					return $str;
				}
			} else {
				return $str;
			}
		}

		public function limpaGlobais()
		{
			foreach ($_POST as $campo => $valor) {
				$_POST[$campo] = $this->filtro($valor);
			}

			foreach ($_GET as $campo => $valor) {
				$_GET[$campo] = $this->filtro($valor);
			}
		}
	}
?>