<?php  namespace Filebase;

class Filesystem
{

    /**
     * read
     *
     *
     */
    public static function read($path, $openssl_crypt)
    {
        if(!file_exists($path))
        {
            return false;
        }

        $file = fopen($path, 'r');
        $contents = fread($file, filesize($path));
        fclose($file);
		$final_contents = empty($openssl_crypt) ? $contents : self::openSSLCrypt('decrypt', $contents, $openssl_crypt['key'], $openssl_crypt['iv'], $openssl_crypt['method']);
        return $final_contents;
    }



    //--------------------------------------------------------------------


    /**
     * Writes data to the filesystem.
     *
     * @param  string $path     The absolute file path to write to
     * @param  string $contents The contents of the file to write
     *
     * @return boolean          Returns true if write was successful, false if not.
     */
    public static function write($path, $contents, $openssl_crypt)
    {
        $fp = fopen($path, 'w+');

        if(!flock($fp, LOCK_EX))
        {
            return false;
        }

		$final_contents = empty($openssl_crypt) ? $contents : self::openSSLCrypt('encrypt', $contents, $openssl_crypt['key'], $openssl_crypt['iv'], $openssl_crypt['method']);
        $result = fwrite($fp, $final_contents);

        flock($fp, LOCK_UN);
        fclose($fp);

        return $result !== false;
    }


    //--------------------------------------------------------------------


    /**
     * delete
     *
     * @param string $path
     *
     * @return boolean True if deleted, false if not.
     */
    public static function delete($path)
    {
        return unlink($path);
    }


    //--------------------------------------------------------------------


    /**
     * Validates the name of the file to ensure it can be stored in the
     * filesystem.
     *
     * @param string $name The name to validate against
     * @param boolean $safe_filename Allows filename to be converted if fails validation
     *
     * @return bool Returns true if valid. Throws an exception if not.
     */
    public static function validateName($name, $safe_filename)
    {
        if (!preg_match('/^[0-9A-Za-z\_\-]{1,63}$/', $name))
        {
            if ($safe_filename === true)
            {
                // rename the file
                $name = preg_replace('/[^0-9A-Za-z\_\-]/','', $name);

                // limit the file name size
                $name = substr($name,0,63);
            }
            else
            {
                throw new \Exception(sprintf('`%s` is not a valid file name.', $name));
            }
        }

        return $name;
    }


    //--------------------------------------------------------------------


    /**
     * Get an array containing the path of all files in this repository
     *
     * @return array An array, item is a file
     */
    public static function getAllFiles($path = '',$ext = 'json')
    {
        $files = [];
        $_files = glob($path.'*.'.$ext);
        foreach($_files as $file)
        {
            $files[] = str_replace('.'.$ext,'',basename($file));
        }

        return $files;
    }


    //--------------------------------------------------------------------
	private static function openSSLCrypt ($action, $string, $myKey, $myIV, $encrypt_method)
	{
	    $output = false;
	
	    if ( $action && ($action == 'encrypt' || $action == 'decrypt') && !empty($string) && !empty($myKey) && !empty($myIV) && !empty($encrypt_method))
	    {
	    	$action = trim($action);
	    	
	    	$secret_key = hash('sha256',$myKey);
	    	$secret_iv = substr(hash('sha256',$myIV),0,16);
	    	
	        $string = trim(strval($string));
	
	        if ( $action == 'encrypt' )
	        {
	            $output = openssl_encrypt($string, $encrypt_method, $secret_key, 0, $secret_iv);
	        };
	
	        if ( $action == 'decrypt' )
	        {
	            $output = openssl_decrypt($string, $encrypt_method, $secret_key, 0, $secret_iv);
	        };
	    };
	
	    return $output;
	}
}
