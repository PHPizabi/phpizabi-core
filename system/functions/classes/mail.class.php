<?php
///////////////////////////////////////////////////////////////////////////////////////
// PHPizabi 2.01 Alpha [Madison]                             http://www.phpizabi.org //
///////////////////////////////////////////////////////////////////////////////////////
//                                                                                   //
// Please read the LICENSE.md & README.md file before using/modifying this software  //
//                                                                                   //
// Developing Author:       Andrew James, RubberDucky - andy@phpizabi.org            //
// Last modification date:  December 13th, 201                                       //
// Version:                 PHPizabi 2.01 Alpha                                      //
//                                                                                   //
// (C) 2005, 2006 Real!ty Medias                                                     //
// (C) 2007-2012 AndyJames.Org                                                       //
//                                                                                   //
// PHPizabi Is the work of a very talented development team. This script is our      //
// Pride and Joy. We hope that you enjoy using this software as much as we enjoy     //
// Developing it for you. If you need anything: http://www.phpizabi.org              //
//                                                                                   //
///////////////////////////////////////////////////////////////////////////////////////

	// SENDMAIL CLASS ////////////////////////////////////////////////////////////////////////////////
	class SendMail {
		
		// PUBLIC VARS ///////////////////////////////////////////////////////////////////////////////
		/* Basic settings */
		var $To;												// Holds the destination name/address, can be: email or name <email>
		var $From;												// Holds the source name/address, can be: email or name <email>
		var $Subject;											// Holds the message subject string
		var $Body;												// Holds the message body strong
		
		/* SMTP Settings */
		var $SMTPHost = 	"localhost";						// SMTP Host
		var $SMTPPort = 	25;									// SMTP Port
		var $SMTPUser;											// SMTP Authentication username
		var $SMTPPassword;										// SMTP Authentication password
		var $SMTPTimeout = 	10;									// SMTP Timeout
		
		/* Advanced settings */
		var $MailMethod = 	"mail";								// Sets the mailing method; mail, tinymail, smtp, sendmail
		
		var $Charset = 		"iso-8859-1";						// Sets the mail body charset to use 
		var $Encoding = 	"8bit";								// Transfer-Encoding; 8bit, 7bit, binary, base64, quoted-printable
		var $SendmailPath =	"/usr/sbin/sendmail";				// Path to sendmail (required if MailMethod == sendmail)
		var $EOL = 			"\n";								// "End-Of-Line" character(s)
		var $TAB = 			"\t";								// Tabulation character
		var $CRLF =			"\r\n";								// Carriage Return + LineFeed
		
		/* Internal variables */
		var $Boundary;											// Message boundary code holder
		var $Headers;											// Holds the formatted headers
		var $FormattedBody;										// Holds the formatted body (from $Body)
		
		/* Handle Wrappers */
		var $SMTPHandle;										// SMTP Socket Public Handle Wrapper
		
		// SEND //////////////////////////////////////////////////////////////////////////////////////
		function Send() {
			
			$this->MakeHeaders();
			$this->MakeBody();

			switch($this->MailMethod) {
				
				case("mail"): default:
					$initial_from_state = ini_get("sendmail_from");
					ini_set("sendmail_from", $this->ExtractSDAddress($this->From));
					
					$MailResult = @mail(
						$this->FormatSDAddress($this->To),
						$this->FormatHeader($this->Subject),
						$this->FormattedBody,
						$this->Headers,
						"-oi -f ".$this->ExtractSDAddress($this->From)
					);

					ini_set("sendmail_from", $initial_from_state);
				break;
				
				case("tinymail"):
					$MailResult = @mail(
						$this->FormatSDAddress($this->To),
						$this->Subject,
						$this->Body
					);
				break;
				
				case("smtp"):
					$this->SMTPOpen();
					if (!empty($this->SMTPUser) and !empty($this->SMTPPassword))
						$this->SMTPAuthenticate();
					$MailResult = $this->SMTPSendData();
					$this->SMTPClose();
				break;
				
				case("sendmail"):
					if ($pointer = popen($this->SendmailPath." -oi -f ".$this->ExtractSDAddress($this->From)." -t", "w")) {
						fputs($pointer, $this->Headers);
						fputs($pointer, $this->FormattedBody);
						$MailResult = (((pclose($pointer) >> 8) & 0xFF) == 0 ? true : false);
					}
					else $MailResult = false;
				break;
				
			}
			
			return $MailResult;
		}
		
		// MAKE HEADER ///////////////////////////////////////////////////////////////////////////////
		function MakeHeaders() {
			
			/* Build the boundary key */
			if (empty($this->Boundary)) 
				$this->Boundary = md5(uniqid(time(), 1));
			
			/* Build the headers array */
			$headers[0] =		'Date: '.date("r");
			$headers[1] = 		'Return-Path: '.$this->ExtractSDAddress($this->From);
			// #2 added with condition, later
			$headers[3] = 		'From: '.$this->FormatSDAddress($this->From);
			// #4 added with condition, later
			$headers[5] =		'Message-ID: <'.md5(uniqid(time(), 1)).'@'.$_SERVER['HTTP_HOST'] .'>';
			$headers[6] =		'X-Priority: 3';
			$headers[7] =		'X-Mailer: '.(isset($GLOBALS["SYSTEM_VERSION"]) ? $GLOBALS["SYSTEM_VERSION"] : "PHPizabi");
			$headers[8] = 		'MIME-Version: 1.0';
			$headers[9] =		'Content-Type: multipart/alternative; '.$this->EOL.$this->TAB.'boundary="'.$this->Boundary.'"';

			/* Conditional headers, we won't add some things using "mail()" as it already do */
			if ($this->MailMethod != "mail") {
				$headers[2] =	'To: '.$this->FormatSDAddress($this->To);
				$headers[4] =	'Subject: '.$this->Subject;
			}
			
			/* Compile the headers array into the public member */
			ksort($headers);
			$this->Headers = implode($this->EOL, $headers);
			
			/* The mail() function already adds the trailing EOL, add those manually if we're not using mail() */
			if ($this->MailMethod != "mail")
				$this->Headers .= $this->EOL . $this->EOL;
				
			/* Append a last EOL to the headers */
			$this->Headers .= $this->EOL;

			return true;
			
		}
		
		// MAKE BODY /////////////////////////////////////////////////////////////////////////////////
		function MakeBody() {
			
			/* 
				Using this new class, a mail can be set as HTML/PLAIN using body tags. The <htmlmail>
			 	and the <plainmail> markers will define what part acts as a HTML part and what part
				is to be used as the plain one. If both (open/close) tags of both types (html/plain)
				can be found in the body, we will use those to form the formatted body. For retro
				compatibility purposes, we will also handle bodies with no markers (plain) with or
				without HTML content. This is done by using the same body for both parts and stripping
				the html tags from the version to use in the plain body.
			*/
			if (preg_match('%<htmlmail>(.*)</htmlmail>%si', $this->Body, $matchHTML) 
				and
				preg_match('%<plainmail>(.*)</plainmail>%si', $this->Body, $matchPlain)) {
				
				$body_HTML = $matchHTML[1];
				$body_Plain = $matchPlain[1];
			}
			
			else {
				$body_HTML = $this->Body;
				$body_Plain = strip_tags($this->Body);
			}
			
			/* Build the boundary key */
			if (empty($this->Boundary)) 
				$this->Boundary = md5(uniqid(time(), 1));
			
			/* Build the body format */
			$body[0] = 		'--'.$this->Boundary;
			$body[1] =		'Content-Type: text/plain; charset = "'.$this->Charset.'"';
			$body[2] = 		'Content-Transfer-Encoding: '.$this->Encoding;
			$body[3] =		$this->EOL;
			$body[4] =		$this->BodyEncode($body_Plain);
			$body[5] =		$this->EOL . $this->EOL;
			$body[6] =		'--'.$this->Boundary;
			$body[7] = 		'Content-Type: text/html; charset = "'.$this->Charset.'"';
			$body[8] = 		'Content-Transfer-Encoding: '.$this->Encoding;
			$body[9] = 		$this->EOL;
			$body[10] =		$this->BodyEncode($body_HTML);
			$body[11] =		$this->EOL . $this->EOL . $this -> EOL;
			$body[12] =		'--'.$this->Boundary.'--';
			$body[13] =		$this->EOL;
			
			/* Set the formatted body result */
			$this->FormattedBody = implode($this->EOL, $body);
			
			return true;
		}
		
		// BODY ENCODE ///////////////////////////////////////////////////////////////////////////////
		function BodyEncode($body) {

			/* Make sure we've got something to work with */
			if (!empty($body)) {
				
				switch($this->Encoding) {
					
					case("8bit"): case("7bit"): default:
						$body = $this->ParseLF($body);
						
						/* Append End-Of-Line termination if required */
						if (!preg_match('/'.preg_quote($this->EOL).'\\z/i', $body))
							$body .= $this->EOL;
					break;
					
					case("binary"):
						$body = $this->ParseLF($body);
					break;
					
					case("base64"):
						$body = chunk_split(base64_encode($body), 76, $this->EOL);
					break;
					
					case("quoted-printable"):
						$body = $this->ParseLF($body);
						
						/* Append End-Of-Line termination if required */
						if (!preg_match('/'.preg_quote($this->EOL).'\\z/i', $body))
							$body .= $this->EOL;
						
						$patterns = array(
							'/([\000-\010\013\014\016-\037\075\177-\377])/e',
							'/([\011\040])'.$this->EOL.'/e'
						);
						
						$replaces = array(
							"'=' . sprintf('%02X', ord('\\1'))",
							"'=' . sprintf('%02X', ord('\\1')) . '".$this->EOL."'"
						);
						
						$body = preg_replace($patterns, $replaces, $body);
						$body = trim(wordwrap($body, 70, ' ='.$this->EOL));
					break;
				}
				return $body;
			}
			return false;
		}
		
		// FORMAT HEADER /////////////////////////////////////////////////////////////////////////////
		function FormatHeader($string) {
			
			/* This formats $string to RFC 2047 */
			if (preg_match_all('/(\s?\w*[\x80-\xFF]+\w*\s?)/', $string, $matchSet)) {
				foreach ($matchSet[1] as $matchValue) {
					$replaceValue = preg_replace(
						'/([\x20\x80-\xFF])/e', 
						'"=" . strtoupper(dechex(ord("\1")))', 
						$matchValue
					);
					$string = str_replace(
						$matchValue, 
						'=?'.$this->Charset.'?Q?'.$replaceValue.'?=', 
						$string
					);
				}
			}
			return wordwrap($string, 75, $this->EOL.$this->TAB, true);
		}
		
		// FORMAT SD ADDRESS /////////////////////////////////////////////////////////////////////////
		function FormatSDAddress($string) {
			
			/* Make sure we've got something to work with */
			if (!empty($string))
				/* Check if the SD is already formatted correctly, if not, continue. */
				if (!preg_match('/<.*>/', $string)) 
					/* Enclose any email address into "< >" */
					return preg_replace('/(\\b[A-Z0-9._%-]+@[A-Z0-9.-]+\\.[A-Z]{2,4}\\b)/i', '<\\1>', $string);
					
				else return $string;
				
			return false;

		}
		
		// EXTRACT SD ADDRESS ////////////////////////////////////////////////////////////////////////
		function ExtractSDAddress($string) {
			
			/* Make sure we've got something to work with */
			if (!empty($string))
				/* Match the email address in $string */
				if (preg_match('/\\b[A-Z0-9._%-]+@[A-Z0-9.-]+\\.[A-Z]{2,4}\\b/i', $string, $capture)) 
					return $capture[0];
			
			return false;

		}
		
		// PARSE LF //////////////////////////////////////////////////////////////////////////////////
		function ParseLF($string) {
			return preg_replace('/\\r\\n|\\r|\\n/', $this->EOL, $string);
		}
		
		// SMTP OPEN /////////////////////////////////////////////////////////////////////////////////
		function SMTPOpen() {
			
			/* Close a current connection if required */
			if ($this->SMTPHandle) $this->SMTPClose();
			
			$this->SMTPHandle = @fsockopen(
				$this->SMTPHost,
				$this->SMTPPort,
				$error_number,
				$error_string,
				$this->SMTPTimeout
			);
	
			@socket_set_timeout($this->SMTPHandle, $this->SMTPTimeout, 0);
	
			return $this->SMTPRead();
		}
		
		// SMTP AUTHENTICATE /////////////////////////////////////////////////////////////////////////
		function SMTPAuthenticate() {
			
			if ($this->SMTPHandle and !empty($this->SMTPUser) and !empty($this->SMTPPassword)) {
				
				if ($this->SMTPPut("AUTH LOGIN") != 334) 
					return false;
				
				if ($this->SMTPPut(base64_encode($this->SMTPUser)) != 334)
					return false;
					
				if ($this->SMTPPut(base64_encode($this->SMTPPassword)) != 235)
					return false;
				
				return true;
			}
			return false;
		}
		
		// SMTP CLOSE ////////////////////////////////////////////////////////////////////////////////
		function SMTPClose() {
			if ($this->SMTPHandle) {
				$this->SMTPPut("QUIT");
				fclose($this->SMTPHandle);
			}
		}
		
		// SMTP READ /////////////////////////////////////////////////////////////////////////////////
		function SMTPRead() {
			if ($this->SMTPHandle) {
				$returnValue = "";
			
				while ($read = fgets($this->SMTPHandle, 515)) {
					$returnValue .= $read;
					/* SMTP Standard; if the 4th character is a space, quit reading */
					if (substr($read, 3, 1) == ' ') break;
				}
			
				return $returnValue;
			}
			return false;
		}
		
		// SMTP MAIL /////////////////////////////////////////////////////////////////////////////////
		function SMTPSendData() {
			
			if ($this->SMTPHandle) {
			
				/* Send the origin information */
				if ($this->SMTPPut("MAIL FROM:<".$this->ExtractSDAddress($this->From).">") != 250)
					return false;
				
				/* Send the recipient address */
				$answerCode = $this->SMTPPut("RCPT TO:<".$this->ExtractSDAddress($this->To).">");
				if ($answerCode != 250 and $answerCode != 251)
					return false;
				
				/* Send the data command */
				if ($this->SMTPPut("DATA") != 354)
					return false;
				
				/*
					Sending content lines to the server ... RFC821 says; A line 
					can not be longer than 999 characters. A line starting 
					with "." must be appended a second ".".
				*/
				foreach (explode($this->EOL, $this->ParseLF($this->Headers.$this->FormattedBody)) as $bodyLine) {
					if (strlen($bodyLine) > 999) 
						$bodyLine = wordwrap($bodyLine, 999, $this->CRLF, 1);
					if (substr($bodyLine, 0, 1) == ".") 
						$bodyLine = ".".$bodyLine;
					fputs($this->SMTPHandle, $bodyLine.$this->CRLF);
				}
				
				if ($this->SMTPPut($this->CRLF.".".$this->CRLF) != 250) 
					return false;
				
				return true;
			}
			return false;
		}
		
		// SMTP PUT //////////////////////////////////////////////////////////////////////////////////
		function SMTPPut($data) {
			if ($this->SMTPHandle) {
				fputs($this->SMTPHandle, $data . $this->CRLF);
				return substr($this->SMTPRead(), 0, 3);
			}
			return false;
		}
		
	}
	
?>