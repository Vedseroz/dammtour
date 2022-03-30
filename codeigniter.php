<?php
/*
 *---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 *---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 */
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>='))
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;
}

$system_path = 'system';
$application_folder = 'application';
$view_folder = '';

if (defined('STDIN'))
{
	chdir(dirname(__FILE__));
}

if (($_temp = realpath($system_path)) !== FALSE)
{
	$system_path = $_temp.DIRECTORY_SEPARATOR;
}
else
{
	// Ensure there's a trailing slash
	$system_path = strtr(
		rtrim($system_path, '/\\'),
		'/\\',
		DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
	).DIRECTORY_SEPARATOR;
}

// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// Path to the system directory
define('BASEPATH', $system_path);

// Path to the front controller (this file) directory
define('FCPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

// Name of the "system" directory
define('SYSDIR', basename(BASEPATH));

// The path to the "application" directory
if (is_dir($application_folder))
{
	if (($_temp = realpath($application_folder)) !== FALSE)
	{
		$application_folder = $_temp;
	}
	else
	{
		$application_folder = strtr(
			rtrim($application_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
}
elseif (is_dir(BASEPATH.$application_folder.DIRECTORY_SEPARATOR))
{
	$application_folder = BASEPATH.strtr(
		trim($application_folder, '/\\'),
		'/\\',
		DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
	);
}

define('APPPATH', $application_folder.DIRECTORY_SEPARATOR);

// The path to the "views" directory
if ( ! isset($view_folder[0]) && is_dir(APPPATH.'views'.DIRECTORY_SEPARATOR))
{
	$view_folder = APPPATH.'views';
}
elseif (is_dir($view_folder))
{
	if (($_temp = realpath($view_folder)) !== FALSE)
	{
		$view_folder = $_temp;
	}
	else
	{
		$view_folder = strtr(
			rtrim($view_folder, '/\\'),
			'/\\',
			DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
		);
	}
}
elseif (is_dir(APPPATH.$view_folder.DIRECTORY_SEPARATOR))
{
	$view_folder = APPPATH.strtr(
		trim($view_folder, '/\\'),
		'/\\',
		DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR
	);
}
define('VIEWPATH', $view_folder.DIRECTORY_SEPARATOR);

if (file_exists(APPPATH.'config/'.ENVIRONMENT.'/constants.php'))
{
	require_once(APPPATH.'config/'.ENVIRONMENT.'/constants.php');
}

if (file_exists(APPPATH.'config/constants.php'))
{
	require_once(APPPATH.'config/constants.php');
}

require_once(BASEPATH .'core/Common.php');

if ( ! is_php('5.4'))
{
	ini_set('magic_quotes_runtime', 0);

	if ((bool) ini_get('register_globals'))
	{
		$_protected = array(
			'_SERVER',
			'_GET',
			'_POST',
			'_FILES',
			'_REQUEST',
			'_SESSION',
			'_ENV',
			'_COOKIE',
			'GLOBALS',
			'HTTP_RAW_POST_DATA',
			'system_path',
			'application_folder',
			'view_folder',
			'_protected',
			'_registered'
		);

		$_registered = ini_get('variables_order');
		foreach (array('E' => '_ENV', 'G' => '_GET', 'P' => '_POST', 'C' => '_COOKIE', 'S' => '_SERVER') as $key => $superglobal)
		{
			if (strpos($_registered, $key) === FALSE)
			{
				continue;
			}

			foreach (array_keys($$superglobal) as $var)
			{
				if (isset($GLOBALS[$var]) && ! in_array($var, $_protected, TRUE))
				{
					$GLOBALS[$var] = NULL;
				}
			}
		}
	}
}

set_error_handler('_error_handler');
set_exception_handler('_exception_handler');
register_shutdown_function('_shutdown_handler');

if ($composer_autoload = config_item('composer_autoload'))
{
	if ($composer_autoload === TRUE)
	{
		file_exists(APPPATH.'vendor/autoload.php')
			? require_once(APPPATH.'vendor/autoload.php')
			: log_message('error', '$config[\'composer_autoload\'] is set to TRUE but '.APPPATH.'vendor/autoload.php was not found.');
	}
	elseif (file_exists($composer_autoload))
	{
		require_once($composer_autoload);
	}
	else
	{
		log_message('error', 'Could not find the specified $config[\'composer_autoload\'] path: '.$composer_autoload);
	}
}

$EXT =& load_class('Hooks', 'core');
$EXT->call_hook('pre_system');

$CFG =& load_class('Config', 'core');

$charset = strtoupper(config_item('charset'));
ini_set('default_charset', $charset);

if (extension_loaded('mbstring'))
{
	define('MB_ENABLED', TRUE);
	// mbstring.internal_encoding is deprecated starting with PHP 5.6
	// and it's usage triggers E_DEPRECATED messages.
	@ini_set('mbstring.internal_encoding', $charset);
	// This is required for mb_convert_encoding() to strip invalid characters.
	// That's utilized by CI_Utf8, but it's also done for consistency with iconv.
	mb_substitute_character('none');
}
else
{
	define('MB_ENABLED', FALSE);
}

// There's an ICONV_IMPL constant, but the PHP manual says that using
// iconv's predefined constants is "strongly discouraged".
if (extension_loaded('iconv'))
{
	define('ICONV_ENABLED', TRUE);
	// iconv.internal_encoding is deprecated starting with PHP 5.6
	// and it's usage triggers E_DEPRECATED messages.
	@ini_set('iconv.internal_encoding', $charset);
}
else
{
	define('ICONV_ENABLED', FALSE);
}

if (is_php('5.6'))
{
	ini_set('php.internal_encoding', $charset);
}

require_once(BASEPATH.'core/compat/mbstring.php');
require_once(BASEPATH.'core/compat/hash.php');
require_once(BASEPATH.'core/compat/password.php');
require_once(BASEPATH.'core/compat/standard.php');

$UNI =& load_class('Utf8', 'core');
$URI =& load_class('URI', 'core');
$RTR =& load_class('Router', 'core', isset($routing) ? $routing : NULL);
$OUT =& load_class('Output', 'core');
if ($EXT->call_hook('cache_override') === FALSE && $OUT->_display_cache($CFG, $URI) === TRUE)
{
	exit;
}
$SEC =& load_class('Security', 'core');
$IN	=& load_class('Input', 'core');
$LANG =& load_class('Lang', 'core');

require_once BASEPATH.'core/Controller.php';

function &get_instance()
{
	return CI_Controller::get_instance();
}

$class = 'CI_Controller';
$instance = new $class();

return $instance;
?>