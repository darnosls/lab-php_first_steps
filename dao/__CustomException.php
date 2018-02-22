<?php
class CustomException extends PDOException
{

	/*private $message;
	private $code;*/
	public function __construct(PDOException $e) {
         if(strstr($e->getMessage(), 'SQLSTATE[')) {
            preg_match('/SQLSTATE\[(\w+)\] \[(\w+)\] (.*)/', $e->getMessage(), $matches);
            $this->code = ($matches[1] == 'HT000' ? $matches[2] : $matches[1]);
            $this->message = $matches[3];
        }
    }

/*    public function getMessage( )
    {
    	return $this->message;
    }
    public function setMessage($message)
    {
    	$this->message = $message;
    }
    public function getCode( )
    {
    	return $this->code;
    }
    public function setCode($code)
    {
    	$this->code = $code;

    }
*/
}
